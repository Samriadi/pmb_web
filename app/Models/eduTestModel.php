<?php

require_once __DIR__ . '/../Core/Database.php';

class eduTestModel {
    //jadwal test	
    public function getTest() {
		$db = Database::getInstance();
        $query = "SELECT
                (SELECT if(a.ruang = c.recid,c.var_value,'no') FROM var_option c WHERE c.recid = a.ruang) ruang,
                (SELECT if(a.jenis_ujian = d.recid,d.var_value,'no') FROM var_option d WHERE d.recid = a.jenis_ujian) ujian,
                a.id,
                a.keterangan ket_edu,
                b.Jenjang,
                b.Keterangan ket_periode,
                b.status 
                FROM edu_test a 
                JOIN edu_periode b ON b.recid = a.gelombang;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addTest($gelombang, $ruang, $jenis_ujian, $keterangn) {
		$db = Database::getInstance();

        $query = "INSERT INTO edu_test (gelombang, ruang, jenis_ujian, keterangan) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$gelombang, $ruang, $jenis_ujian, $keterangn]);
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
    
    public function updateTest($id, $gelombang, $ruang, $jenis_ujian, $keterangan) {
        $db = Database::getInstance();
    
        // Menggunakan prepared statement dengan placeholder ?
        $stmt = $db->prepare("UPDATE edu_test SET gelombang = ?, ruang = ?, jenis_ujian = ?, keterangan = ? WHERE id = ?");
        // Urutan parameter dalam execute harus sesuai dengan urutan placeholder ?
        $stmt->execute([$gelombang, $ruang, $jenis_ujian, $keterangan, $id]);
    }
    
}

         

?>
