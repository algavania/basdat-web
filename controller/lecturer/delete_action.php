<?php 
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    $nrp = $_GET['nip'];
    $sql = "DELETE from lecturers WHERE nip='$nrp'";    
    $query = pg_query($connect, $sql);
    header("location:../../student.php");
?>