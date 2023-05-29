<!DOCTYPE html>
<html lang="en">

<?php
include "connect.php";

session_start();
if (!$_SESSION['login']) {
    header('Location: login.php');
    exit;
}

include "./middleware/roles.php";
checkRoleAccess([4]);

$listSql = "SELECT * FROM departments";
$userSql = "SELECT * FROM users WHERE role=3";
$userQuery = pg_query($connect, $userSql);
$listQuery = pg_query($connect, $listSql);
$resultQuery = pg_fetch_all($listQuery);
$resultUser = pg_fetch_all($userQuery);

$text = 'Add Lecturer';
$postUrl = 'controller/lecturer/add_action.php';
$nrp = '';
$user = '';
$gender = '';
$department = '';
$email = '';
$address = '';
if (isset($_GET['nip'])) {
    $text = 'Edit Lecturer';
    $postUrl = 'controller/lecturer/update_action.php';
    $nrp = $_GET['nip'];
    $checkNrp = "SELECT * FROM lecturers WHERE nip='$nrp'";
    $result = pg_query($connect, $checkNrp);
    $resNrp = pg_num_rows($result) == 0;
    if ($resNrp) {
        header("Location: student.php");
        return;
    }
    $row = pg_fetch_array($result);
    $user = $row['user_id'];
    $gender = $row['gender'];
    $department = $row['department_id'];
    $address = $row['address'];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/output.css?v=<?php echo time(); ?>">
    <title><?php echo $text ?></title>
</head>

<body class="w-full h-screen bg-[#F6F9FE]">
    <div class="mx-auto sm:w-3/4 lg:w-2/4 h-full bg-white relative">
        <div class="bg-primary w-full px-8 py-6 relative">
            <div class="font-bold text-xl text-white text-center">Lecturer Form</div>
        </div>
        <div class="ml-6">
            <a type="button" href="lecturer.php" class="rounded-full absolute top-4 bg-white p-5">
                <svg class="text-primary absolute top-0 bottom-0 left-0 right-0 mx-auto my-auto h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z" />
                </svg>
            </a>
        </div>
        <div class="px-8 py-6">
            <form method="POST" action="<?php echo $postUrl ?>">
                <input class="hidden" value="<?php echo $nrp; ?>" name="nip_awal">
                <input class="hidden" value="<?php echo $user; ?>" name="user_awal">

                <div class="grid gap-6 mb-10 md:grid-cols-2">
                    <div>
                        <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 text-black">NIP</label>
                        <input value="<?php echo $nrp; ?>" type="text" pattern="[0-9]{18}" name="nip" id="nip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="user" class="block mb-2 text-sm font-medium text-gray-900 text-black">User</label>
                        <select required id="user" name="user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php foreach ($resultUser as $row) : ?>
                                        <option <?php echo $row['id'] == $user ? 'selected' : '' ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 text-black">Gender</label>
                        <select required id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option <?php if ($gender == 'Male') :
                                        echo 'selected';
                                    endif;
                                    ?> value="Male">Male</option>
                            <option <?php if ($gender == 'Female') :
                                        echo 'selected';
                                    endif;
                                    ?> value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 text-black">Department</label>
                        <select required id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php foreach ($resultQuery as $row) : ?>
                                        <option <?php echo $row['id'] == $department ? 'selected' : '' ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 text-black">Address</label>
                        <input value="<?php echo $address; ?>" name="address" type="text" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                </div>
                <div class="w-full flex place-content-center">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg font-bold w-full sm:w-64 px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?php echo $text ?>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

    <script>
        const nrpInput = document.getElementById("nip");
        nrpInput.addEventListener("input", function(event) {
            if (nrpInput.validity.patternMismatch) {
                nrpInput.setCustomValidity("Please enter a valid NIP (18-digit number)");
            } else {
                nrpInput.setCustomValidity("");
            }
        });
    </script>

</body>

</html>