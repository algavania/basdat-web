<?php
include "connect.php";
$isLecturer = checkIfLecturer();
$sql = "SELECT courses.closed_at AS closed_at, courses.id AS course_id, courses.name AS course_name, majors.id AS major_id, majors.name AS major_name, users.name AS lecturer_name,
        (SELECT COUNT(*) FROM enrollments WHERE enrollments.course_id = courses.id) AS total_students
        FROM courses
        LEFT JOIN lecturers ON lecturers.nip = courses.lecturer_nip
        LEFT JOIN users ON users.id = lecturers.user_id
        LEFT JOIN majors ON majors.id = courses.major_id";

$id = $_SESSION['id'];
if ($isLecturer) {
        $lecturerSql = "SELECT * FROM lecturers WHERE user_id=$id";
        $result = pg_query($connect, $lecturerSql);
        $row = pg_fetch_assoc($result);
        $lecturerDepartmentId = $row['department_id'];
        $listSql = "SELECT * FROM majors WHERE department_id=$lecturerDepartmentId OR id=0 ORDER BY id";
        $listQuery = pg_query($connect, $listSql);
        $resultQuery = pg_fetch_all($listQuery);
} else {
        $studentSql = "SELECT * FROM students WHERE user_id=$id";
        $result = pg_query($connect, $studentSql);
        $row = pg_fetch_assoc($result);
        $nrp = $row['nrp'];
        $sql = "SELECT enrollments.id AS enrollment_id, c.id AS course_id, c.name AS course_name, users.name AS lecturer_name, majors.id AS major_id, majors.name AS major_name, closed_at, COUNT(a.id) AS total_assignments FROM courses AS c
        LEFT JOIN enrollments ON enrollments.course_id = c.id
        LEFT JOIN lecturers ON lecturers.nip = c.lecturer_nip
        LEFT JOIN users ON users.id = lecturers.user_id
        LEFT JOIN majors ON majors.id = c.major_id
        LEFT JOIN assignments AS a ON c.id = a.course_id
        LEFT JOIN submissions AS s ON a.id = s.assignment_id
        ";
        $activeSql = '' . $sql . "
        WHERE c.id NOT IN (
                SELECT course_id
                FROM enrollments
                WHERE student_nrp = '$nrp'
            )
        GROUP BY c.id";
        $sql .= "
        LEFT JOIN enrollments AS e ON c.id = e.course_id AND e.student_nrp = '$nrp'
        WHERE enrollments.student_nrp = '$nrp'
        AND
        c.closed_at IS NULL
        GROUP BY c.id
        ";
        $inactiveCoursesSql = "SELECT e.id AS enrollment_id, c.id AS course_id, c.name AS course_name, users.name AS lecturer_name, majors.id AS major_id, majors.name AS major_name, closed_at, COUNT(a.id) AS total_assignments 
        FROM courses AS c
        LEFT JOIN lecturers ON lecturers.nip = c.lecturer_nip
        LEFT JOIN users ON users.id = lecturers.user_id
        LEFT JOIN majors ON majors.id = c.major_id
        LEFT JOIN assignments AS a ON c.id = a.course_id
        LEFT JOIN submissions AS s ON a.id = s.assignment_id
        JOIN enrollments AS e ON c.id = e.course_id AND e.student_nrp = '$nrp'
        WHERE c.closed_at < NOW()
        GROUP BY c.id
        ";

        $query = pg_query($connect, $activeSql);
        $activeCoursesResult = pg_fetch_all($query);

        $query = pg_query($connect, $inactiveCoursesSql);
        $inactiveCoursesResult = pg_fetch_all($query);
}

$query = pg_query($connect, $sql);
$result = pg_fetch_all($query);
