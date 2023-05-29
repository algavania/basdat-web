<?php
include "connect.php";
$sql = "SELECT majors.id, majors.name AS major_name, departments.name AS department_name, department_id FROM majors LEFT JOIN departments ON departments.id=majors.department_id ORDER BY majors.id";
$listSql = "SELECT * FROM departments";
$query = pg_query($connect, $sql);
$listQuery = pg_query($connect, $listSql);
$resultQuery = pg_fetch_all($listQuery);
$no = 1;
while ($row = pg_fetch_assoc($query)) {
    echo '<tr class="bg-white border-b dark:bg-gray-800 text-black dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
    ' . $no++ . '
    </th>
    <td class="px-6 py-4">
    ' . $row['major_name'] . '
    </td>
    <td class="px-6 py-4">
    ' . $row['department_name'] . '
    </td>
    <td class="px-6 py-4 text-right">
        <button data-modal-target="majorModal" data-modal-toggle="majorModal" class="edit font-medium text-blue-600 dark:text-blue-500 hover:underline edit" data-id="' . $row['id'] . '" data-major_name="' . $row['major_name'] .'" data-department_name="' . $row['department_name'] .'" data-department_id="' . $row['department_id']. '">Edit</button>
    </td>
    <td class="px-6 py-4 text-right">
        <a class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline delete" data-id="' . $row['id'] . '" data-major_name="' . $row['major_name'] .'" data-department_name="' . $row['department_name'] . '">Delete</a>
    </td></tr>
';
}
