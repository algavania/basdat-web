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
        <a class="flex items-center justify-center cursor-pointer my-12" href="../../index.php">
            <div class="self-center align-middle text-xl font-semibold">E-Learning</div>
        </a>
        <div class="text-dark30 text-sm mb-6">Course Panel</div>
        <ul class="space-y-5 font-medium">
            <li>
                <a href="" class="flex items-center py-3 px-6 <?php echo $fileName == 'submission.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                    <svg class="fill-current <?php echo 'text' . $color1 ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z" />
                    </svg>
                    <span class="ml-6 font-semibold <?php echo $fileName == 'submission.php' ? $activeText : $inactiveText ?>">Submissions</span>
                </a>
            </li>
        </ul>
        <div class="text-dark30 text-sm my-6">Other</div>
        <ul class="space-y-5 font-medium">
            <li>
                <a href="../assignment.php?id=<?php echo $row['course_id'] ?>" class="flex w-full items-center p-2 py-3 px-6 text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg class="fill-current text-primary" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zM259.515 124.485l-123.03 123.03c-4.686 4.686-4.686 12.284 0 16.971l123.029 123.029c7.56 7.56 20.485 2.206 20.485-8.485V132.971c.001-10.691-12.925-16.045-20.484-8.486z" />
                    </svg>
                    <span class="ml-6 font-semibold text-primary">Back</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
</div>