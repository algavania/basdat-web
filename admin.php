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
    <title>Admin Dashboard</title>
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
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Photo
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
                        include "controller/admin/read.php";
                        ?>
                    </tbody>
                </table>
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
            xhttp.open("GET", "controller/admin/search.php?keyword=" + keyword.value, true);
            xhttp.send();
        }

        keyword.addEventListener('keyup', function() {
            search();
        });

        $(".delete").off("click").on("click", async function() {
            var name = $(this).attr("data-nama");
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
                    url: "controller/admin/delete_action.php?username=" + username,
                    type: "POST",
                    success: async function(data) {
                        await swal({
                            title: "Deleted",
                            text: "Data has been deleted!",
                            icon: "success",
                        });
                        window.location = "admin.php";
                    }
                });

            }
        });
    </script>
</body>

</html>