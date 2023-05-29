<?php
include "../connect.php";
$id = $_GET['id'];
$courseQuery = "SELECT * FROM courses WHERE id=$id";
$courseResult = pg_query($connect, $courseQuery);
$courseRow = pg_fetch_assoc($courseResult);
