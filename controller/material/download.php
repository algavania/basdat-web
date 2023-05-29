<?php
session_start();
if (!$_SESSION['login']) {
    header('Location: login.php');
    exit;
}
if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    $filePath = '../../files/materials/' . $fileName;
    if (file_exists($filePath)) {
        header('Cache-Control: public');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Content-Type: application/zip');
        header('Content-Transfer-Encoding: binary');
        readfile($filePath);
        exit;
    }
}
