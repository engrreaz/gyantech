<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
$topic = $_POST['topic'];
$cat = $_POST['cat'];
?>
<select class="form-control" id="subcategory" onclick="nofetch();">
    <option value="">Select a sub category</option>
    <?php
    $sql5 = "SELECT subcategory FROM topics where topic = '$topic' and category='$cat' and subcategory != '' group by subcategory order by subcategory";
    $result6x = $conn->query($sql5);
    if ($result6x->num_rows > 0) {
        while ($row5 = $result6x->fetch_assoc()) {
            $subcategory = $row5["subcategory"];
            echo '<option value="' . $subcategory . '">' . $subcategory . '</option>';
        }
    }
    ?>
</select>