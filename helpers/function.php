<?php
require_once __DIR__ . '/../models/logActivityModel.php';

    function log_activity($keteranan) {

        if (isset($_SESSION['user_id'])) {
            $logModel = new logActivityModel();
            $user_id = $_SESSION['user_id'];
            $now = date('Y-m-d H:i:s');
            $logModel->logActivity($user_id, $now, $keteranan);
        }
    }
?>