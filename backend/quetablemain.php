<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
        <tr>
            <th>Topic/Subject</th>
            <th>Question</th>
            <th>Like/Dislike</th>
            <th>Test/Pass</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php
        if ($subcat != '') {
            $sql5 = "SELECT * FROM quebank where question!='' and topic='$topic' and category = '$cat' and subcategory='$subcat'  order by id desc";
        } else if ($cat != '') {
            $sql5 = "SELECT * FROM quebank where question!='' and topic='$topic' and category = '$cat'  order by id desc";
        } else if ($topic != '') {
            $sql5 = "SELECT * FROM quebank where question!='' and topic='$topic'  order by id desc";
        } else {
            $sql5 = "SELECT * FROM quebank where question!=''   order by id desc";
        }
        // echo $sql5;
        $result6x = $conn->query($sql5);
        if ($result6x->num_rows > 0) {
            while ($row5 = $result6x->fetch_assoc()) {
                $id = $row5["id"];
                $question = $row5["question"];
                $topic = $row5["topic"];
                $cat = $row5["category"];
                $subcat = $row5["subcategory"];
                $like = $row5["likecount"];
                $dislike = $row5["dislikecount"];
                $test = $row5["testtaken"];
                $pass = $row5["testpass"];

                ?>
                <tr>
                    <td><?php echo $topic; ?></td>
                    <td>
                        <small class="d-block text-muted"><?php echo $cat . ' &nbsp;<i class="fa fa-circle"></i>&nbsp; ' . $subcat; ?></small>
                        <?php echo $question; ?>
                    </td>
                    <td><?php echo $like . '/' . $dislike; ?></td>
                    <td><?php echo $test . '/' . $pass; ?></td>
                    <td>

                        <div id="stinfo"></div>




                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <button class="btn btn-primary" type="button" onclick="goto(<?php echo $id; ?>,0);">Edit</button>
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" onclick="details(<?php echo $id; ?>,2);">Details</a>
                                    <a class="dropdown-item" href="#" onclick="saveque(<?php echo $id; ?>,2);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown"></div>

                    </td>
                </tr>
                <?php
            }
        }
        ?>


    </tbody>
</table>