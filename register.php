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
    <link rel="stylesheet" href="dist/output.css?v=<?php echo time(); ?>">
    <title>Register</title>
</head>

<body class="h-screen">
    <?php
    session_start();
    include "./middleware/roles.php";
    checkAuthMiddleware(true);
    ?>
    <div class="grid grid-cols-1 md:grid-cols-2 h-full">
        <div class="container p-6 sm:p-8 lg:p-16 xl:px-24">
            <form action="controller/authentication/register_action.php" method="post" class="xl:w-9/12 lg:w-11/12">
                <a class="flex cursor-pointer">
                    <div class="align-middle text-2xl font-semibold">E-Learning</div>
                </a>
                <h1 class="text-4xl font-bold text-black mt-14">Register</h1>
                <p class="text-dark20 mt-2 mb-10">Welcome! 😄</p>
                <div>
                    <label for="name" class="font-bold text-black">Full Name</label>
                    <input id="name" type="name" placeholder="Full Name" name="name" class=" rounded-lg border-dark10 border focus:outline-none focus:border focus:border-primary appearance-none block mt-3 w-full py-3 px-4" required>
                </div>
                <div class="mt-8">
                    <label for="email" class="font-bold text-black">Email</label>
                    <input id="email" type="email" placeholder="Email" name="email" class=" rounded-lg border-dark10 border focus:outline-none focus:border focus:border-primary appearance-none block mt-3 w-full py-3 px-4" required>
                </div>
                <div class="mt-8 relative">
                    <label for="password" class="font-bold text-black">Password</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button class="text-gray-400 focus:outline-none focus:text-primary toggle-password" type="button">
                                <img id="eye-auth" src="assets/authentication/eye-slash.svg" alt="Toggle Password">
                            </button>
                        </div>
                        <input id="password" type="password" placeholder="Password" name="password" class=" rounded-lg border-dark10 border focus:outline-none focus:border focus:border-primary appearance-none block mt-3 w-full py-3 px-4" required>
                    </div>
                </div>
                <button class="mt-10 py-3 px-6 border-white bg-primary  rounded-lg text-white w-full font-semibold">Register</button>
                <div class="text-dark20 text-center mt-10">Already have an account? <span class="text-primary font-semibold cursor-pointer"><a href="login.php">Login</a></span></div>
            </form>
        </div>
        <div class="md:block bg-primary h-full bg-[length:100%_70%] bg-[url('assets/authentication/auth-bg.png')] bg-no-repeat bg-right-top">
            <div class="grid place-items-center h-full px-10">
                <img src="assets/authentication/auth-image.png" alt="Authentication Image" class="m-auto">
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#password');
        const imgAuth = document.querySelector('#eye-auth');
        const eyeSlashPath = 'assets/authentication/eye-slash.svg';
        const eyePath = 'assets/authentication/eye.svg';

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            imgAuth.setAttribute('src', passwordInput.getAttribute('type') === 'password' ? eyePath : eyeSlashPath);
            passwordInput.setAttribute('type', type);
        });
    </script>
</body>

</html>