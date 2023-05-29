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
    <title>Edit Submission</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $assignmentId = $_POST['assignment_id'];
        $grade = $_POST['grade'];

        $sql = "UPDATE submissions SET grade=$grade WHERE id=$id";
        $query = pg_query($connect, $sql);
        if ($query) {
            echo '
            <script>
            $(document).ready(function() {
                swal({
                    title: "Submission",
                    text: "Submission has ben graded!",
                    icon: "success",
                }).then((value) => {
                    window.location = "../../course/detail/submission.php?id=' . $assignmentId . '";
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
                    window.location = "../../course/detail/submission.php?id=' . $assignmentId . '";
                });
             });
            </script>';
        }
    } ?>
</body>

</html>