<?php
class pendaftarModel
{
    private $pmb_mahasiswa;
    private $pmb_tagihan;
    private $pmb_periode;
    private $pmb_pembayaran;
    private $varoption;
    private $edu_ortu;
    private $db;
    public function __construct()
    {
        global $pmb_mahasiswa;
        global $pmb_tagihan;
        global $pmb_periode;
        global $pmb_pembayaran;
        global $varoption;
        global $edu_ortu;

        $this->pmb_mahasiswa = $pmb_mahasiswa;
        $this->pmb_tagihan = $pmb_tagihan;
        $this->pmb_periode = $pmb_periode;
        $this->pmb_periode = $pmb_pembayaran;
        $this->varoption = $varoption;
        $this->edu_ortu = $edu_ortu;
        $this->db = Database::getInstance();
    }

    public function getPendaftar()
    {
        $query = "SELECT 
                        a.*,
                        a.ID, 
                        a.NamaLengkap AS 'Nama Lengkap',
                        b.*,
                        b.id,
                        COALESCE(d1.var_value, '') AS 'Pilihan Pertama',
                        COALESCE(d2.var_value, '') AS 'Pilihan Kedua',
                        COALESCE(d3.var_value, '') AS 'Pilihan Ketiga',
                        b.member_id,
                        b.jenjang,
                        b.kelulusan,
                        c.*,
                        c.recid,
                        c.periode AS 'Periode',
                        c.keterangan,
                        c.status,
                        e.catatan
                    FROM 
                        pmb_mahasiswa a
                    LEFT JOIN 
                        pmb_tagihan b ON b.member_id = a.ID
                    LEFT JOIN 
                        pmb_periode c ON c.recid = b.periode
                    LEFT JOIN
                        pmb_pembayaran e ON e.member_id = a.ID
                    LEFT JOIN 
                        varoption d1 ON d1.recid = b.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = b.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = b.PilihanKetiga;
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVerified()
    {
        $query = "SELECT 
                        a.id,
                        a.member_id,
                        a.pay_status,
                        a.verified,
                        a.no_ujian,
                        a.jumlah_tagihan,
                        a.nomor_va,
                        a.registration_date,
                        a.jenis,
                        a.invoice_id,
                        a.jenjang,
                        a.bukti_transfer,
                        b.ID,
                        b.NamaLengkap,
                        b.berkas,
                        b.WANumber,
                        b.photo,
                        c.Periode,
                        COALESCE(d1.var_value, '') AS Prodi1,
                        COALESCE(d2.var_value, '') AS Prodi2,
                        COALESCE(d3.var_value, '') AS Prodi3
                    FROM 
                        pmb_tagihan a
                    LEFT JOIN 
                        pmb_mahasiswa b ON b.ID = a.member_id
                    LEFT JOIN 
                        pmb_periode c ON c.recid = a.periode
                    LEFT JOIN 
                        varoption d1 ON d1.recid = a.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = a.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = a.PilihanKetiga;
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTagihan()
    {
        $query = "SELECT 
                        a.id,
                        a.member_id,
                        a.pay_status,
                        a.verified,
                        a.no_ujian,
                        b.ID,
                        b.NamaLengkap
                    FROM 
                       pmb_tagihan a
                    LEFT JOIN 
                       pmb_mahasiswa b ON b.ID = a.member_id;
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVerificationStatus($id)
    {
        $query = "SELECT verified FROM pmb_tagihan WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public function getMultipleVerificationStatus($id)
    {
        $query = "SELECT verified FROM pmb_tagihan WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public function updateVerificationStatus($id, $status, $no_ujian, $pay_status)
    {
        try {
            $query = "UPDATE pmb_tagihan SET verified = ?, no_ujian = ?, pay_status = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute([$status, $no_ujian, $pay_status, $id]);

            if ($result) {
                return true;
            } else {
                throw new Exception("Failed to update record with id: $id");
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }


    public function updateMultipleVerificationStatuses($data)
    {
        try {
            $query = "UPDATE pmb_tagihan SET verified = ?, no_ujian = ?, pay_status = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$data['verified'], $data['no_ujian'], $data['pay_status'], $data['id']]);
        } catch (Exception $e) {
            return false;
        }
    }


    public function getDetail($id)
    {
        $query = "SELECT 
                        a.*,
                        b.*,
                        c.*,
                        e.*,
                        f.*,
                        COALESCE(d1.var_value, '') AS Prodi1,
                        COALESCE(d2.var_value, '') AS Prodi2,
                        COALESCE(d3.var_value, '') AS Prodi3
                    FROM 
                        pmb_tagihan a
                    LEFT JOIN 
                        pmb_mahasiswa b ON b.ID = a.member_id
                    LEFT JOIN 
                        pmb_periode c ON c.recid = a.periode
                    LEFT JOIN 
                        varoption d1 ON d1.recid = a.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = a.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = a.PilihanKetiga
                    LEFT JOIN
                    	edu_ortu e ON e.maba_id = a.member_id
                    LEFT JOIN
                    	pmb_pembayaran f ON f.member_id = a.member_id
                    WHERE 
                        a.member_id = ?;
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function getPesertaPMB()
    {
        $query = "SELECT 
                        a.ID, 
                        a.nik,
                        a.UserName,
                        a.NamaLengkap AS 'Nama Lengkap',
                        b.id,
                        COALESCE(d1.var_value, '') AS 'Pilihan Pertama',
                        COALESCE(d2.var_value, '') AS 'Pilihan Kedua',
                        COALESCE(d3.var_value, '') AS 'Pilihan Ketiga',
                        b.member_id,
                        b.jenjang,
                        b.nomor_va,
                        c.recid,
                        c.periode AS 'Periode',
                        e.catatan,
                        e.tagihan
                    FROM 
                        pmb_mahasiswa a
                    LEFT JOIN 
                        pmb_tagihan b ON b.member_id = a.ID
                    LEFT JOIN 
                        pmb_periode c ON c.recid = b.periode
                    LEFT JOIN
                        pmb_pembayaran e ON e.member_id = a.ID
                    LEFT JOIN 
                        varoption d1 ON d1.recid = b.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = b.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = b.PilihanKetiga;
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getPesertaUjian()
    {
        $query = "SELECT 
                        a.ID, 
                        a.nik,
                        a.UserName,
                        a.NamaLengkap AS 'Nama Lengkap',
                        b.id,
                        COALESCE(d1.var_value, '') AS 'Pilihan Pertama',
                        COALESCE(d2.var_value, '') AS 'Pilihan Kedua',
                        COALESCE(d3.var_value, '') AS 'Pilihan Ketiga',
                        b.member_id,
                        b.jenjang,
                        b.nomor_va,
                        c.recid,
                        c.periode AS 'Periode',
                        e.catatan,
                        e.tagihan
                    FROM 
                        pmb_mahasiswa a
                    LEFT JOIN 
                        pmb_tagihan b ON b.member_id = a.ID
                    LEFT JOIN 
                        pmb_periode c ON c.recid = b.periode
                    LEFT JOIN
                        pmb_pembayaran e ON e.member_id = a.ID
                    LEFT JOIN 
                        varoption d1 ON d1.recid = b.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = b.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = b.PilihanKetiga
                    INNER JOIN
                    	pmb_jadualtes f ON f.test_tagihanid = b.id;
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getPesertaLulus()
    {
        $query = "SELECT 
                        a.ID, 
                        a.nik,
                        a.UserName,
                        a.NamaLengkap AS 'Nama Lengkap',
                        b.id,
                        COALESCE(d1.var_value, '') AS 'Pilihan Pertama',
                        COALESCE(d2.var_value, '') AS 'Pilihan Kedua',
                        COALESCE(d3.var_value, '') AS 'Pilihan Ketiga',
                        b.member_id,
                        b.jenjang,
                        b.nomor_va,
                        c.recid,
                        c.periode AS 'Periode',
                        e.catatan,
                        e.tagihan,
                        g.prodi_lulus
                    FROM 
                        pmb_mahasiswa a
                    LEFT JOIN 
                        pmb_tagihan b ON b.member_id = a.ID
                    LEFT JOIN 
                        pmb_periode c ON c.recid = b.periode
                    LEFT JOIN
                        pmb_pembayaran e ON e.member_id = a.ID
                    LEFT JOIN 
                        varoption d1 ON d1.recid = b.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = b.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = b.PilihanKetiga
                    INNER JOIN
                    	pmb_kelulusan g on g.id_tagihan = b.id;
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
