<?php
require_once __DIR__ . '/../models/logActivityModel.php';

function log_activity($keterangan)
{

    if (isset($_SESSION['usr_name'])) {
        $logModel = new logActivityModel();
        $usr_name = $_SESSION['usr_name'];
        $now = date('Y-m-d H:i:s');
        $logModel->logActivity($usr_name, $now, $keterangan);
    }
}
function generateSecureRandomID($length = 9)
{
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $result .= random_int(0, 9);
    }
    return $result;
}

function checkIDExists($id)
{
    $db = Database::getInstance();

    $query = "SELECT COUNT(*) FROM pmb_pembayaran WHERE va_number = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);

    $count = $stmt->fetchColumn();
    return $count;
}

function is_superadmin()
{
    return isset($_SESSION['level_loged']) && $_SESSION['level_loged'] == 'superadmin';
}

function check_login_session()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";

    if (!isset($_SESSION['user_loged'])) {
        header('Location: /admin/login');
        exit();
    }
}
