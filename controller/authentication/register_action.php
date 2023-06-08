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
    <title>Register</title>
</head>

<body>
    <?php
    include '../../connect.php';

    $message = 'Error';
    if (isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $result = pg_query($connect, "SELECT * FROM users WHERE email='$email'");
        if (pg_num_rows($result) === 1) {
            $message = 'Email has been used!';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            pg_query($connect, "INSERT INTO users(name,email,password,role,photo) VALUES('$name', '$email', '$password', '1', NULL)");
            echo '
<script>
$(document).ready(function() {
swal({
    title: "Success",
    text: "Registration success!",
    icon: "success",                                
    }).then((value) => {
    window.location = "../../login.php";
});
});
</script>';
            return;
        }
        echo '
        <script>
        $(document).ready(function() {
        swal({
            title: "Error",
            text: "'.$message.'",
            icon: "error",                                
            }).then((value) => {
            window.location = "../../register.php";
        });
        });
        </script>';
        
    }

    ?>
</body>

</html>