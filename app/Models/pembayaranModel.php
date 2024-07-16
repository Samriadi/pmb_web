<?php
class pembayaranModel
{
    public function getPembayaran()
    {
        $db = Database::getInstance();
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
                    pmb_pembayaran p
                LEFT JOIN 
                    pmb_nim n ON p.member_id = n.member_id
                LEFT JOIN
                	pmb_mahasiswa m ON m.ID = p.member_id
                WHERE 
                    n.member_id IS NULL;
                ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveNIM($data)
    {
        $db = Database::getInstance();
        foreach ($data as $key => $value) {
            $query = "INSERT INTO pmb_nim (member_id, angkatan, jenjang, kategori, jenis, prodi_id, nim) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$value['member_id'], $value['periode'], $value['jenjang'], $value['kategori'], $value['jenis'], $value['prodi_id'], $value['nim']]);
        }
    }
    public function getCountNIM($prodi_id, $kategori)
    {
        $db = Database::getInstance();

        $query = "SELECT COUNT(*) FROM pmb_nim WHERE prodi_id = :prodi_id AND kategori = :kategori";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':prodi_id', $prodi_id, PDO::PARAM_INT);
        $stmt->bindParam(':kategori', $kategori, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
