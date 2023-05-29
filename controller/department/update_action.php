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
    <link rel="stylesheet" href="../dist/output.css?v=<?php echo time(); ?>">
    <title>Edit Student</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    $id = $_POST['id'];
    $name = $_POST['name'];

    $checkName = "SELECT * FROM departments WHERE name='$name'";
    $resultName = pg_query($connect, $checkName);
    $resName = pg_num_rows($resultName) != 0;

    if ($resName) {
        $message = 'Department Name has been used.';
        echo '
        <script>
        $(document).ready(function() {
            swal({
                title: "Error",
                text: "' . $message . '",
                icon: "error",
            }).then((value) => {
                window.location = "../department.php";
        });
         });
        </script>';
    } else {
        $sql = "UPDATE departments SET
                                    name='$name'
                WHERE id='$id'";
        $query = pg_query($connect, $sql);
        if ($query) {
            echo '
        <script>
        $(document).ready(function() {
            swal({
                title: "Edit Data",
                text: "Data has been edited!",
                icon: "success",
            }).then((value) => {
                window.location = "../../department.php";
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
                window.location = "../../student.php";
            });
         });
        </script>';
        }
    } ?>
</body>

</html>