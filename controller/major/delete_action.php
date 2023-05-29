<?php 
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    $id = $_GET['id'];
    $sql = "DELETE from majors WHERE id='$id'";    
    $query = pg_query($connect, $sql);
    header("location:../../major.php");
?>