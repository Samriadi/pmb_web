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
            CASE 
                WHEN b.PilihanPertama = d.recid THEN d.var_value 
                ELSE ' ' 
            END AS PilihanPertama,
            CASE 
                WHEN b.PilihanKedua = d.recid THEN d.var_value 
                ELSE ' ' 
            END AS PilihanKedua,
            CASE 
                WHEN b.PilihanKetiga = d.recid THEN d.var_value 
                ELSE ' ' 
            END AS PilihanKetiga,
            b.member_id,
            c.recid,
            c.jenjang,
            c.periode,
            c.keterangan,
            c.status
        FROM 
            pmb_mahasiswa a
        JOIN 
            pmb_tagihan b ON b.member_id = a.ID
        JOIN 
            pmb_periode c ON c.recid = b.periode
        LEFT JOIN 
            varoption d ON d.recid IN (b.PilihanPertama, b.PilihanKedua, b.PilihanKetiga);";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
