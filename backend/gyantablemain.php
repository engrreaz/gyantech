<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
        <tr>
            <th>Topic/Subject</th>
            <th>Gyan</th>
            <th>Like</th>
            <th>Comments</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php
        if ($subcat != '') {
            $sql5 = "SELECT * FROM dailyaffairs where title!='' and topic='$topic' and category = '$cat' and subcategory='$subcat'  order by id desc";
        } else if ($cat != '') {
            $sql5 = "SELECT * FROM dailyaffairs where title!='' and topic='$topic' and category = '$cat'  order by id desc";
        } else if ($topic != '') {
            $sql5 = "SELECT * FROM dailyaffairs where title!='' and topic='$topic'  order by id desc";
        } else {
            $sql5 = "SELECT * FROM dailyaffairs where title!=''   order by id desc";
        }
        // echo $sql5;
        $result6x = $conn->query($sql5);
        if ($result6x->num_rows > 0) {
            while ($row5 = $result6x->fetch_assoc()) {
                $id = $row5["id"];
                $title = $row5["title"];
                $body = $row5["bodytext"];
                $topic = $row5["topic"];
                $cat = $row5["category"];
                $subcat = $row5["subcategory"];
                $stst = $row5["status"];
                $like = 0; // $row5["likecount"];
                $dislike = 0; // $row5["dislikecount"];
                $test = 0; // $row5["testtaken"];
                $pass = 0; // $row5["testpass"];
        
                if ($stst == 0) {
                    $btn = 'dark';
                } else if ($stst == 1) {
                    $btn = 'success';
                } else if ($stst == 2) {
                    $btn = 'warning';
                } else if ($stst == 3) {
                    $btn = 'info';
                } else {
                    $btn = 'danger';
                }
                ?>
                <tr>
                    <td><?php echo $topic; ?></td>
                    <td>
                        <small
                            class="d-block text-muted"><?php echo $cat . ' &nbsp;<i class="fa fa-circle"></i>&nbsp; ' . $subcat; ?></small>
                        <span class="text-primary" style="font-weight:700;">
                            <?php echo $title; ?>
                        </span>


                        <div id="detailsblock<?php echo $id; ?>" class="" style="display:none;">
                            <div class="text-small"><small><?php echo $body; ?></small></div>
                            <div class="d-flex">
                                <button class="btn btn-primary p-1" onclick="status(<?php echo $id; ?>, 0);" <?php if ($stst == 0)
                                       echo ' hidden'; ?>><small>Pending</small></button>
                                <button class="btn btn-success p-1 ml-1 mr-1" onclick="status(<?php echo $id; ?>,1);" <?php if ($stst == 1)
                                       echo ' hidden'; ?>><small>Aprove</small></button>
                                <button class="btn btn-warning p-1" onclick="status(<?php echo $id; ?>, 2);" <?php if ($stst == 2)
                                       echo ' hidden'; ?>><small>Reject</small></button>
                                <button class="btn btn-info p-1 ml-1" onclick="status(<?php echo $id; ?>,3);" <?php if ($stst == 3)
                                       echo ' hidden'; ?>><small>Suspend</small></button>
                                <button class="btn btn-danger p-1 ml-1" onclick="status(<?php echo $id; ?>,4);" <?php if ($stst == 4)
                                       echo ' hidden'; ?> disabled><small>Delete</small></button>
                                <div id="stinfo<?php echo $id; ?>"></div>
                            </div>

                        </div>
                    </td>
                    <td><?php echo $like . '/' . $dislike; ?></td>
                    <td><?php echo $test . '/' . $pass; ?></td>
                    <td>

                        <div id="stinfo"></div>




                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <button class="btn btn-<?php echo $btn;?>" type="button"
                                onclick="details(<?php echo $id; ?>,100);">Details</button>
                            <div class="btn-group" role="group">
                                <button class="btn btn-<?php echo $btn;?> dropdown-toggle" id="btnGroupDrop1" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" onclick="goto(<?php echo $id; ?>,0);">Edit</a>
                                    <!-- <a class="dropdown-item" href="#" onclick="saveque(<?php echo $id; ?>,2);">Delete</a> -->
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