<?php
session_start();
include "../middleware/roles.php";
checkAuthMiddleware(false);
checkRoleAccess([2,3]);

include "../controller/course/read_course.php";
include '../controller/assignment/read.php'
?>

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
    <link rel="stylesheet" href="../dist/output.css?v=<?php echo time(); ?>">
    <title>Assignments</title>
</head>

<body>
    <?php include "../components/sidebar_course.php"; ?>
    <div class="sm:ml-64 h-full">
        <div class="py-8 px-6 bg-[#F6F9FE] h-full w-full relative">
            <div class="flex justify-between mb-6">
                <h1 class="font-bold text-xl"><?php echo $row['name'] ?></h1>
                <?php if (checkIfLecturer()) : ?>
                    <button data-modal-target="assignmentModal" data-modal-toggle="assignmentModal" id="add-button" class="text-white bg-primary focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Add Assignment</button>
                <?php endif ?>
            </div>
            <?php if ($result) : ?>
                <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4">
                    <?php foreach ($result as $row) : ?>
                        <div class="rounded-lg bg-white p-6 text-black border border-gray-300">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <div class="flex justify-between break-words">
                                        <h1 class="font-bold text-lg"><?php echo $row['title'] ?></h1>
                                        <?php if (checkIfLecturer()) : ?>
                                            <div class="flex justify-end gap-1">
                                                <i data-id='<?php echo $row['assignment_id'] ?>' data-assignment='<?php echo $row['assignment_type'] ?>' data-title='<?php echo $row['title'] ?>' data-description='<?php echo $row['description'] ?>' data-deadline='<?php echo $row['deadline'] ?>' data-modal-target="assignmentModal" data-modal-toggle="assignmentModal" class='cursor-pointer edit bx bxs-edit bx-sm text-primary'></i>

                                                <i class='cursor-pointer bx bxs-trash text-red-500 bx-sm delete' data-course_id='<?php echo $row['course_id'] ?>' data-id='<?php echo $row['id'] ?>' data-title='<?php echo $row['title'] ?>'></i>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="font-bold text-sm text-dark30 line-clamp-3 mt-2">
                                        <?php echo $row['description'] ?>
                                    </div>
                                    <?php
                                    $dateTime = new DateTime($row['deadline']);
                                    $date = $dateTime->format('d/m/Y H:i');
                                    if (!checkIfLecturer()) {
                                        $dateTime = new DateTime($row['submitted_at']);
                                        $submittedDate = $dateTime->format('d/m/Y H:i');
                                    }
                                    ?>
                                    <div class="font-bold text-sm text-primary mt-2">
                                        <?php echo $row['assignment_name'] ?>
                                    </div>
                                    <div class="font-bold text-sm text-primary">
                                        Deadline: <?php echo $date ?>
                                    </div>
                                </div>
                                <?php if (checkIfLecturer()) : ?>
                                    <div class="font-bold text-sm text-primary">
                                        Total Submission: <?php echo $row['total_submissions'] . ' of ' . $row['total_students_enrolled'] . ' students' ?>
                                    </div>
                                    <a href="detail/submission.php?id=<?php echo $row['assignment_id'] ?>" type="button" class="mt-3 text-center cursor-pointer text-white bg-primary focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none w-full">View Submissions</a>
                                <?php endif ?>
                                <?php if (!checkIfLecturer()) : ?>
                                    <div class="font-bold text-sm text-primary">
                                        Submission Status: <span class="<?php echo $row['has_submission'] ? 'text-green-500' : 'text-red-500' ?>"><?php echo $row['has_submission'] ? 'Submmited at ' . $submittedDate : 'Not submitted' ?></span>
                                    </div>
                                    <div class="font-bold text-sm text-primary">
                                        Grade: <span class="<?php echo $row['grade'] ? 'text-green-500' : 'text-red-500' ?>"><?php echo $row['grade'] ? $row['grade'] . '/100' : 'Not graded yet' ?></span>
                                    </div>
                                    <br>
                                    <button data-id='<?php echo $row['id'] ?>' data-assignment='<?php echo $row['assignment_type'] ?>' data-title='<?php echo $row['title'] ?>' data-description='<?php echo $row['description'] ?>' data-deadline='<?php echo $row['deadline'] ?>' data-modal-target="assignmentModal" data-modal-toggle="assignmentModal" class="view text-white bg-primary focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none w-full">View Assignment</button>

                                    <?php if (!$courseRow['closed_at']) : ?>
                                        <button data-submission_id='<?php echo $row['submission_id'] ?>' data-attachment='<?php echo $row['attachment'] ?>' data-id='<?php echo $row['id'] ?>' data-description='<?php echo $row['submission_description'] ?>' data-modal-target="submissionModal" data-modal-toggle="submissionModal" class="mt-3 submission-button text-white <?php echo $row['has_submission'] ? 'bg-yellow-400' : 'bg-green-500' ?> focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none w-full"><?php echo $row['has_submission'] ? 'Edit Submission' : 'Submit' ?></button>
                                    <?php endif ?>

                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div>You don't have any assignments yet.</div>
            <?php endif ?>
        </div>
    </div>

    <div id="assignmentModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-96 max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form action="controller/assignment/add_action.php" method="post">
                    <div class="flex items-start bg-primary justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-white">
                            Assignment Form
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" data-modal-hide="assignmentModal">
                            <svg aria-hidden="true" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <input class="hidden absolute" type="text" id="id" name="id">
                    <input class="hidden absolute" type="text" id="course_id" name="course_id" value="<?php echo $_GET['id'] ?>">
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="assignment" class="block mb-2 text-sm font-medium text-gray-900 text-black">Assignment Type</label>
                            <select <?php echo checkIfLecturer() ? '' : 'disabled' ?> required id="assignment" name="assignment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-primary dark:focus:border-primary">
                                <?php foreach ($resultQuery as $row) : ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 text-black">Title</label>
                            <input <?php echo checkIfLecturer() ? '' : 'disabled' ?> type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-primary dark:focus:border-primary" required>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 text-black">Description</label>
                            <textarea <?php echo checkIfLecturer() ? '' : 'disabled' ?> type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-primary dark:focus:border-primary" required></textarea>
                        </div>
                        <div>
                            <label for="deadline" class="block mb-2 text-sm font-medium text-gray-900 text-black">Deadline</label>
                            <input <?php echo checkIfLecturer() ? '' : 'disabled' ?> type="datetime-local" id="deadline" name="deadline" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-primary dark:focus:border-primary" required>
                        </div>
                    </div>
                    <?php if (checkIfLecturer()) : ?>
                        <div class="flex items-end justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button id="save-button" type="submit" class="text-white bg-primary focus:ring-4 focus:outline-none w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Data</button>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>

    <?php if (!checkIfLecturer()) : ?>
        <div id="submissionModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-96 max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form action="controller/assignment/add_action.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="flex items-start bg-primary justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-white">
                                Submission Form
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" data-modal-hide="submissionModal">
                                <svg aria-hidden="true" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <input class="hidden absolute" type="text" id="id" name="id">
                        <input class="hidden absolute" type="text" id="submission_id" name="submission_id">
                        <input class="hidden absolute" type="text" id="assignment_id" name="assignment_id">
                        <input class="hidden absolute" type="text" id="course_id" name="course_id" value="<?php echo $_GET['id'] ?>">
                        <input class="hidden" type="file" id="file_input" name="submission_file" accept=".pdf">
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="submission_description" class="block mb-2 text-sm font-medium text-gray-900 text-black">Description</label>
                                <textarea type="text" id="submission_description" name="submission_description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-primary dark:focus:border-primary" required></textarea>
                            </div>
                            <div>
                                <label for="attachment" class="block mb-2 text-sm font-medium text-gray-900 text-black">Attachment</label>
                                <input type="text" id="attachment" readonly name="attachment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-primary dark:focus:border-primary">
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <a id="download-button" type="button" class="text-white bg-primary focus:ring-4 focus:outline-none w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer">Download Attachment</a>
                            <button id="save-button" type="submit" class="mt-3 text-white bg-primary focus:ring-4 focus:outline-none w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    <script>
        try {
            const fileInput = document.getElementById('file_input');
            const label = document.getElementById('attachment');

            label.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', () => {
                const selectedFile = fileInput.files[0];
                $("#attachment").val(selectedFile.name);
            });
        } catch (_) {}
        var attachmentFile;

        function validateForm() {
            if (fileInput.files.length === 0 && !attachmentFile) {
                swal({
                    title: "Error",
                    text: "Please attach a file!",
                    icon: "error",
                });
                return false;
            }
        }

        $("#add-button").off("click").on("click", async function() {
            $("#assignment").val(null);
            $("#deadline").val(null);
            $("#title").val('');
            $("#description").val('');
            $("form").attr('action', '../controller/assignment/add_action.php');
        });

        $(".edit").off("click").on("click", async function() {
            $("#save-button").text('Edit Data');
            var title = $(this).attr("data-title");
            var deadline = $(this).attr("data-deadline");
            var id = $(this).attr("data-id");
            var assignment = $(this).attr("data-assignment");
            var description = $(this).attr("data-description");
            $("#title").val(title);
            $("#deadline").val(deadline);
            $("#id").val(id);
            $("#description").val(description);
            $("#assignment").val(assignment);
            $("form").attr('action', '../controller/assignment/update_action.php');
        });


        $(".view").off("click").on("click", async function() {
            var title = $(this).attr("data-title");
            var deadline = $(this).attr("data-deadline");
            var id = $(this).attr("data-id");
            var assignment = $(this).attr("data-assignment");
            var description = $(this).attr("data-description");
            $("#title").val(title);
            $("#deadline").val(deadline);
            $("#id").val(id);
            $("#description").val(description);
            $("#assignment").val(assignment);
        });

        $(".submission-button").off("click").on("click", async function() {
            var assignmentId = $(this).attr("data-id");
            var submissionId = $(this).attr("data-submission_id");
            var attachment = $(this).attr("data-attachment");
            attachmentFile = attachment;
            var description = $(this).attr("data-description");
            $("#submission_description").val(description);
            $("#attachment").val(attachment);
            $("#assignment_id").val(assignmentId);
            $("#submission_id").val(submissionId);

            if (attachment) {
                $("#save-button").text("Edit Submission");
                $('#download-button').attr('href', '../controller/submission/download.php?file=' + attachment);
                $('#download-button').removeClass('hidden');
                $("form").attr('action', '../controller/submission/update_action.php');
            } else {
                $('#download-button').addClass('hidden');
                $("#save-button").text("Submit Submission");
                $("form").attr('action', '../controller/submission/add_action.php');
            }
        });

        $(".delete").off("click").on("click", async function() {
            var name = $(this).attr("data-title");
            var id = $(this).attr("data-id");
            var courseId = $(this).attr("data-course_id");
            var willDelete = await swal({
                title: "Confirmation",
                text: "Do you want to delete " + name + " (ID " + id + ")?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });
            if (willDelete) {
                $.ajax({
                    url: "../controller/assignment/delete_action.php?id=" + id + "&course_id=" + courseId,
                    type: "POST",
                    success: async function(data) {
                        await swal({
                            title: "Deleted",
                            text: "Data has been deleted!",
                            icon: "success",
                        });
                        window.location = "assignment.php?id=" + courseId;
                    }
                });

            }
        });
    </script>
</body>

</html>