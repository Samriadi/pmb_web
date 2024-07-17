<?php
class testPendaftarModel
{

    public function getPendaftarTerverifikasi()
    {
        $db = Database::getInstance();
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
                    WHERE a.verified = 'Verified'   
                    AND NOT EXISTS (
                        SELECT 1
                        FROM pmb_jadualtes e
                        WHERE e.test_memberid = a.member_id)";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addTestPendaftar($tagihan_id, $test_tanggal, $test_mulai, $test_selesai, $test_lokasi)
    {
        $db = Database::getInstance();

        $query = "INSERT INTO pmb_jadualtes (test_tanggal, test_mulai, test_selesai, test_lokasi, test_memberid) VALUES (?, ?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$test_tanggal, $test_mulai, $test_selesai, $test_lokasi, $tagihan_id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getTestPendaftar()
    {
        $db = Database::getInstance();
        $query = "SELECT j.*, CONCAT(t.no_ujian, ' - ', m.NamaLengkap) AS DetailPendaftar FROM pmb_jadualtes j LEFT JOIN pmb_tagihan t ON j.test_memberid = t.id LEFT JOIN pmb_mahasiswa m ON t.member_id = m.ID";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function dropTestPendaftar($a)
    {
        $db = Database::getInstance();
        $query = "DELETE FROM pmb_jadualtes WHERE test_memberid = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$a]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
