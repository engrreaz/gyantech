<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$id = $_POST['id'];
$tail = $_POST['tail'];
$module = $_POST['module'];

if ($tail == 1) {
    $query331 = "UPDATE dailyaffairs set likes=likes+1 where id='$id';";
} else {
    $query331 = "UPDATE dailyaffairs set likes=likes-1 where id='$id';";
}
$conn->query($query331);

$pu = "INSERT INTO likebox(id, itemid, user, $module, responsetime) VALUES (NULL, '$id', '$usr', '$tail', '$cur');";
$conn->query($pu);

// echo 'Status Updated.';