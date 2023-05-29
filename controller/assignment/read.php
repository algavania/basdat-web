<?php
include "../connect.php";
$id = $_SESSION['id'];
$courseId = $_GET['id'];

$sql = "SELECT *, assignments.id AS assignment_id, assignment_type.name AS assignment_name, 
       (SELECT COUNT(DISTINCT student_nrp)
        FROM submissions
        WHERE submissions.assignment_id = assignments.id) AS total_submissions,
        (SELECT COUNT(DISTINCT student_nrp)
        FROM enrollments
        WHERE enrollments.course_id = courses.id) AS total_students_enrolled
FROM assignments 
LEFT JOIN assignment_type ON assignment_type.id=assignments.assignment_type
LEFT JOIN courses ON courses.id=assignments.course_id 
WHERE assignments.course_id=$courseId
ORDER BY assignments.id";

if (!checkIfLecturer()) {
    $studentSql = "SELECT * FROM students WHERE user_id=$id";
    $result = pg_query($connect, $studentSql);
    $row = pg_fetch_assoc($result);
    $nrp = $row['nrp'];

    $sql = "SELECT assignments.*, 
    assignment_type.name AS assignment_name,
    submissions.updated_at AS submitted_at,
    submissions.attachment AS attachment,
    submissions.description AS submission_description,
    submissions.id AS submission_id,
    CASE WHEN submissions.id IS NULL THEN 0 ELSE 1 END AS has_submission,
    submissions.grade AS grade
    FROM assignments
    LEFT JOIN assignment_type ON assignment_type.id = assignments.assignment_type
    LEFT JOIN submissions ON assignments.id = submissions.assignment_id AND submissions.student_nrp = '$nrp'
    WHERE assignments.course_id=$courseId
    ORDER BY assignments.id;
    ";
}

$listSql = "SELECT * FROM assignment_type ORDER BY id";
$query = pg_query($connect, $sql);
$listQuery = pg_query($connect, $listSql);
$resultQuery = pg_fetch_all($listQuery);
$result = pg_fetch_all($query);

$courseQuery = "SELECT * FROM courses WHERE id=" . $_GET['id'];
$courseResult = pg_query($connect, $courseQuery);
$row = pg_fetch_assoc($courseResult);
