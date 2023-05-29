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
    <title>Edit User</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    $email = $_POST['email'];
    $emailAwal = $_POST['email_awal'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $resImage = false;
    $fileName = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
    $tmpName = $_FILES['photo']['tmp_name'];

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $resultEmail = pg_query($connect, $checkEmail);
    $resEmail = pg_num_rows($resultEmail) != 0 && $email != $emailAwal;
    $row = pg_fetch_assoc($resultEmail);
    $id = $_POST['id'];

    
    if ($size > 2 * 1024 * 1024) {
        $resImage = true;
    }

    if ($resEmail || $resImage) {
        $message = 'Email has been used!';
        if ($resImage) {
            $message = 'Image size is too big. Maximum size is 2MB.';
        }
        echo '
        <script>
        $(document).ready(function() {
            swal({
                title: "Error",
                text: "' . $message . '",
                icon: "error",
            }).then((value) => {
                window.location = "../admin_form.php?id=' . $id . '";
        });
         });
        </script>';
    } else {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = $_POST['id'] . '.' . $extension;
        move_uploaded_file($tmpName, '../../img/users/'.$fileName);
        $sql = "UPDATE users SET
                                    name='$name',
                                    email='$email',
                                    role='$role',
                                    photo='$fileName'
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
                window.location = "../../admin.php";
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
                window.location = "../../admin.php";
            });
         });
        </script>';
        }
    } ?>
</body>

</html>