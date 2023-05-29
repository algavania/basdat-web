<?php 
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
echo '<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>';
$host = "localhost";
$port = "5432";
$dbname = "elearning";
$user = "postgres";
$password = "password";

$connect = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$connect) {
    echo "Connection failed: " . pg_last_error();
    exit;
}
 
?>  