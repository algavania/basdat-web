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
    <title>Major Dashboard</title>
</head>

<body class="bg-[#F6F9FE] h-full">
    <?php
    session_start();
    include "./middleware/roles.php";
    checkAuthMiddleware(false);
    checkRoleAccess([4]);
    ?>
    <?php include "./components/sidebar.php"; ?>
    <div class="sm:ml-64 h-full">
        <div class="py-8 px-6 bg-[#F6F9FE] h-full w-full relative">
            <div class="flex place-content-end">
                <button data-modal-target="majorModal" data-modal-toggle="majorModal" id="add-button" class="text-white bg-primary focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-5 focus:outline-none cursor-pointer">Add Major</button>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mb-6">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="keyword" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-white focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
            </div>
            <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white bg-primary">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Department
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        include "controller/major/read.php";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="majorModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-96 max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form action="controller/major/add_action.php" method="post">
                        <div class="flex items-start bg-primary justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-white">
                                Major Form
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" data-modal-hide="majorModal">
                                <svg aria-hidden="true" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <input class="hidden absolute" type="text" id="id" name="id">
                        <input class="hidden absolute" type="text" id="original_name" name="original_name">
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="major_name" class="block mb-2 text-sm font-medium text-gray-900 text-black">Major Name</label>
                                <input type="text" id="major_name" name="major_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 text-black">Department</label>
                                <select required id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

    <script>
        const keyword = document.getElementById("keyword");
        const tableBody = document.getElementById("table-body");

        function search() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    tableBody.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "controller/major/search.php?keyword=" + keyword.value, true);
            xhttp.send();
        }

        keyword.addEventListener('keyup', function() {
            search();
        });

        $("#add-button").off("click").on("click", async function() {
            $("#major_name").val('');
            $("#department").val(null);
            $("#save-button").text('Add Data');
            $("form").attr('action', 'controller/major/add_action.php');
        });

        $(".edit").off("click").on("click", async function() {
            $("#save-button").text('Edit Data');
            var name = $(this).attr("data-major_name");
            var departmentId = $(this).attr("data-department_id");
            var id = $(this).attr("data-id");
            $("#major_name").val(name);
            $("#original_name").val(name);
            $("#department").val(departmentId);
            $("#id").val(id);
            $("form").attr('action', 'controller/major/update_action.php');
        });

        $(".delete").off("click").on("click", async function() {
            var name = $(this).attr("data-major_name");
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
                    url: "controller/major/delete_action.php?id=" + id,
                    type: "POST",
                    success: async function(data) {
                        await swal({
                            title: "Deleted",
                            text: "Data has been deleted!",
                            icon: "success",
                        });
                        window.location = "major.php";
                    }
                });

            }
        });
    </script>
</body>

</html>