<?php
session_start();
if (!$_SESSION['login']) {
    header('Location: login.php');
    exit;
}

include "../../middleware/roles.php";
checkAuthMiddleware(false);
checkRoleAccess([3]);

include '../../controller/submission/read.php' ?>

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
    <link rel="stylesheet" href="../../dist/output.css?v=<?php echo time(); ?>">
    <title>Submissions</title>
</head>

<body>
    <?php include "../../components/sidebar_submission.php"; ?>
    <div class="sm:ml-64 h-full">
        <div class="py-8 px-6 bg-[#F6F9FE] h-full w-full relative">
            <div class="flex justify-between mb-6">
                <h1 class="font-bold text-xl"><?php echo $row['title'] ?></h1>
            </div>
            <?php if ($result) : ?>
                <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4">
                    <?php foreach ($result as $row) : ?>
                        <div class="rounded-lg bg-white p-6 text-black border border-gray-300">
                            <div class="flex justify-between break-words">
                                <h1 class="font-bold text-lg"><?php echo $row['student_nrp'] ?></h1>
                            </div>
                            <div class="font-bold text-sm text-black">
                                <?php echo $row['student_name'] ?>
                            </div>
                            <div class="font-bold text-sm text-dark30 mt-2">
                                <?php echo $row['description'] ?>
                            </div>
                            <div class="font-bold text-sm <?php echo $row['grade'] ? 'text-green-500' : 'text-red-500' ?>">
                                <?php echo $row['grade'] ? $row['grade'] . '/100' : 'Not graded' ?>
                            </div>
                            <a href="../../files/submissions/<?php echo $row['attachment'] ?>" type="button" class="text-white bg-primary focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none w-full text-center mt-3">View Submission</a>
                            <button data-id="<?php echo $row['id'] ?>" data-assignment_id="<?php echo $row['assignment_id'] ?>" data-grade="<?php echo $row['grade'] ?>" data-modal-target="gradeModal" data-modal-toggle="gradeModal" class="grade text-white bg-primary focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none w-full text-center mt-3">Grade Submission</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div>No submissions from students yet.</div>
            <?php endif ?>
        </div>
    </div>

    <div id="gradeModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-96 max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form action="controller/assignment/add_action.php" method="post">
                    <div class="flex items-start bg-primary justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-white">
                            Grade Form
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" data-modal-hide="gradeModal">
                            <svg aria-hidden="true" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <input class="hidden absolute" type="text" id="id" name="id">
                    <input class="hidden absolute" type="text" id="assignment_id" name="assignment_id">
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="grade" class="block mb-2 text-sm font-medium text-gray-900 text-black">Grade</label>
                            <input type="number" min="0" max="100" id="grade" name="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-primary dark:focus:border-primary" required>
                        </div>
                    </div>
                    <div class="flex items-end justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button id="save-button" type="submit" class="text-white bg-primary focus:ring-4 focus:outline-none w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    <script>
        $(".grade").off("click").on("click", async function() {
            var id = $(this).attr("data-id");
            var assignmentId = $(this).attr("data-assignment_id");
            var grade = $(this).attr("data-grade");
            $("#grade").val(grade);
            $("#assignment_id").val(assignmentId);
            $("#id").val(id);
            $("form").attr('action', '../../controller/submission/grade_action.php');
        });
    </script>
</body>

</html>