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
            ( SELECT IF(b.PilihanPertama = d.recid, d.var_value, 'NO') 
                FROM var_option d 
                WHERE d.recid = b.PilihanPertama
            ) AS PilihanPertama,
            ( SELECT IF(b.PilihanKedua = d.recid, d.var_value, 'NO') 
                FROM var_option d 
                WHERE d.recid = b.PilihanKedua
            ) AS PilihanKedua,
            ( SELECT IF(b.PilihanKetiga = d.recid, d.var_value, 'NO') 
                FROM var_option d 
                WHERE d.recid = b.PilihanKetiga
            ) AS PilihanKetiga,
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
            pmb_periode c ON c.recid = b.periode";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    
    
   
}
