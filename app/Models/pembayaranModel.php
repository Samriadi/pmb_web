<?php
class pembayaranModel
{
    public function getPembayaran()
    {
        $db = Database::getInstance();
        $query = "SELECT recid, member_id, prodi, prodi_id, kategori, jenjang, periode FROM pmb_pembayaran";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
