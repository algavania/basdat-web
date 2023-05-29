<?php
include "../../connect.php";
session_start();
$keyword = $_GET['keyword'];
$sql = "SELECT users.id, users.name, users.email, users.role, users.photo FROM users LEFT JOIN roles ON roles.id=users.role WHERE users.name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR roles.name LIKE '%$keyword%'";
$query = pg_query($connect, $sql);
$no = 1;
while ($row = pg_fetch_assoc($query)) {
    $role = $row['role'];
    if ($role == 1) $role = 'Guest';
    else if ($role == 2) $role = 'Student';
    else if ($role == 3) $role = 'Lecturer';
    else $role = 'Admin';

    $photo = '<td class="px-6 py-4">No Photo</td>';
    if ($row['photo'] != null) {
        $photo = '<td class="px-6 py-4">
        <a href="controller/admin/download.php?file=' . basename($row['photo']) . '" class="font-medium text-green-600 dark:text-green-500 hover:underline download">Download</a>
    </td>';
    }

    $text = '<td class="px-6 py-4 text-right">
    <a class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline delete" data-id="' . $row['id'] . '" data-nama="' . $row['name'] . '">Delete</a>
</td>';
    if ($row['id'] == $_SESSION['id']) {
        $text = '<td class="px-6 py-4 text-right">
        <a class="font-medium" data-id="' . $row['id'] . '" data-nama="' . $row['name'] . '"></a>
    </td>';
        }
    echo '<tr class="bg-white border-b dark:bg-gray-800 text-black dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
    ' . $no++ . '
    </th>
    <td class="px-6 py-4">
    ' . $row['name'] . '
    </td>
    <td class="px-6 py-4">
    ' . $row['email'] . '
    </td>
    <td class="px-6 py-4">
    ' . $role . '
    </td>'.$photo.'
    <td class="px-6 py-4 text-right">
        <a href="admin_form.php?id=' . $row['id'] . '" class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit" data-id="' . $row['id'] . '">Edit</a>
    </td>
    '.$text.'
</tr>
';
}