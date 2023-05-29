<?php
function checkRoleAccess($requiredRoles)
{
    $userRole = $_SESSION['role'];

    redirectRole();

    if (in_array($userRole, $requiredRoles)) {
        // User has the required role, allow access
        return true;
    } else {
        // User does not have the required role, redirect or handle the access denial
        header("Location: error.php");
        exit;
    }
}

function checkRole($requiredRoles)
{
    $userRole = $_SESSION['role'];

    $condition = checkIfHaveInformation();
    if ($userRole == 4) $condition = true;

    if (in_array($userRole, $requiredRoles) && $condition) {
        return true;
    } else {
        return false;
    }
}

function checkIfLecturer()
{
    return $_SESSION['role'] == 3;
}

function checkIfGuest()
{
    return $_SESSION['role'] == 1 || (!checkIfHaveInformation() && $_SESSION['role'] != 4);
}

function checkIfHaveInformation()
{
    $host = "localhost";
    $port = "5432";
    $dbname = "elearning";
    $user = "postgres";
    $password = "password";

    $connect = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    $id = $_SESSION['id'];
    $query = "SELECT * FROM lecturers WHERE user_id='$id'";
    $query2 = "SELECT * FROM students WHERE user_id='$id'";
    $res = pg_query($connect, $query);
    $res2 = pg_query($connect, $query2);
    $row = pg_fetch_assoc($res);
    $row2 = pg_fetch_assoc($res2);
    return $row || $row2;
}

function redirectRole()
{
    if (!checkIfHaveInformation() && $_SESSION['role'] != 4) {
        header("Location: guest.php");
        exit;
    }
}

function checkAuthMiddleware($isFromAuthPage)
{
    if (isset($_SESSION['login']) || isset($_COOKIE['login'])) {
        if (isset($_COOKIE['login'])) {
            $_SESSION['login'] = $_COOKIE['login'];
            $_SESSION['id'] = $_COOKIE['id'];
            $_SESSION['role'] = $_COOKIE['role'];
        }
        if ($isFromAuthPage) {
            header('Location: index.php');
            exit;
        }
    } else {
        if (!$isFromAuthPage) {
            header('Location: login.php');
            exit;
        }
    }
}
