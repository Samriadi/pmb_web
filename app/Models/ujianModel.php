<?php
require_once __DIR__ . '/../Core/Database.php';

class ujianModel
{
    public function getUjian()
    {
        $db = Database::getInstance();
        $query = "SELECT a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM pmb_tagihan a JOIN pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateDataFromCSV($no_ujian, $kelulusan)
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("UPDATE pmb_tagihan SET kelulusan = ? WHERE no_ujian = ?");
        $stmt->execute([$kelulusan, $no_ujian]);
    }

    public function getCSV()
    {
        $db = Database::getInstance();
        $query = "SELECT a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM pmb_tagihan a JOIN pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
