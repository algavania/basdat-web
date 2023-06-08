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
    <title>Add Course</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    if (isset($_POST['name'])) {
        $id = $_SESSION['id'];
        $lecturerSql = "SELECT * FROM lecturers WHERE user_id=$id";
        $result = pg_query($connect, $lecturerSql);
        $row = pg_fetch_assoc($result);
        $lecturerId = $row['nip'];

        $sql = "INSERT INTO courses(lecturer_nip, name, major_id, created_at, closed_at)
VALUES (
        $lecturerId,
        '$_POST[name]',
        '$_POST[major]',
        CURRENT_TIMESTAMP,
        NULL
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
    window.location = "../../index.php";
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
    ?>
</body>

</html>