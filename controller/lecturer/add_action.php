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
    <title>Add Lecturer</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    if (isset($_POST['nip'])) {
        $checkNrp = "SELECT * FROM lecturers WHERE nip='$_POST[nip]'";
        $checkUser = "SELECT * FROM lecturers WHERE user_id='$_POST[user]'";
        $resultNrp = pg_query($connect, $checkNrp);
        $resultUser = pg_query($connect, $checkUser);

        if (pg_num_rows($resultNrp) != 0 || pg_num_rows($resultUser) != 0) {
            $message = 'NIP has been used!';
            if (pg_num_rows($resultUser) != 0) {
                $message = 'User has been used!';
            }
            echo '
    <script>
    $(document).ready(function() {
        swal({
            title: "Error",
            text: "' . $message . '",
            icon: "error",
        }).then((value) => {
            window.location = "../../lecturer_form.php";
    });
     });
    </script>';
        } else {
            $sql = "INSERT INTO lecturers
VALUES ('$_POST[nip]',
        '$_POST[user]',
        '$_POST[gender]',
        '$_POST[address]',
        '$_POST[department]'
        )";
            $query = pg_query($connect, $sql);
            if ($query && pg_affected_rows($query) > 0) {
                echo '
                        <script>
$(document).ready(function() {
swal({
    title: "Add Data",
    text: "Data has been added!",
    icon: "success",
}).then((value) => {
    window.location = "../../lecturer.php";
});
});
</script>';
            } else {
                echo '<script>
swal({
title: "Error",
text: "Query error!",
icon: "error",
});
</script>';
            }
        }
    }
    ?>
</body>

</html>