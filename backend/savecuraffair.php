<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$tail = $_POST['tail'];


if ($tail == 0) {
    $id = $_POST['id'];
    $quetext = $_POST['textbody'];
    $textbody = $_POST['quetext'];
   
    $topic = $_POST['topic'];
    $cat = $_POST['category'];
    $subcat = $_POST['subcategory'];
    $ql = $_POST['ql'];

    $mon = date('m');
    $yyy = date('Y');

    if($userlevel == 'user'){
        $stst = 0;
    } else if($userlevel == 'Editor'){
        $stst = 1;
    } 

    if ($id == 0) {

        $query331 = "INSERT INTO currentaffairs (id, title, bodytext, entryby, entrytime, modifiedby, modifiedtime, topic, category, subcategory, infosource, status) 
                VALUES (NULL, '$quetext', '$textbody', '$usr', '$cur', '$usr', '$cur', '$topic', '$cat', '$subcat', '$ql', '$stst');";
       
        $conn->query($query331);

    } else {
        $query331 = "UPDATE currentaffairs set title='$quetext', bodytext='$textbody', modifiedby='$usr', modifiedtime='$cur', topic='$topic', category='$cat', subcategory='$subcat', infosource='$ql' where id='$id';";
        $conn->query($query331);

    }

}

//  echo $query331;


