<?php
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

if (!in_array($status, ['Verified', 'Unverified'])) {
    die('Status tidak valid');
}

echo "Status berhasil diupdate.";
