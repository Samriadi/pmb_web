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
}
