<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;



// $sql0 = "SELECT id from topics where topic='$topic'  and category ='$cat' and subcategory = '$subcat' LIMIT 1";
// $result1 = $conn->query($sql0);
// if ($result1->num_rows > 0) {
//     while ($row0 = $result1->fetch_assoc()) {
//         $id = $row0["id"];
//         $query331 = "UPDATE topics set topic='$topic', category='$cat', subcategory='$subcat', modifiedby = '$usr', modifiedtime='$cur' where id='$id';";
//     }
// } else {

$examid = $_POST['eid'];
$etype = $_POST['et'];
$etime = $_POST['etm'];
$dur = $_POST['dur'];
$tdur = $_POST['tdur'];
$qct = $_POST['qcnt'];
$qr = $_POST['qresp'];
$qo = $_POST['qcorr'];
$qw = $_POST['qwrong'];
$ans = $_POST['allans'];
$rate = $qo * 100 / $qct;

$d_1 = $d_2 = $d_3 = 0;
$sql5 = "SELECT * FROM examlist where username='$usr'  and id='$examid'";
$result6x = $conn->query($sql5);
if ($result6x->num_rows > 0) {
    while ($row5 = $result6x->fetch_assoc()) {
        $d_1 = $row5["dur_1"];
        $d_2 = $row5["dur_2"];
        $d_3 = $row5["dur_3"];
    }
}
if ($d_1 == 0) {
    $rno = 1;
} else if ($d_2 == 0) {
    $rno = 2;
} else if ($d_3 == 0) {
    $rno = 3;
} else {
    $rno = 4;
}

$query331 = "INSERT INTO examsubmit (id, username, examid, examtype, respno, examtime, tduration, duration, examend, qtotal, qresp, qright, qwrong, rate, allans) 
                VALUES (NULL, '$usr', '$examid', '$etype', '0', '$etime', '$tdur', '$dur', '$cur', '$qct', '$qr', '$qo', '$qw', '$rate', '$ans');";
// echo $query331;
$conn->query($query331);

if ($rno < 4) {
    $query332 = "UPDATE examlist set dur_$rno='$dur', response_$rno='$qr', correct_$rno='$qo', wrong_$rno='$qw' where id='$examid' and username='$usr';";
    // echo $query332;
    $conn->query($query332);
}



?>

<div class="d-flex text-center" style="margin:auto;">
    <button class="btn btn-warning">Back to My Test</button>
    <button class="btn btn-info ml-3 mr-3">Share with Facebook</button>
    <button class="btn btn-danger">Review My Test</button>
</div>
<div>
    Buttons are under construction now. Not active now.
</div>