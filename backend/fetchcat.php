<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
$topic = $_POST['topic'];
?>
<select class="form-control" id="category" onchange="subcatcat();">
    <option value="">Select a category</option>
    <?php
    $sql5 = "SELECT category FROM topics where topic = '$topic' and category != '' group by category order by category";
    $result6x = $conn->query($sql5);
    if ($result6x->num_rows > 0) {
        while ($row5 = $result6x->fetch_assoc()) {
            $category = $row5["category"];
            echo '<option value="' . $category . '">' . $category . '</option>';
        }
    }
    ?>
</select>