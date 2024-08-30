<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$tail = $_POST['tail'];


if ($tail == 0) {
    $id = $_POST['id'];
    $quetext = $_POST['quetext'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];

    $topic = $_POST['topic'];
    $cat = $_POST['category'];
    $subcat = $_POST['subcategory'];
    $ql = $_POST['ql'];

    $mon = date('m');
    $yyy = date('Y');

    if ($id == 0) {

        $query331 = "INSERT INTO quebank (id, question, opt1, opt2, opt3, opt4, entryby, entrytime, modifiedby, modifiedtime, topic, category, subcategory, month, year, quelevel) 
                VALUES (NULL, '$quetext', '$opt1', '$opt1', '$opt1', '$opt1', '$usr', '$cur', '$usr', '$cur', '$topic', '$cat', '$subcat', '$mon', '$yyy', '$ql');";
        // echo $query331;
        $conn->query($query331);

    } else {
        $query331 = "UPDATE quebank set question='$quetext', opt1='$opt1', opt2='$opt2', opt3='$opt3', opt4='$opt4', modifiedby='$usr', modifiedtime='$cur', topic='$topic', category='$cat', subcategory='$subcat', quelevel='$ql' where id='$id';";
        $conn->query($query331);
        // $query3g = "update refbook set refno='$refno', date='$datee', title='$title' where id='$id' and sccode='$sccode';";
        // $conn->query($query3g);
    }

}




