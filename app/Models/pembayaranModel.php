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
        foreach ($data as $key => $value) {
            // Ambil kode tahun atau format dasar NIM dari $value
            $kode = substr($value['nim'], 0, 5); // Misalnya, '24023'

            // Query untuk mendapatkan NIM terakhir
            $query = "SELECT MAX(nim) as last_nim FROM $this->pmb_nim WHERE nim LIKE ?"; // '24023%'
            $stmt = $this->db->prepare($query);
            $stmt->execute([$kode . '%']);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $last_nim = $row['last_nim'];

            // Jika tidak ada NIM yang ditemukan, set urutan awal
            if (!$last_nim) {
                $urutan = 1;
            } else {
                // Ambil angka urutan terakhir dan tambah 1
                $urutan = intval(substr($last_nim, -2)) + 1;
            }

            // Format urutan menjadi 2 digit
            $urutan = str_pad($urutan, 3, '0', STR_PAD_LEFT);

            // Buat NIM baru
            $nim_baru = $kode . $urutan;

            // Masukkan data dengan NIM baru
            $query = "INSERT INTO $this->pmb_nim (member_id, angkatan, jenjang, kategori, jenis, prodi_id, nim) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$value['member_id'], $value['periode'], $value['jenjang'], $value['kategori'], $value['jenis'], $value['prodi_id'], $nim_baru]);
        }
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
