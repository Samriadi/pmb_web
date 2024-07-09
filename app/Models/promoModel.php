<?php
class promoModel
{

    public function getPromo(){
        $db = Database::getInstance();
        $query = "SELECT pmb_promo.*, Prodi.var_value AS NamaProdi, Prodi.var_others AS JenjangProdi
                    FROM pmb_promo
                    LEFT JOIN varoption AS Prodi ON Prodi.recid = pmb_promo.pro_prodi AND Prodi.var_name = 'Prodi'"
                ;
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPeriode()
    {
        $db = Database::getInstance();
        $query = "SELECT Periode, Gelombang FROM pmb_periode";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFakultas()
    {
        $db = Database::getInstance();
        $query = "SELECT 
                    a.recid AS id_fakultas, 
                    a.var_value AS fakultas,
                    b.recid AS id_prodi,
                    b.var_value AS prodi,
                    b.var_others AS jenjang_prodi
                FROM 
                    varoption a
                LEFT JOIN 
                    varoption b ON b.parent = a.recid
                WHERE 
                    a.var_name = 'Fakultas'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertOrUpdatePromo($periode, $gelombang, $prodi, $name, $promo) {
        $db = Database::getInstance();

        $stmt = $db->prepare("SELECT COUNT(*) AS count_data FROM pmb_promo WHERE pro_periode = ? AND pro_gelombang = ? AND pro_prodi = ? AND pro_name = ?");
        $stmt->execute([$periode, $gelombang, $prodi, $name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count_data = $result['count_data'];

        if ($count_data > 0) {
            $stmt = $db->prepare("UPDATE pmb_promo 
                      SET pro_value = ? 
                      WHERE pro_periode = ? 
                        AND pro_gelombang = ? 
                        AND pro_name = ? 
                        AND pro_prodi = ?");
            $stmt->execute([$promo, $periode, $gelombang, $name, $prodi]);
            return "Data updated successfully.";
        }
        else{
            $stmt = $db->prepare("INSERT INTO pmb_promo (pro_periode, pro_gelombang, pro_prodi, pro_name, pro_value) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$periode, $gelombang, $prodi, $name, $promo]);
            return "Data inserted successfully.";
        }
        
    }
    



}
