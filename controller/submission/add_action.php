<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../dist/output.css?v=<?php echo time(); ?>">
    <title>Submit Submission</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    if (isset($_POST['submission_description'])) {
        $id = $_SESSION['id'];
        $courseId = $_POST['course_id'];
        $assignmentId = $_POST['assignment_id'];
        $description = $_POST['submission_description'];

        $resImage = false;
        $fileName = $_FILES['submission_file']['name'];
        $size = $_FILES['submission_file']['size'];
        $tmpName = $_FILES['submission_file']['tmp_name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($size > 2 * 1024 * 1024 && $extension != 'pdf') {
            $resImage = true;
        }

        $userSql = "SELECT * FROM students WHERE user_id=$id";
        $result = pg_query($connect, $userSql);
        $row = pg_fetch_assoc($result);

        if ($resImage) {
            $message = 'File size is too big. Maximum size is 2MB.';
            if ($extension != 'pdf')
                $message = 'File must be PDF!';
            echo '
            <script>
            $(document).ready(function() {
                swal({
                    title: "Error",
                    text: "' . $message . '",
                    icon: "error",
                }).then((value) => {
                    window.location = "../../course/assignment.php?id=' . $courseId . '";
            });
             });
            </script>';
        } else {
            $nrp = $row['nrp'];
            $fileName = $assignmentId . '_' . $nrp . '.' . $extension;
            move_uploaded_file($tmpName, '../../files/submissions/' . $fileName);
            $sql = "INSERT INTO submissions(student_nrp, assignment_id, description, attachment, grade, created_at, updated_at) VALUES (
                '$nrp',
                $assignmentId,
                '$description',
                '$fileName',
                NULL,
                CURRENT_TIMESTAMP,
                CURRENT_TIMESTAMP
            )";
            $query = pg_query($connect, $sql);
            if ($query) {
                echo '
            <script>
            $(document).ready(function() {
                swal({
                    title: "Submission",
                    text: "Submission has ben submitted!",
                    icon: "success",
                }).then((value) => {
                    window.location = "../../course/assignment.php?id=' . $courseId . '";
                });
             });
            </script>';
            } else {
                echo '
            <script>
            $(document).ready(function() {
                swal({
                    title: "Error",
                    text: "Query error!",
                    icon: "error",
                }).then((value) => {
                    window.location = "../../course/assignment.php?id=' . $courseId . '";
                });
             });
            </script>';
            }
        }
    } ?>
</body>

</html>