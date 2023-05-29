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
    <title>Edit Material</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    if (isset($_POST['title'])) {
        $materialId = $_POST['material_id'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $courseId = $_POST['course_id'];

        $resImage = false;
        $hasFile = !empty($_FILES['file']['name']);
        if ($hasFile) {
            $fileName = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $tmpName = $_FILES['file']['tmp_name'];

            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            if ($size > 2 * 1024 * 1024 && $extension != 'pdf') {
                $resImage = true;
            }
        } else
            $resImage = false;

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
                    window.location = "../../course/material.php?id=' . $courseId . '";
            });
             });
            </script>';
        } else {
            $sql = "UPDATE materials SET description='$description', title='$title' ";
            if ($hasFile) {
                $fileName = uniqid() . '.' . $extension;
                move_uploaded_file($tmpName, '../../files/materials/' . $fileName);
                $sql .= ",attachment='$fileName' ";
            }
            $sql .= " WHERE id=$materialId";
            $query = pg_query($connect, $sql);
            if ($query) {
                echo '
            <script>
            $(document).ready(function() {
                swal({
                    title: "Material",
                    text: "Material has been edited!",
                    icon: "success",
                }).then((value) => {
                    window.location = "../../course/material.php?id=' . $courseId . '";
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