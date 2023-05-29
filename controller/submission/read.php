<?php
include "../../connect.php";
$isLecturer = checkIfLecturer();
$assignmentId = $_GET['id'];
$sql = "SELECT submissions.*, users.name AS student_name, courses.id AS course_id FROM submissions LEFT JOIN students ON students.nrp=submissions.student_nrp LEFT JOIN users ON users.id=students.user_id LEFT JOIN assignments ON assignments.id=submissions.assignment_id LEFT JOIN courses ON courses.id=assignments.course_id WHERE assignment_id=$assignmentId";
$query = pg_query($connect, $sql);
$result = pg_fetch_all($query);

$assignmentQuery = "SELECT * FROM assignments WHERE id=$assignmentId";
$assignmentResult = pg_query($connect, $assignmentQuery);
$row = pg_fetch_assoc($assignmentResult);
