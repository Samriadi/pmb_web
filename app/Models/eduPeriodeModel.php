<?php


class eduPeriodeModel
{
    public function getPeriode()
    {
        try {
            $db = Database::getInstance();
            $query = "SELECT * FROM pmb_periode";
            $stmt = $db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Kesalahan: " . $e->getMessage(), 0);
            return false;
        }
    }

    public function getPeriodeIsInTagihan($recid, $value)
    {
        try {
            $db = Database::getInstance();
            $query = "SELECT DISTINCT t2.Periode AS Periode, CASE WHEN t1.periode IS NOT NULL THEN 'true' ELSE 'false' END AS is_in_tagihan FROM pmb_periode t2 LEFT JOIN tagihan t1 ON t2.Periode = t1.periode WHERE t2.recid = ? AND t2.Periode = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$recid, $value]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result) {
                return $result->is_in_tagihan;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Kesalahan: " . $e->getMessage(), 0);
            return false; // Atau kembalikan nilai lain sesuai kebutuhan
        }
    }


    public function addPeriode($jenjang, $periode, $fromDate, $toDate, $keterangan, $status)
    {
        $db = Database::getInstance();

        $query = "INSERT INTO pmb_periode (Jenjang, Periode, fromDate, toDate, Keterangan, status) VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $db->beginTransaction();

            $stmt = $db->prepare($query);
            $success = $stmt->execute([$jenjang, $periode, $fromDate, $toDate, $keterangan, $status]);

            if ($success) {
                $db->commit();
                return ['status' => 'success', 'message' => 'New record added successfully'];
            } else {
                $db->rollBack();
                return ['status' => 'error', 'message' => 'Failed to add new record'];
            }
        } catch (PDOException $e) {
            $db->rollBack();
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $db->rollBack();
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }



    public function getPeriodeById($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pmb_periode WHERE recid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePeriode($recid, $jenjang, $periode, $fromDate, $toDate, $keterangan, $status)
    {
        $db = Database::getInstance();

        try {
            $stmt = $db->prepare("UPDATE pmb_periode SET Jenjang = ?, Periode = ?, fromDate = ?, toDate = ?, Keterangan = ?, status = ?  WHERE recid = ?");
            $stmt->execute([$jenjang, $periode, $fromDate, $toDate, $keterangan, $status, $recid]);
            return ['status' => 'success', 'message' => 'Record updated successfully'];
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }


    public function deletePeriode($id)
    {
        $db = Database::getInstance();

        $query = "DELETE FROM pmb_periode WHERE recid = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLastPeriode($jenjang)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT ifnull(max(periode), 0) as lastPeriod FROM pmb_periode where Jenjang=? and status = 'Open'");
        $stmt->execute([$jenjang]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
