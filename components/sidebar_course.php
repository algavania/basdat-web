<?php
include '../controller/course/read_course.php';
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
        <a class="flex items-center justify-center cursor-pointer my-12" href="../index.php">
            <div class="self-center align-middle text-xl font-semibold">E-Learning</div>
        </a>
        <div class="text-dark30 text-sm mb-6">Course Panel</div>
        <ul class="space-y-5 font-medium">
            <li>
                <a href="assignment.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'assignment.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                    <svg class="fill-current <?php echo 'text' . $color1 ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                    </svg>
                    <span class="ml-6 font-semibold <?php echo $fileName == 'assignment.php' ? $activeText : $inactiveText ?>">Assignments</span>
                </a>
            </li>
            <li>
                <a href="material.php" class="flex items-center py-3 px-6 <?php echo $fileName == 'material.php' ? $active . ' ' . $activeText : $inactive . ' ' . $inactiveText ?> rounded-lg">
                    <svg class="fill-current <?php echo 'text' . $color1 ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M21 3h-6.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H3v18h18V3zm-9 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 15l-5-5h3V9h4v4h3l-5 5z" />
                    </svg>
                    <span class="ml-6 font-semibold <?php echo $fileName == 'material.php' ? $activeText : $inactiveText ?>">Materials</span>
                </a>
            </li>
        </ul>
        <div class="text-dark30 text-sm my-6">Other</div>
        <ul class="space-y-5 font-medium">
            <?php if (checkIfLecturer()) : ?>
                <li>
                    <button data-id="<?php echo $_GET['id'] ?>" data-closed_at="<?php echo $courseRow['closed_at'] ?>" data-name="<?php echo $courseRow['name'] ?>" id="close" class="flex w-full items-center p-2 py-3 px-6 text-gray-900 rounded-lg hover:bg-gray-100">
                        <svg class="fill-current <?php echo $courseRow['closed_at'] ? 'text-green-500' : 'text-red-500' ?>" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <span class="ml-6 font-semibold <?php echo $courseRow['closed_at'] ? 'text-green-500' : 'text-red-500' ?>"><?php echo $courseRow['closed_at'] ? 'Open Course' : 'Close Course' ?></span>
                    </button>
                </li>
            <?php endif ?>
            <li>
                <a href="../index.php" class="flex w-full items-center p-2 py-3 px-6 text-gray-900 rounded-lg hover:bg-gray-100">
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

<script>
    var i = 0;
    [...document.querySelectorAll('a')].forEach(e => {
        if (i != 0 && i != 3) {
            const url = new URL(e.href)
            for (let [k, v] of new URLSearchParams(window.location.search).entries()) {
                url.searchParams.set(k, v)
            }
            e.href = url.toString();
        }
        i++;
    })

    $("#close").off("click").on("click", async function() {
        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var isClosed = $(this).attr("data-closed_at");
        var text = "Do you want to " + (isClosed ? "open " : "close ") + name + " (ID " + id + ")?";
        var willDelete = await swal({
            title: "Confirmation",
            text: text,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        });
        var url;
        if (!isClosed) {
            url = "../controller/course/close_course.php";
        } else {
            url = "../controller/course/open_course.php";
        }
        url += "?id=" + id;
        if (willDelete) {
            $.ajax({
                url: url,
                type: "POST",
                success: async function(data) {
                    await swal({
                        title: !isClosed ? "Closed" : "Opened",
                        text: !isClosed ? "Course has been closed!" : "Course has been opened!",
                        icon: "success",
                    });
                    window.location = "../index.php";
                }
            });

        }
    });
</script>