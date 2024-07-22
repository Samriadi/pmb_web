<?php
class pembayaranModel
{

    private $pmb_pembayaran;
    private $pmb_nim;
    private $pmb_mahasiswa;
    private $db;
    public function __construct()
    {
        global $pmb_pembayaran;
        global $pmb_nim;
        global $pmb_mahasiswa;

        $this->pmb_pembayaran = $pmb_pembayaran;
        $this->pmb_nim = $pmb_nim;
        $this->pmb_mahasiswa = $pmb_mahasiswa;
        $this->db = Database::getInstance();
    }

    public function getPembayaran()
    {
        $query = "SELECT 
                    p.recid, 
                    p.member_id, 
                    p.prodi, 
                    p.prodi_id, 
                    p.kategori, 
                    p.jenjang, 
                    p.periode, 
                    p.jenis, 
                    CASE 
                        WHEN n.member_id IS NULL THEN 0 
                        ELSE 1 
                    END AS isHaveNim,
                    m.NamaLengkap
                FROM 
                    $this->pmb_pembayaran p
                LEFT JOIN 
                    $this->pmb_nim n ON p.member_id = n.member_id
                LEFT JOIN
                	$this->pmb_mahasiswa m ON m.ID = p.member_id
                WHERE 
                    n.member_id IS NULL;
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNIM()
    {
        $query = "SELECT 
                    a.*,
                    m.NamaLengkap,
                    p.prodi 
                    FROM $this->pmb_nim a
                    LEFT JOIN 
                    $this->pmb_mahasiswa m ON m.ID = a.member_id
                    LEFT JOIN $this->pmb_pembayaran p ON p.member_id = a.member_id
                    ORDER BY a.nim ASC;
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveNIM($data)
    {
        $response = [];
        foreach ($data as $key => $value) {
            try {
                $kode = substr($value['nim'], 0, 5);

                $query = "SELECT MAX(nim) as last_nim FROM $this->pmb_nim WHERE nim LIKE ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$kode . '%']);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $last_nim = $row['last_nim'];

                if (!$last_nim) {
                    $urutan = 1;
                } else {
                    $urutan = intval(substr($last_nim, -2)) + 1;
                }

                $urutan = str_pad($urutan, 3, '0', STR_PAD_LEFT);

                $nim_baru = $kode . $urutan;

                $query = "INSERT INTO $this->pmb_nim (member_id, angkatan, jenjang, kategori, jenis, prodi_id, nim) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$value['member_id'], $value['periode'], $value['jenjang'], $value['kategori'], $value['jenis'], $value['prodi_id'], $nim_baru]);

                // Tambahkan ke response data
                $response[] = [
                    'member_id' => $value['member_id'],
                    'nim' => $nim_baru,
                    'status' => 'success'
                ];
            } catch (Exception $e) {
                // Tangani jika ada kesalahan dan tambahkan ke response data
                $response[] = [
                    'member_id' => $value['member_id'],
                    'error' => $e->getMessage(),
                    'status' => 'error'
                ];
            }
        }

        // Kembalikan response ke controller
        return $response;
    }



    public function getCountNIM($prodi_id, $kategori)
    {
        if ($prodi_id == "01") {
            $query = "SELECT COUNT(*) FROM $this->pmb_nim WHERE prodi_id = :prodi_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':prodi_id', $prodi_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        } else {
            $query = "SELECT COUNT(*) FROM $this->pmb_nim WHERE prodi_id = :prodi_id AND kategori = :kategori";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':prodi_id', $prodi_id, PDO::PARAM_INT);
            $stmt->bindParam(':kategori', $kategori, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
    }
}
