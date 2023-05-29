<?php
$fileName = basename($_SERVER['PHP_SELF']);
$active = 'bg-[#2363DE]';
$activeText = 'text-white';
$inactive = 'bg-white hover:bg-gray-100';
$inactiveText = 'text-gray-900';
?>

<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 border-dark10 border-2" aria-label="Sidebar">
    <div class="h-full px-6 py-4 overflow-y-auto bg-white">
        <a class="flex items-center justify-center cursor-pointer my-12" href="#">
            <div class="self-center align-middle text-xl font-semibold">E-Learning</div>
        </a>
        <div class="text-dark30 text-sm mb-6">Panel</div>
        <ul class="space-y-5 font-medium">
            <?php if (checkIfGuest()) : ?>
                <li>
                    <a href="guest.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'guest.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.14373 20.7821V17.7152C9.14372 16.9381 9.77567 16.3067 10.5584 16.3018H13.4326C14.2189 16.3018 14.8563 16.9346 14.8563 17.7152V17.7152V20.7732C14.8563 21.4473 15.404 21.9951 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0007C21.1356 20.3586 21.5 19.4868 21.5 18.5775V9.86585C21.5 9.13139 21.1721 8.43471 20.6046 7.9635L13.943 2.67427C12.7785 1.74912 11.1154 1.77901 9.98539 2.74538L3.46701 7.9635C2.87274 8.42082 2.51755 9.11956 2.5 9.86585V18.5686C2.5 20.4637 4.04738 22 5.95617 22H7.87229C8.19917 22.0023 8.51349 21.8751 8.74547 21.6464C8.97746 21.4178 9.10793 21.1067 9.10792 20.7821H9.14373Z" fill="white" class="fill-current <?php echo 'text' . $color1 ?>" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $fileName == 'guest.php' ? $activeText : $inactiveText ?>">Guest</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if (checkRole([2, 3])) : ?>
                <li>
                    <a href="index.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'index.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.14373 20.7821V17.7152C9.14372 16.9381 9.77567 16.3067 10.5584 16.3018H13.4326C14.2189 16.3018 14.8563 16.9346 14.8563 17.7152V17.7152V20.7732C14.8563 21.4473 15.404 21.9951 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0007C21.1356 20.3586 21.5 19.4868 21.5 18.5775V9.86585C21.5 9.13139 21.1721 8.43471 20.6046 7.9635L13.943 2.67427C12.7785 1.74912 11.1154 1.77901 9.98539 2.74538L3.46701 7.9635C2.87274 8.42082 2.51755 9.11956 2.5 9.86585V18.5686C2.5 20.4637 4.04738 22 5.95617 22H7.87229C8.19917 22.0023 8.51349 21.8751 8.74547 21.6464C8.97746 21.4178 9.10793 21.1067 9.10792 20.7821H9.14373Z" fill="white" class="fill-current <?php echo 'text' . $color1 ?>" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $fileName == 'index.php' ? $activeText : $inactiveText ?>">Dashboard</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if (checkRole([4])) : ?>
                <li>
                    <a href="student.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'student.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                        <svg class="fill-current <?php echo 'text' . $color1 ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-school" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12,3L1,9L12,15L21,10.09V17H23V9M5,13.18V17.18L12,21L19,17.18V13.18L12,17L5,13.18Z" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $fileName == 'student.php' ? $activeText : $inactiveText ?>">Students</span>
                    </a>
                </li>
                <li>
                    <a href="admin.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'admin.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                        <svg class="fill-current <?php echo 'text' . $color2 ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-account-box" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M6,17C6,15 10,13.9 12,13.9C14,13.9 18,15 18,17V18H6M15,9A3,3 0 0,1 12,12A3,3 0 0,1 9,9A3,3 0 0,1 12,6A3,3 0 0,1 15,9M3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3H5C3.89,3 3,3.9 3,5Z" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $fileName == 'admin.php' ? $activeText : $inactiveText ?>">Users</span>
                    </a>
                </li>
                <li>
                    <a href="department.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'department.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                        <svg class="fill-current <?php echo 'text' . $color2 ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path d="M0 224v272c0 8.84 7.16 16 16 16h80V192H32c-17.67 0-32 14.33-32 32zm360-48h-24v-40c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v64c0 4.42 3.58 8 8 8h48c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8zm137.75-63.96l-160-106.67a32.02 32.02 0 0 0-35.5 0l-160 106.67A32.002 32.002 0 0 0 128 138.66V512h128V368c0-8.84 7.16-16 16-16h96c8.84 0 16 7.16 16 16v144h128V138.67c0-10.7-5.35-20.7-14.25-26.63zM320 256c-44.18 0-80-35.82-80-80s35.82-80 80-80 80 35.82 80 80-35.82 80-80 80zm288-64h-64v320h80c8.84 0 16-7.16 16-16V224c0-17.67-14.33-32-32-32z" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $fileName == 'department.php' ? $activeText : $inactiveText ?>">Departments</span>
                    </a>
                </li>
                <li>
                    <a href="major.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'major.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                        <svg class="fill-current <?php echo 'text' . $color2 ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-book-open-variant" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M17.5 14.33C18.29 14.33 19.13 14.41 20 14.57V16.07C19.38 15.91 18.54 15.83 17.5 15.83C15.6 15.83 14.11 16.16 13 16.82V15.13C14.17 14.6 15.67 14.33 17.5 14.33M13 12.46C14.29 11.93 15.79 11.67 17.5 11.67C18.29 11.67 19.13 11.74 20 11.9V13.4C19.38 13.24 18.54 13.16 17.5 13.16C15.6 13.16 14.11 13.5 13 14.15M17.5 10.5C15.6 10.5 14.11 10.82 13 11.5V9.84C14.23 9.28 15.73 9 17.5 9C18.29 9 19.13 9.08 20 9.23V10.78C19.26 10.59 18.41 10.5 17.5 10.5M21 18.5V7C19.96 6.67 18.79 6.5 17.5 6.5C15.45 6.5 13.62 7 12 8V19.5C13.62 18.5 15.45 18 17.5 18C18.69 18 19.86 18.16 21 18.5M17.5 4.5C19.85 4.5 21.69 5 23 6V20.56C23 20.68 22.95 20.8 22.84 20.91C22.73 21 22.61 21.08 22.5 21.08C22.39 21.08 22.31 21.06 22.25 21.03C20.97 20.34 19.38 20 17.5 20C15.45 20 13.62 20.5 12 21.5C10.66 20.5 8.83 20 6.5 20C4.84 20 3.25 20.36 1.75 21.07C1.72 21.08 1.68 21.08 1.63 21.1C1.59 21.11 1.55 21.12 1.5 21.12C1.39 21.12 1.27 21.08 1.16 21C1.05 20.89 1 20.78 1 20.65V6C2.34 5 4.18 4.5 6.5 4.5C8.83 4.5 10.66 5 12 6C13.34 5 15.17 4.5 17.5 4.5Z" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $fileName == 'major.php' ? $activeText : $inactiveText ?>">Majors</span>
                    </a>
                </li>
                <li>
                    <a href="lecturer.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'lecturer.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                        <svg class="fill-current <?php echo 'text' . $color2 ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-badge-account" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M17,3H14V6H10V3H7A2,2 0 0,0 5,5V21A2,2 0 0,0 7,23H17A2,2 0 0,0 19,21V5A2,2 0 0,0 17,3M12,8A2,2 0 0,1 14,10A2,2 0 0,1 12,12A2,2 0 0,1 10,10A2,2 0 0,1 12,8M16,16H8V15C8,13.67 10.67,13 12,13C13.33,13 16,13.67 16,15V16M13,5H11V1H13V5M16,19H8V18H16V19M12,21H8V20H12V21Z" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $fileName == 'lecturer.php' ? $activeText : $inactiveText ?>">Lecturers</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
        <div class="text-dark30 text-sm my-6">Other</div>
        <ul class="space-y-5 font-medium">
            <li>
                <form action="controller/authentication/logout.php" method="POST">
                    <button type="submit" class="flex w-full items-center p-2 py-3 px-6 text-gray-900 rounded-lg hover:bg-gray-100">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.89535 11.23C9.45785 11.23 9.11192 11.57 9.11192 12C9.11192 12.42 9.45785 12.77 9.89535 12.77H16V17.55C16 20 13.9753 22 11.4724 22H6.51744C4.02471 22 2 20.01 2 17.56V6.45C2 3.99 4.03488 2 6.52762 2H11.4927C13.9753 2 16 3.99 16 6.44V11.23H9.89535ZM19.6302 8.5402L22.5502 11.4502C22.7002 11.6002 22.7802 11.7902 22.7802 12.0002C22.7802 12.2002 22.7002 12.4002 22.5502 12.5402L19.6302 15.4502C19.4802 15.6002 19.2802 15.6802 19.0902 15.6802C18.8902 15.6802 18.6902 15.6002 18.5402 15.4502C18.2402 15.1502 18.2402 14.6602 18.5402 14.3602L20.1402 12.7702H16.0002V11.2302H20.1402L18.5402 9.6402C18.2402 9.3402 18.2402 8.8502 18.5402 8.5502C18.8402 8.2402 19.3302 8.2402 19.6302 8.5402Z" fill="#F1582F" />
                        </svg>
                        <span class="ml-6 font-semibold text-[#F1582F]">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
</div>