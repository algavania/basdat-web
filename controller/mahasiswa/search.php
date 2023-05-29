<?php
include "../../connect.php";
$keyword = $_GET['keyword'];
$sql = "SELECT *, users.name AS user_name, majors.name AS major_name FROM students LEFT JOIN majors ON majors.id=students.major_id LEFT JOIN users ON users.id=students.user_id WHERE nrp LIKE '%$keyword%' OR users.name LIKE '%$keyword%' OR majors.name LIKE '%$keyword%'";
$query = pg_query($connect, $sql);
$no = 1;
while ($row = pg_fetch_assoc($query)) {
    echo '<tr class="bg-white border-b dark:bg-gray-800 text-black dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
    ' . $no++ . '
    </th>
    <td class="px-6 py-4">
    ' . $row['nrp'] . '
    </td>
    <td class="px-6 py-4">
    ' . $row['user_name'] . '
    </td>
    <td class="px-6 py-4">
    ' . $row['gender'] . '
    </td>
    <td class="px-6 py-4">
    ' . $row['address'] . '
    </td>
    <td class="px-6 py-4">
    ' . $row['major_name'] . '
    </td>
    <td class="px-6 py-4 text-right">
        <a href="student_form.php?nrp=' . $row['nrp'] . '" class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit" data-nrp="' . $row['nrp'] . '" data-name="' . $row['user_name']. '">Edit</a>
    </td>
    <td class="px-6 py-4 text-right">
        <a class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline delete" data-nrp="' . $row['nrp'] . '" data-name="' . $row['user_name'].'">Delete</a>
    </td>
</tr>
';
}