<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!$_SESSION['login']) {
    header('Location: login.php');
    exit;
}
include "./middleware/roles.php";
checkRoleAccess([4]);

include "connect.php";
$text = 'Add Admin';
$postUrl = 'controller/admin/add_action.php';
$name = '';
$email = '';
$id = '';
$password = '';
$photo = 'assets/profile.png';
$disabled = false;
if (isset($_GET['id'])) {
    $disabled = $_SESSION['id'] == $_GET['id'];
    $text = 'Edit User';
    $postUrl = 'controller/admin/update_action.php';
    $id = $_GET['id'];
    $checkNrp = "SELECT * FROM users WHERE id='$id'";
    $result = pg_query($connect, $checkNrp);
    $resNrp = pg_num_rows($result) == 0;
    if ($resNrp) {
        header("Location: student.php");
        return;
    }
    $row = pg_fetch_array($result);
    $name = $row['name'];
    $email = $row['email'];
    $role = $row['role'];
    if ($row['photo'] != null) {
        $photo = $row['photo'];
        $photo = 'img/users/' . $photo;
    }
} else {
    header('Location: admin.php');
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
            <div class="font-bold text-xl text-white text-center">User Form</div>
        </div>
        <div class="ml-6">
            <a type="button" href="admin.php" class="rounded-full absolute top-4 bg-white p-5">
                <svg class="text-primary absolute top-0 bottom-0 left-0 right-0 mx-auto my-auto h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z" />
                </svg>
            </a>
        </div>
        <div class="px-8 py-6">
            <form id="form" method="POST" action="<?php echo $postUrl ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="relative mx-auto mb-10 " style="height: 12rem; width: 12rem;">
                    <img id="profile-image" src="<?php echo $photo ?>" class="w-full h-full rounded-full" alt="Profile">
                    <div class="absolute top-0 right-0">
                        <div id="edit-image" class="h-12 w-12 p-3 rounded-full bg-primary cursor-pointer">
                            <svg class="w-full h-full fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="absolute top-0 transform translate-y-10 left-0">
                        <a href="controller/admin/download.php?file=<?php echo basename($photo) ?>">
                            <div id="download-image" class="h-12 w-12 p-3 rounded-full bg-green-500 cursor-pointer">
                                <svg class="w-full h-full fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M13,5V11H14.17L12,13.17L9.83,11H11V5H13M15,3H9V9H5L12,16L19,9H15V3M19,18H5V20H19V18Z" />
                                </svg>
                            </div>
                        </a>
                    </div>

                </div>
                <input class="hidden" type="file" id="file_input" name="photo" accept="image/png, image/jpeg, image/jpg">

                <input class="hidden" value="<?php echo $email; ?>" name="email_awal">
                <input class="hidden" value="<?php echo $id; ?>" name="id">

                <div class="grid gap-6 mb-10 md:grid-cols-2 px-8">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 text-black">Full Name</label>
                        <input value="<?php echo $name; ?>" type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 text-black">Email</label>
                        <input value="<?php echo $email; ?>" name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 text-black">Role</label>
                        <select id="role" <?php echo $disabled ? 'disabled' : '' ?> name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option <?php if ($role == 1) :
                                        echo 'selected';
                                    endif;
                                    ?> value="1">Guest</option>
                            <option <?php if ($role == 2) :
                                        echo 'selected';
                                    endif;
                                    ?> value="2">Student</option>
                            <option <?php if ($role == 3) :
                                        echo 'selected';
                                    endif;
                                    ?> value="3">Lecturer</option>
                            <option <?php if ($role == 4) :
                                        echo 'selected';
                                    endif;
                                    ?> value="4">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex place-content-center">
                    <button onclick="enableField()" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg font-bold w-full sm:w-64 px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?php echo $text ?>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        const fileInput = document.getElementById('file_input');
        const label = document.getElementById('edit-image');
        const preview = document.getElementById('profile-image');
        var isChange = false;

        label.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            const selectedFile = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                preview.src = reader.result;
                isChange = true;
                checkImage();
            });

            reader.readAsDataURL(selectedFile);
        });

        const downloadImage = document.getElementById("download-image");
        checkImage();

        function checkImage() {
            const photo = '<?php echo $photo; ?>';
            console.log(photo);
            if (photo == 'assets/profile.png' || isChange) {
                downloadImage.classList.add('hidden');
            } else {
                downloadImage.classList.remove('hidden');
            }
            console.log('check image', photo, isChange);
        }


        function enableField() {
            document.getElementById("role").disabled = false;
        }

        function validateForm() {
            const photo = '<?php echo $photo; ?>';
            if (fileInput.files.length === 0 && photo == 'assets/profile.png') {
                swal({
                    title: "Error",
                    text: "Please upload a photo!",
                    icon: "error",
                });
                document.getElementById("role").disabled = true;
                return false;
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
</body>

</html>