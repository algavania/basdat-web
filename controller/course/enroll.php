<?php
include '../../connect.php';
session_start();
include "../../middleware/roles.php";
checkAuthMiddleware(false);
$id = $_GET['id'];
$userId = $_SESSION['id'];

$studentSql = "SELECT * FROM students WHERE user_id=$userId";
$result = pg_query($connect, $studentSql);
$row = pg_fetch_assoc($result);
$nrp = $row['nrp'];

$sql = "INSERT INTO enrollments VALUES (
        '',
        $nrp,
        $id,
        CURRENT_TIMESTAMP
    )";
$query = pg_query($connect, $sql);
header("location:../../index.php");
