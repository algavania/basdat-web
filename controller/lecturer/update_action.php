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
    <title>Edit Lecturer</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    $nrp = $_POST['nip'];
    $nrpAwal = $_POST['nip_awal'];
    $major = $_POST['department'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $user = $_POST['user'];
    $userAwal = $_POST['user_awal'];

    $checkNrp = "SELECT * FROM lecturers WHERE nip='$_POST[nip]'";
    $checkUser = "SELECT * FROM lecturers WHERE user_id='$_POST[user]'";
    $resultNrp = pg_num_rows(pg_query($connect, $checkNrp)) != 0 && $nrp != $nrpAwal;
    $resultUser = pg_num_rows(pg_query($connect, $checkUser)) != 0 && $user != $userAwal;


    if ($resultNrp) {
        if ($resultNrp) {
            $message = 'NIP has been used!';
        }
        echo '
        <script>
        $(document).ready(function() {
            swal({
                title: "Error",
                text: "' . $message . '",
                icon: "error",
            }).then((value) => {
                window.location = "../student_form.php?nrp=' . $nrpAwal . '";
        });
         });
        </script>';
    } else {
        $sql = "UPDATE lecturers SET nip='$nrp',
                                    user_id='$user',
                                    gender='$gender',
                                    department_id='$major',
                                    address='$address'
                WHERE nip='$nrpAwal'";
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
                window.location = "../../lecturer.php";
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
                window.location = "../../lecturer.php";
            });
         });
        </script>';
        }
    } ?>
</body>

</html>