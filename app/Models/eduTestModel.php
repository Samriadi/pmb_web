<?php


class eduTestModel
{

    private $varoption;
    private $pmb_test;
    private $pmb_periode;
    private $db;

    public function __construct(){
        global $varoption;
        global $pmb_test;
        global $pmb_periode;
        $this->varoption = $varoption;
        $this->pmb_test = $pmb_test;
        $this->pmb_test = $pmb_periode;
        $this->db = Database::getInstance();
    }
    public function getTest()
    {
        $query = "SELECT
                (SELECT if(a.ruang = c.recid,c.var_value,'no') FROM $this->varoption c WHERE c.recid = a.ruang) ruang,
                (SELECT if(a.jenis_ujin = d.recid,d.var_value,'no') FROM $this->varoption d WHERE d.recid = a.jenis_ujin) ujian,
                a.id,
                a.keterangan ket_edu,
                b.Jenjang,
                b.Keterangan ket_periode,
                b.status 
                FROM $this->pmb_test a 
                JOIN $this->pmb_periode b ON b.recid = a.gelombang;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addTest($gelombang, $ruang, $jenis_ujin, $keterangn)
    {

        $query = "INSERT INTO $this->pmb_test (gelombang, ruang, jenis_ujin, keterangan) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$gelombang, $ruang, $jenis_ujin, $keterangn]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //get gelombang
    public function getGelombang()
    {
        $query = "SELECT * FROM $this->pmb_periode WHERE status='Open'";
        $stmt = $this->db->prepare($query);
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
        $query = "SELECT * FROM $this->varoption where var_name='Ruang'";
        $stmt = $this->db->prepare($query);
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
        $query = "SELECT * FROM $this->varoption where var_name='Ujian'";
        $stmt = $this->db->prepare($query);
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
        $query = "DELETE FROM $this->pmb_test WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getTestById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->pmb_test WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTest($id, $gelombang, $ruang, $jenis_ujin, $keterangan)
    {
        $stmt = $this->db->prepare("UPDATE $this->pmb_test SET gelombang = ?, ruang = ?, jenis_ujin = ?, keterangan = ? WHERE id = ?");
        $stmt->execute([$gelombang, $ruang, $jenis_ujin, $keterangan, $id]);
    }
}
