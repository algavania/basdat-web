<?php
include "../connect.php";
$courseId = $_GET['id'];

$listSql = "SELECT * FROM materials WHERE course_id=$courseId ORDER BY id";
$listQuery = pg_query($connect, $listSql);
$result = pg_fetch_all($listQuery);

$courseQuery = "SELECT * FROM courses WHERE id=" . $_GET['id'];
$courseResult = pg_query($connect, $courseQuery);
$row = pg_fetch_assoc($courseResult);
