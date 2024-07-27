<?php
class testPendaftarModel
{
    private $pmb_tagihan;
    private $pmb_mahasiswa;
    private $pmb_periode;
    private $pmb_jadualtes;
    private $varoption;
    private $db;
    public function __construct()
    {
        global $pmb_tagihan;
        global $pmb_mahasiswa;
        global $pmb_periode;
        global $pmb_jadualtes;
        global $varoption;
        $this->pmb_tagihan = $pmb_tagihan;
        $this->pmb_mahasiswa = $pmb_mahasiswa;
        $this->pmb_periode = $pmb_periode;
        $this->pmb_jadualtes = $pmb_jadualtes;
        $this->varoption = $varoption;
        $this->db = Database::getInstance();
    }
    public function getPendaftarTerverifikasi()
    {
        $query = "SELECT 
                    a.id AS tagihan_id,
                    a.verified,
                    a.member_id,
                    a.no_ujian,
                    a.jenis,
                    a.jenjang,
                    b.ID,
                    b.NamaLengkap,
                    c.Periode,
                    COALESCE(d1.var_value, '') AS Prodi1,
                    COALESCE(d2.var_value, '') AS Prodi2,
                    COALESCE(d3.var_value, '') AS Prodi3,
                    CASE 
                        WHEN COUNT(e.test_tagihanid) > 0 THEN 1
                        ELSE 0
                    END AS test_scheduled,
                    CONCAT(
                        DATE_FORMAT(COALESCE(MIN(e.test_tanggal), ''), '%d-%m-%Y'), 
                        ' - ', 
                        DATE_FORMAT(COALESCE(MAX(e.test_tanggal), ''), '%d-%m-%Y')
                    ) AS test_tanggal
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
                    pmb_jadualtes e ON e.test_tagihanid = a.id
                WHERE 
                    a.verified = 'Verified'
                GROUP BY
                    a.id, a.verified, a.member_id, a.no_ujian, a.jenis, a.jenjang,
                    b.ID, b.NamaLengkap, c.Periode, d1.var_value, d2.var_value, d3.var_value;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addTestPendaftar($tagihan_id, $test_tanggal, $test_mulai, $test_selesai, $test_lokasi)
    {
        $query = "INSERT INTO $this->pmb_jadualtes (test_tanggal, test_mulai, test_selesai, test_lokasi, test_tagihanid) VALUES (?, ?, ?, ?, ?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$test_tanggal, $test_mulai, $test_selesai, $test_lokasi, $tagihan_id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getTestPendaftar()
    {
        $query = "SELECT j.*, CONCAT(t.no_ujian, ' - ', m.NamaLengkap) AS DetailPendaftar FROM $this->pmb_jadualtes j LEFT JOIN $this->pmb_tagihan t ON j.test_tagihanid = t.id LEFT JOIN $this->pmb_mahasiswa m ON t.member_id = m.ID";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function dropTestPendaftar($a)
    {
        $query = "DELETE FROM $this->pmb_jadualtes WHERE test_tagihanid = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$a]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
