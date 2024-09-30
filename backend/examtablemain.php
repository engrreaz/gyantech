<style>
    .grads {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        margin: auto;
    }

    .grads-cont {
        height: 32px;
        width: 32px;
        background: white;
        position: relative;
        left: 4px;
        top: 4px;
        border-radius: 50%;
    }
</style>
<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Exam Type & Date</th>
            <th>Questions</th>
            <th>Dur (Min)</th>
            <th colspan="3">My Attemts</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php
        $examtype = array();
        $sql5 = "SELECT * FROM examtype where (entryby = '$usr' || entryby LIKE '%Admin%')   order by id desc";
        $result6xt = $conn->query($sql5);
        if ($result6xt->num_rows > 0) {
            while ($row5 = $result6xt->fetch_assoc()) {
                $examtype[] = $row5;
            }
        }



        if ($subcat != '') {
            $sql5 = "SELECT * FROM quebank where question!='' and topic='$topic' and category = '$cat' and subcategory='$subcat'  order by id desc";
        } else if ($cat != '') {
            $sql5 = "SELECT * FROM quebank where question!='' and topic='$topic' and category = '$cat'  order by id desc";
        } else if ($topic != '') {
            $sql5 = "SELECT * FROM quebank where question!='' and topic='$topic'  order by id desc";
        } else {
            $sql5 = "SELECT * FROM examlist where username='$usr'   order by id desc";
        }
        $sql5 = "SELECT * FROM examlist where username='$usr'   order by id desc";
        // echo $sql5;
        $result6x = $conn->query($sql5);
        if ($result6x->num_rows > 0) {
            while ($row5 = $result6x->fetch_assoc()) {
                $id = $row5["id"];
                $et = $row5["examtype"];

                $ind = array_search($et, $examtype);
                $qcnt = $examtype[$ind]['quecount'];


                $dur_1 = $row5["dur_1"];
                $response_1 = $row5["response_1"];
                $correct_1 = $row5["correct_1"];
                if ($qcnt > 0) {
                    $t1 = 360 / $qcnt * ($correct_1);
                    $r1 = $t1 + 360 / $qcnt * ($response_1 - $correct_1);
                    $g1 = $r1 + 360 / $qcnt * ($qcnt - $response_1);
                } else {
                    $t1 = $r1 = $g1 = 0;
                }


                // $dur_2 = $row5["dur_2"];
                // $response_2 = $row5["response_2"];
                // $correct_2 = $row5["correct_2"];
        
                // $dur_3 = $row5["dur_3"];
                // $response_3 = $row5["response_3"];
                // $correct_3 = $row5["correct_3"];
        



                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td>
                        <?php echo $examtype[$ind]['examname']; ?>
                    </td>
                    <td>
                        <?php echo $qcnt; ?>
                    </td>
                    <td>
                        <?php echo $examtype[$ind]['timesec'] / 60; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($dur_1 > 0) {
                            ?>
                            <div class="d-block"  onclick="viewexam(<?php echo $id; ?>, 1)">
                                <div class="grads"
                                    style="background-image: conic-gradient(teal 0deg, teal <?php echo $t1; ?>deg, red <?php echo $t1; ?>deg,  red <?php echo $r1; ?>deg, lightgray <?php echo $r1; ?>deg, lightgray);">
                                    <div class="grads-cont"></div>
                                </div>
                                <div class="">
                                    <small>
                                        <span class="text-primary">C=<?php echo $correct_1; ?>, </span>
                                        <span class="text-danger">W=<?php echo $response_1 - $correct_1; ?>, </span>
                                        <span class="text-muted">N=<?php echo $qcnt - $response_1; ?></span>

                                    </small>

                                </div>
                            </div>

                            <?php
                        } else {
                            ?>
                            <button type="button" class="btn btn-primary" onclick="startexam(<?php echo $id; ?>, 1)">
                                Start Exam</button>
                            <?php
                        } ?>

                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" onclick="startexam(<?php echo $id; ?>, 2)" disabled>
                            Start Exam</button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" onclick="startexam(<?php echo $id; ?>, 3)" disabled>
                            Start Exam</button>
                    </td>


                    <td>

                        <div id="stinfo"></div>




                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown" hidden>
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