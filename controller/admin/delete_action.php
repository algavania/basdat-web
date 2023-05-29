<?php
include '../../connect.php';
session_start();
include "../../middleware/roles.php";
checkAuthMiddleware(false);
$nrp = $_GET['nrp'];
$sql = "DELETE from mahasiswa WHERE nrp='$nrp'";
$query = pg_query($connect, $sql);
header("location:../../student.php");
