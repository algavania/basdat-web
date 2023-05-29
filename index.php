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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dist/output.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>

<body class="bg-[#F6F9FE] h-full">
    <?php
    session_start();
    include "./middleware/roles.php";
    checkAuthMiddleware(false);
    if (checkRole([4])) {
        header("Location: student.php");
        exit;
    } else {
        checkRoleAccess([2, 3]);
        redirectRole();
    }
    ?>
    <?php include "./components/sidebar.php"; ?>
    <div class="sm:ml-64 h-full">
        <div class="py-8 px-6 bg-[#F6F9FE] h-full w-full relative">
            <div class="bg-white rounded-sm p-6">
                <div class="flex justify-between mb-6">
                    <h1 class="font-bold text-xl">My Courses</h1>
                    <?php if (checkIfLecturer()) : ?>
                        <button data-modal-target="courseModal" data-modal-toggle="courseModal" id="add-button" class="text-white bg-primary focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Add Course</button>
                    <?php endif ?>
                </div>
                <?php include './controller/course/read.php' ?>
                <?php if ($result) : ?>
                    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-4">
                        <?php foreach ($result as $row) : ?>
                            <a class="rounded-lg bg-primary p-6 text-white" href="./course/assignment.php?id=<?php echo $row['course_id'] ?>">
                                <div class="flex flex-col justify-between h-full">
                                    <div class="flex justify-between break-words">
                                        <h1 class="font-bold text-lg"><?php echo $row['course_name'] . ' (' . $row['course_id'] . ')' ?></h1>
                                        <?php if (checkIfLecturer()) : ?>
                                            <div class="flex justify-between break-words">
                                                <div class="flex justify-end gap-1">
                                                    <i contenteditable="true" onclick="return false;" data-id='<?php echo $row['course_id'] ?>' data-major='<?php echo $row['major_id'] ?>' data-name='<?php echo $row['course_name'] ?>' data-modal-target="courseModal" data-modal-toggle="courseModal" class='edit bx bxs-edit bx-sm cursor-pointer'></i>
                                                    <i contenteditable="true" onclick="return false;" class='bx bxs-trash cursor-pointer text-red-400 bx-sm delete' data-id='<?php echo $row['course_id'] ?>' data-name='<?php echo $row['course_name'] ?>'></i>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <?php if (!checkIfLecturer()) : ?>
                                        <div>
                                            <h2 class="break-words font-bold"><?php echo $row['major_name'] ?></h2>
                                            <h2 class="break-words"><?php echo $row['lecturer_name'] ?></h2>
                                            <br>
                                            <button data-enrollment_id='<?php echo $row['enrollment_id'] ?>' data-id='<?php echo $row['course_id'] ?>' data-name='<?php echo $row['course_name'] ?>' onclick="return false;" class="unenroll w-full text-white bg-red-500 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 focus:outline-none">Drop Class</button>
                                        </div>
                                    <?php endif ?>
                                    <?php if (checkIfLecturer()) : ?>
                                        <br>
                                        <h2 class="break-words font-bold">Students: <?php echo $row['total_students'] ?></h2>
                                        <h2 class="break-words font-bold">Status: <span class="<?php echo $row['closed_at'] == null ? 'text-green-400' : 'text-red-400' ?>"><?php echo $row['closed_at'] == null ? 'Active' : 'Inactive' ?></span></h2>
                                    <?php endif ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div>You haven't enrolled in any classes yet.</div>
                <?php endif ?>
            </div>

            <?php if (!checkIfLecturer()) : ?>
                <div class="bg-white rounded-sm p-6 mt-6">
                    <div class="flex justify-between mb-6">
                        <h1 class="font-bold text-xl">Available Courses</h1>
                    </div>
                    <?php if ($activeCoursesResult) : ?>
                        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-4">
                            <?php foreach ($activeCoursesResult as $row) : ?>
                                <a class="rounded-lg bg-primary p-6 text-white">
                                    <div class="flex flex-col justify-between h-full">
                                        <div class="flex justify-between break-words">
                                            <h1 class="font-bold text-lg"><?php echo $row['course_name'] . ' (' . $row['course_id'] . ')' ?></h1>
                                        </div>
                                        <div>
                                            <h2 class="break-words font-bold"><?php echo $row['major_name'] ?></h2>
                                            <h2 class="break-words"><?php echo $row['lecturer_name'] ?></h2>
                                            <br>
                                            <button data-id='<?php echo $row['course_id'] ?>' data-name='<?php echo $row['course_name'] ?>' class="enroll w-full text-primary bg-white focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 focus:outline-none">Enroll</button>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div>There's no available courses yet.</div>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <?php if (!checkIfLecturer()) : ?>
                <div class="bg-white rounded-sm p-6 mt-6">
                    <div class="flex justify-between mb-6">
                        <h1 class="font-bold text-xl">Past Courses</h1>
                    </div>
                    <?php if ($inactiveCoursesResult) : ?>
                        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-4">
                            <?php foreach ($inactiveCoursesResult as $row) : ?>
                                <a href="./course/assignment.php?id=<?php echo $row['course_id'] ?>" class="rounded-lg bg-primary p-6 text-white">
                                    <div class="flex flex-col justify-between h-full">
                                        <div class="flex justify-between break-words">
                                            <h1 class="font-bold text-lg"><?php echo $row['course_name'] . ' (' . $row['course_id'] . ')' ?></h1>
                                        </div>
                                        <div>
                                            <h2 class="break-words font-bold"><?php echo $row['major_name'] ?></h2>
                                            <h2 class="break-words"><?php echo $row['lecturer_name'] ?></h2>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div>You don't have any past courses yet.</div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </div>

    <?php if (checkIfLecturer()) : ?>
        <div id="courseModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-96 max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form action="controller/course/add_action.php" method="post">
                        <div class="flex items-start bg-primary justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-white">
                                Course Form
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" data-modal-hide="courseModal">
                                <svg aria-hidden="true" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <input class="hidden absolute" type="text" id="id" name="id">
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 text-black">Course Name</label>
                                <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="major" class="block mb-2 text-sm font-medium text-gray-900 text-black">Major</label>
                                <select required id="major" name="major" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php foreach ($resultQuery as $row) : ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-end justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button id="save-button" type="submit" class="text-white bg-primary focus:ring-4 focus:outline-none w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

    <script>
        $("#add-button").off("click").on("click", async function() {
            $("#name").val('');
            $("#major").val(null);
            $("#save-button").text('Add Data');
            $("form").attr('action', 'controller/course/add_action.php');
        });

        $(".edit").off("click").on("click", async function(e) {
            e.stopPropagation();
            $("#save-button").text('Edit Data');
            var name = $(this).attr("data-name");
            var majorId = $(this).attr("data-major");
            var id = $(this).attr("data-id");
            $("#name").val(name);
            $("#major").val(majorId);
            $("#id").val(id);
            $("form").attr('action', 'controller/course/update_action.php');
        });

        $(".delete").off("click").on("click", async function(e) {
            e.stopPropagation();
            var name = $(this).attr("data-name");
            var id = $(this).attr("data-id");
            var willDelete = await swal({
                title: "Confirmation",
                text: "Do you want to delete " + name + " (ID " + id + ")?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });
            if (willDelete) {
                $.ajax({
                    url: "controller/course/delete_action.php?id=" + id,
                    type: "POST",
                    success: async function(data) {
                        await swal({
                            title: "Deleted",
                            text: "Data has been deleted!",
                            icon: "success",
                        });
                        window.location = "index.php";
                    }
                });

            }
        });

        $(".enroll").off("click").on("click", async function(e) {
            e.stopPropagation();
            var name = $(this).attr("data-name");
            var id = $(this).attr("data-id");
            var willDelete = await swal({
                title: "Confirmation",
                text: "Do you want to enroll to " + name + " (ID " + id + ")?",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            });
            if (willDelete) {
                $.ajax({
                    url: "controller/course/enroll.php?id=" + id,
                    type: "POST",
                    success: async function(data) {
                        await swal({
                            title: "Enrolled",
                            text: "You have been enrolled in " + name + "!",
                            icon: "success",
                        });
                        window.location = "index.php";
                    }
                });
            }
        });

        $(".unenroll").off("click").on("click", async function(e) {
            e.stopPropagation();
            var name = $(this).attr("data-name");
            var id = $(this).attr("data-id");
            var enrollId = $(this).attr("data-enrollment_id");
            var willDelete = await swal({
                title: "Confirmation",
                text: "Do you want to unenroll from " + name + " (ID " + id + ")?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });
            if (willDelete) {
                $.ajax({
                    url: "controller/course/unenroll.php?id=" + enrollId,
                    type: "POST",
                    success: async function(data) {
                        await swal({
                            title: "Unenrolled",
                            text: "You have been unenrolled from " + name + "!",
                            icon: "success",
                        });
                        window.location = "index.php";
                    }
                });

            }
        });
    </script>
</body>

</html>