<?php


class eduPeriodeModel
{
    private $pmb_periode;
    private $pmb_tagihan;
    private $db;

    public function __construct(){
        global $pmb_periode;
        global $pmb_tagihan;

        $this->pmb_periode = $pmb_periode;
        $this->pmb_tagihan = $pmb_tagihan;
        $this->db = Database::getInstance();
    }
    public function getPeriode()
    {
        try {
            $query = "SELECT DISTINCT a.*, IF(b.periode IS NOT NULL, 'true', 'false') AS isInTagihan FROM $this->pmb_periode a LEFT JOIN $this->pmb_tagihan b ON b.periode = a.recid";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Kesalahan: " . $e->getMessage(), 0);
            return false;
        }
    }

    public function addPeriode($jenjang, $periode, $fromDate, $toDate, $keterangan, $status)
    {


        $query = "INSERT INTO $this->pmb_periode (Jenjang, Periode, fromDate, toDate, Keterangan, status) VALUES (?, ?, ?, ?, ?, ?)";

        try {

            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$jenjang, $periode, $fromDate, $toDate, $keterangan, $status]);

            if ($success) {
                return ['status' => 'success', 'message' => 'New record added successfully'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to add new record'];
            }
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }



    public function getPeriodeById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->pmb_periode WHERE recid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePeriode($recid, $jenjang, $periode, $fromDate, $toDate, $keterangan, $status)
    {

        try {
            $stmt = $this->db->prepare("UPDATE $this->pmb_periode SET Jenjang = ?, Periode = ?, fromDate = ?, toDate = ?, Keterangan = ?, status = ?  WHERE recid = ?");
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

        $query = "DELETE FROM $this->pmb_periode WHERE recid = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLastPeriode($jenjang)
    {
        $stmt = $this->db->prepare("SELECT ifnull(max(periode), 0) as lastPeriod FROM $this->pmb_periode where Jenjang=? and status = 'Open'");
        $stmt->execute([$jenjang]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
