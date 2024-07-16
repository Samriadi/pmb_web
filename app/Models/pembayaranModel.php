<?php
class pembayaranModel
{
    public function getPembayaran()
    {
        $db = Database::getInstance();
        $query = "SELECT recid, member_id, prodi, prodi_id, kategori, jenjang, periode, jenis FROM pmb_pembayaran";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveNIM($data)
    {
        $db = Database::getInstance();
        foreach ($data as $key => $value) {
            $query = "INSERT INTO pmb_nim (member_id, angkatan, jenjang, kategori, jenis, nim) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$value['member_id'], $value['periode'], $value['jenjang'], $value['kategori'], $value['jenis'], $value['nim']]);
        }
    }
}
