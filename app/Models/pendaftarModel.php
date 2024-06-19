<?php
class pendaftarModel
{
    

    public function getPendaftar()
    {
        $db = Database::getInstance();
        $query = "SELECT 
                        a.ID, 
                        a.NamaLengkap,
                        b.id,
                        COALESCE(d1.var_value, '') AS PilihanPertama,
                        COALESCE(d2.var_value, '') AS PilihanKedua,
                        COALESCE(d3.var_value, '') AS PilihanKetiga,
                        b.member_id,
                        c.recid,
                        c.jenjang,
                        c.periode,
                        c.keterangan,
                        c.status
                    FROM 
                        pmb_mahasiswa a
                    LEFT JOIN 
                        pmb_tagihan b ON b.member_id = a.ID
                    LEFT JOIN 
                        pmb_periode c ON c.recid = b.periode
                    LEFT JOIN 
                        varoption d1 ON d1.recid = b.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = b.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = b.PilihanKetiga;
                    ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVerified()
    {
        $db = Database::getInstance();
        $query = "SELECT 
                        a.id,
                        a.pay_status,
                        a.verified,
                        a.no_ujian,
                        b.ID,
                        b.NamaLengkap,
                        c.Periode,
                        c.Keterangan
                    FROM 
                        pmb_tagihan a
                    LEFT JOIN 
                        pmb_mahasiswa b ON b.ID = a.member_id
                    LEFT JOIN 
                        pmb_periode c ON c.recid = a.periode
                    ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVerificationStatus($id) {
        $db = Database::getInstance();

        $query = "SELECT verified FROM pmb_tagihan WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public function updateVerificationStatus($id, $status, $no_ujian, $pay_status) {
        $db = Database::getInstance();

       

        $query = "UPDATE pmb_tagihan SET verified = ?, no_ujian = ?, pay_status = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt->execute([$status, $no_ujian, $pay_status, $id]);
    }
}
