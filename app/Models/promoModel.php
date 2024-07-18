<?php
class promoModel
{
    private $pmb_promo;
    private $pmb_periode;
    private $varoption;
    private $db;
    public function __construct()
    {
        global $pmb_promo;
        global $pmb_periode;
        global $varoption;
        $this->pmb_promo = $pmb_promo;
        $this->pmb_periode = $pmb_periode;
        $this->varoption = $varoption;
        $this->db = Database::getInstance();
    }
    public function getPromo(){
        $query = "SELECT $this->pmb_promo.*, Prodi.var_value AS NamaProdi, Prodi.var_others AS JenjangProdi
                    FROM $this->pmb_promo
                    LEFT JOIN $this->varoption AS Prodi ON Prodi.recid = pmb_promo.pro_prodi AND Prodi.var_name = 'Prodi'"
                ;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPeriode()
    {
        $query = "SELECT Periode, Gelombang FROM $this->pmb_periode";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFakultas()
    {
        $query = "SELECT 
                    a.recid AS id_fakultas, 
                    a.var_value AS fakultas,
                    b.recid AS id_prodi,
                    b.var_value AS prodi,
                    b.var_others AS jenjang_prodi
                FROM 
                    $this->varoption a
                LEFT JOIN 
                    $this->varoption b ON b.parent = a.recid
                WHERE 
                    a.var_name = 'Fakultas'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertOrUpdatePromo($periode, $gelombang, $prodi, $name, $promo) {

        $stmt = $this->db->prepare("SELECT COUNT(*) AS count_data FROM $this->pmb_promo WHERE pro_periode = ? AND pro_gelombang = ? AND pro_prodi = ? AND pro_name = ?");
        $stmt->execute([$periode, $gelombang, $prodi, $name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count_data = $result['count_data'];

        if ($count_data > 0) {
            $stmt = $this->db->prepare("UPDATE $this->pmb_promo 
                      SET pro_value = ? 
                      WHERE pro_periode = ? 
                        AND pro_gelombang = ? 
                        AND pro_name = ? 
                        AND pro_prodi = ?");
            $stmt->execute([$promo, $periode, $gelombang, $name, $prodi]);
            return "Data updated successfully.";
        }
        else{
            $stmt = $this->db->prepare("INSERT INTO $this->pmb_promo (pro_periode, pro_gelombang, pro_prodi, pro_name, pro_value) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$periode, $gelombang, $prodi, $name, $promo]);
            return "Data inserted successfully.";
        }
        
    }

    public function deletePromo($res){
        $stmt = $this->db->prepare("DELETE FROM $this->pmb_promo WHERE pro_prodi = ? ");
        $stmt->execute([$res]);
        return "Data deleted successfully.";
    }
    



}
