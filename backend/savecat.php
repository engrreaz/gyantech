<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$topic = $_POST['topic'];
$cat = $_POST['cat'];
$subcat = $_POST['subcat'];


$sql0 = "SELECT id from topics where topic='$topic'  and category ='$cat' and subcategory = '$subcat' LIMIT 1";
$result1 = $conn->query($sql0);
if ($result1->num_rows > 0) {
    while ($row0 = $result1->fetch_assoc()) {
        $id = $row0["id"];
        $query331 = "UPDATE topics set topic='$topic', category='$cat', subcategory='$subcat', modifiedby = '$usr', modifiedtime='$cur' where id='$id';";
    }
} else {
    $query331 = "INSERT INTO topics (id, topic, category, subcategory, createdby, createdtime, modifiedby, modifiedtime) 
                VALUES (NULL, '$topic', '$cat', '$subcat', '$usr', '$cur', '$usr', '$cur');";
}
// echo $query331;
$conn->query($query331);
// echo 'Saved';