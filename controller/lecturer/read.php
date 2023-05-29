<?php
include "connect.php";
$sql = "SELECT *, departments.name AS department_name, users.name AS user_name FROM lecturers LEFT JOIN departments ON departments.id=lecturers.department_id LEFT JOIN users ON users.id=lecturers.user_id";
$query = pg_query($connect, $sql);
$no = 1;
while ($row = pg_fetch_assoc($query)) {
    echo '<tr class="bg-white border-b dark:bg-gray-800 text-black dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
    ' . $no++ . '
    </th>
    <td class="px-6 py-4">
    ' . $row['nip'] . '
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
    ' . $row['department_name'] . '
    </td>
    <td class="px-6 py-4 text-right">
        <a href="lecturer_form.php?nip=' . $row['nip'] . '" class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit" data-nip="' . $row['nip'] . '" data-name="' . $row['user_name'] . '">Edit</a>
    </td>
    <td class="px-6 py-4 text-right">
        <a class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline delete" data-nip="' . $row['nip'] . '" data-name="' . $row['user_name'] . '">Delete</a>
    </td>
</tr>
';
}
