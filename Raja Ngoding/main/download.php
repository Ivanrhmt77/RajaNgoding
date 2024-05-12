<?php
include '../library/config.php';
include '../library/opendb.php';

if (isset($_GET['file'])) {
    $filepath = urldecode($_GET['file']);

    $filename = basename($filepath);

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush();
        readfile($filepath);
        exit;
    }
}

include '../library/closedb.php';
