<?php
require_once __DIR__ . '/../models/logActivityModel.php';

function log_activity($keterangan)
{

    if (isset($_SESSION['user_id'])) {
        $logModel = new logActivityModel();
        $user_id = $_SESSION['user_id'];
        $now = date('Y-m-d H:i:s');
        $logModel->logActivity($user_id, $now, $keterangan);
    }
}
function generateSecureRandomID($length = 9) {
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        // Menghasilkan angka acak antara 0 dan 9
        $result .= random_int(0, 9);
    }
    return $result;
}

function checkIDExists($id) {
    $db = Database::getInstance();

    $query = "SELECT COUNT(*) FROM pmb_pembayaran WHERE va_number = ?"; 
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);

    // Menggunakan $stmt bukan $query untuk fetchColumn
    $count = $stmt->fetchColumn();
    // Mengembalikan jumlah record, bukan boolean
    return $count;
}