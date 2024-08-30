<?php
// include 'config.inc.php';
session_start();
date_default_timezone_set('Asia/Dhaka');

$usr = $_SESSION["user"];
$userlevel = 'Guest';

include '../db.php';

//*****************************************************************
$sy = date('Y');
$td = date('Y-m-d');
$cur = date('Y-m-d H:i:s');
//********************************************************************

$sql0 = "SELECT * FROM usersapp where email='$usr' LIMIT 1";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $token = $row0["token"];
        $sccode = $row0["sccode"];
        $fullname = $row0["profilename"];
        $mobile = $row0["mobile"];
        $userlevel = $row0["userlevel"];
        $userid = $row0["userid"];
        $pth = $row0["photourl"];
        $exam = $row0["curexam"];
        $sy = $row0["session"];
        $otp = $row0["otp"];
        $otptime = $row0["otptime"];
    }
} else {
    $_SESSION["user"] = '';
    $sccode = 99;
    $userlevel = 'Guest';
}

$enum = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
$bnum = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
