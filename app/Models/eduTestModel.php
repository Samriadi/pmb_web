<?php

require_once __DIR__ . '/../Core/Database.php';

class eduTestModel
{
    //jadwal test	
    public function getTest()
    {
        $db = Database::getInstance();
        $query = "SELECT
                (SELECT if(a.ruang = c.recid,c.var_value,'no') FROM varoption c WHERE c.recid = a.ruang) ruang,
                (SELECT if(a.jenis_ujin = d.recid,d.var_value,'no') FROM varoption d WHERE d.recid = a.jenis_ujin) ujian,
                a.id,
                a.keterangan ket_edu,
                b.Jenjang,
                b.Keterangan ket_periode,
                b.status 
                FROM pmb_test a 
                JOIN pmb_periode b ON b.recid = a.gelombang;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addTest($gelombang, $ruang, $jenis_ujin, $keterangn)
    {
        $db = Database::getInstance();

        $query = "INSERT INTO pmb_test (gelombang, ruang, jenis_ujin, keterangan) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$gelombang, $ruang, $jenis_ujin, $keterangn]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //get gelombang
    public function getGelombang()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM pmb_periode WHERE status='Open'";
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
    public function getRuang()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM varoption where var_name='Ruang'";
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
    public function getUjian()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM varoption where var_name='Ujian'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $values = [];
        foreach ($data as $item) {
            $values[] = [
                'recid' => $item->recid,
                'jenis_ujin' => $item->var_value
            ];
        }
        return $values;
    }

    public function deleteTest($id)
    {
        $db = Database::getInstance();

        $query = "DELETE FROM pmb_test WHERE id = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getTestById($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pmb_test WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTest($id, $gelombang, $ruang, $jenis_ujin, $keterangan)
    {
        $db = Database::getInstance();

        // Menggunakan prepared statement dengan placeholder ?
        $stmt = $db->prepare("UPDATE pmb_test SET gelombang = ?, ruang = ?, jenis_ujin = ?, keterangan = ? WHERE id = ?");
        // Urutan parameter dalam execute harus sesuai dengan urutan placeholder ?
        $stmt->execute([$gelombang, $ruang, $jenis_ujin, $keterangan, $id]);
    }
}
