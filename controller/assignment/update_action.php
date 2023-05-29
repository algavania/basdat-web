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
    <title>Edit Assignment</title>
</head>

<body>
    <?php
    include '../../connect.php';
    session_start();
    include "../../middleware/roles.php";
    checkAuthMiddleware(false);
    $id = $_POST['id'];

    $sql = "UPDATE assignments SET
    assignment_type='$_POST[assignment]', 
    title='$_POST[title]',
    description='$_POST[description]',
    deadline='$_POST[deadline]'
WHERE id=$id";
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
    window.location = "../../course/assignment.php?id='.$_POST['course_id'].'";
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
window.location = "../../index.php";
});
});
</script>';
    } ?>
</body>

</html>