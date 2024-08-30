<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$id = $_POST['id'];
$tail = $_POST['tail'];

$query331 = "UPDATE dailyaffairs set status='$tail' where id='$id';";
$conn->query($query331);

echo 'Status Updated.';