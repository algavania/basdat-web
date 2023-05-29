<?php
session_start();
session_destroy();
setcookie('login', '', 0, '/');
setcookie('id', '', 0, '/');
setcookie('role', '', 0, '/');
header('Location: ../../login.php');
