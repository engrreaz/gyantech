<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$topic = $_POST['topic'];
$cat = $_POST['cat'];
$subcat = $_POST['subcat'];
include 'gyantablemain.php';