<?php
require_once __DIR__ . '/../config/database.php';


class eduTestModel {
    //jadwal test	
    public function getTest() {
		$db = Database::getInstance();
        $query = "SELECT * FROM edu_test";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addTest($gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangn) {
		$db = Database::getInstance();

        $query = "INSERT INTO edu_test (gelombang, ruang, jenis_ujian, tgl_ujian, jam_mulai, jam_selesai, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangn]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //get gelombang
    public function getGelombang() {
		$db = Database::getInstance();
        $query = "SELECT * FROM edu_periode WHERE status='Open'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $values = [];
        foreach ($data as $item) {
            $values[] = [
				'recid' => $item->recid,
                'jenjang_keterangan' => $item->Jenjang . ' - ' . $item->Keterangan
            ];
        }
        return $values;
    }

    //get ruang
    public function getRuang() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option where var_name='Ruang'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $values = [];
        foreach ($data as $item) {
            $values[] = [
				'recid' => $item->recid,
                'ruangan' => $item->var_value
            ];
        }
        return $values;
    }

     //get jenis ujian
     public function getUjian() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option where var_name='Ujian'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $values = [];
        foreach ($data as $item) {
            $values[] = [
				'recid' => $item->recid,
                'jenis_ujian' => $item->var_value
            ];
        }
        return $values;
    }

    
    public function showGelombang($recid){
		$db = Database::getInstance();
        $query = "SELECT Jenjang, Keterangan FROM edu_periode where recid = :recid";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':recid', $recid);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function showRuang($recid){
		$db = Database::getInstance();
        $query = "SELECT var_value FROM var_option where var_name='Ruang' AND  recid = :recid";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':recid', $recid);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function showUjian($recid){
		$db = Database::getInstance();
        $query = "SELECT var_value FROM var_option where var_name='Ujian' AND  recid = :recid";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':recid', $recid);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteTest($id) {
        $db = Database::getInstance();

        $query = "DELETE FROM edu_test WHERE id = ?";

        try {
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getTestById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM edu_test WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateTest($id, $gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangan) {
        $db = Database::getInstance();
    
        // Menggunakan prepared statement dengan placeholder ?
        $stmt = $db->prepare("UPDATE edu_test SET gelombang = ?, ruang = ?, jenis_ujian = ?, tgl_ujian = ?, jam_mulai = ?, jam_selesai = ?, keterangan = ? WHERE id = ?");
        // Urutan parameter dalam execute harus sesuai dengan urutan placeholder ?
        $stmt->execute([$gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangan, $id]);
    }
    
}

?>