<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

if (isset($_GET['tail'])) {
    $tail = $_GET['tail'];
} else {
    $tail = 1;
}

$et = '';
$qlist = '0';
$sql5 = "SELECT * FROM examlist where username='$usr' and id='$id' order by id LIMIT 1";
$result6x = $conn->query($sql5);
if ($result6x->num_rows > 0) {
    while ($row5 = $result6x->fetch_assoc()) {
        $id = $row5["id"];
        $et = $row5["examtype"];
        $qlist = $row5["questions"];
        $opts = $row5['options'];
    }
}
$qlist = ltrim(str_replace('-', ', ', $qlist), ', ');

$title = $descrip = '';
$qcnt = $dur = $fm = 0;
$sql5 = "SELECT * FROM examtype where id='$et'";
$result6xt = $conn->query($sql5);
if ($result6xt->num_rows > 0) {
    while ($row5 = $result6xt->fetch_assoc()) {
        $title = $row5['examname'];
        $descrip = $row5['description'];
        $qcnt = $row5['quecount'];
        $dur = $row5['timesec'];
        $fm = $row5['fullmarks'];
    }
}

$tdur = $dur;
$str2 = $_COOKIE['aaaa'];
$exstart = $_COOKIE['exstart'];
$re = 0;
for ($h = 0; $h < strlen($str2); $h++) {
    $c = substr($str2, $h, 1);
    if ($c != '0') {
        $re++;
    }
}
?>


<style>
    ul,
    #myUL {
        list-style-type: none;
    }

    #myUL {
        margin: 0;
        padding: 0;
    }

    .caret {
        cursor: pointer;
        -webkit-user-select: none;
        /* Safari 3.1+ */
        -moz-user-select: none;
        /* Firefox 2+ */
        -ms-user-select: none;
        /* IE 10+ */
        user-select: none;
    }

    .caret::before {
        content: "\25B6";
        color: black;
        display: inline-block;
        margin-right: 6px;
    }

    .caret-down::before {
        -ms-transform: rotate(90deg);
        /* IE 9 */
        -webkit-transform: rotate(90deg);
        /* Safari */
        '
 transform: rotate(90deg);
    }

    .nested {
        display: none;
    }

    .active {
        display: block;
    }

    .opt {
        font-size: 20px;
        font-weight: 500;
        padding: 0;
        margin: 0;
    }

    .dot {
        width: 12px;
        height: 12px;
        background: teal;
        border-radius: 50%;
        margin-right: 3px;
    }

    .side-data {
        font-size: 24px;
        font-weight: 700;
    }

    .data-lbl {
        font-size: 12px;
        line-height: 15px;
    }

    .form-check-label {
        font-size: 20px;
        padding: 2px 0 0 8px;
    }

    .form-check-input {
        width: 20px;
        height: 20px;
    }
</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Test Window</h1>
            <p>You're at test/exam window to take a test...</p>
        </div>
        <?php $pagelink = 'Test';
        include 'breadcrumb.php'; ?>
    </div>
    <!-- ***************************************************************************************************** -->


    <div class="row " hidden>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">Create a beautiful dashboard</div>
            </div>
        </div>
    </div>



    <div class="row user">
        <div class="col-md-12">
            <div class="timeline-post">

                <div class="row ">
                    <div class="col-md-12">
                        <div id="curdur" class="d-block "
                            style="position:absolute; float:right; right:40px; font-size:30px; color:teal;font-weight:700;">
                            <?php echo $dur; ?>
                        </div>
                        <div id="curdur" class="d-block "
                            style="position:absolute; float:right; right:20px; top:10px; font-size:10px; color:teal;font-weight:400;">
                            sec</div>
                        <h3 class="text-primary"><?php echo $title; ?></h3>
                        <h6 class="text-small text-muted"><?php echo $descrip; ?></h6>


                        <div id="js" hidden></div>
                        <div id="allresp" hidden>
                            <?php for ($t = 0; $t < $qcnt; $t++) {
                                echo '0';
                            } ?>
                        </div>


                        <script>
                            var dura = localStorage.getItem("dura");
                            var curno = localStorage.getItem("curno");
                            var curresp = localStorage.getItem("curresp");


                            var qc = <?php echo $qcnt; ?>;
                            if (dura > 0 && curno < 1) curno = 1;
                            if (dura > 0) {
                                document.getElementById("curdur").innerHTML = dura;

                            }
                            var curno = document.getElementById("js").innerHTML = curno;
                            if (curresp == null || curresp == '') {
                                curresp = '';
                                var g = 1;
                                for (g = 1; g <= qc; g++) {
                                    curresp += '0';
                                }
                            }
                            document.getElementById("allresp").innerHTML = curresp;
                        </script>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                id="prog" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                ...
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row user">
        <div class="col-md-12">
            <div class="timeline-post d-flex">

                <div id="exstart" hidden><?php echo $exstart; ?></div>

                <div class="col-md-8">
                    <div class="row ">
                        <div class="col-md-12">
                            <div id="btn0" style="display:none; ;" class="bg-primary text-white p-4">
                                <div class="row">
                                    <div class="col-md-12 d-block text-center ">
                                        <i class="fa fa-pencil fa-5x "></i>
                                        <h4 class="">Exam is ready. Are you?</h4>

                                        <div>
                                            <div>Total Questions : <b><?php echo $qcnt; ?></b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Time : <b><?php echo $dur / 60 . ' min(s)'; ?></b></div>

                                        </div>
                                        <button class="btn btn-warning mt-3" onclick="startexam();">Start Exam</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">

                        <?php
                        $sl = 1;
                        $sql5 = "SELECT * FROM `quebank` where id in($qlist) order by rand();";
                        $sql5 = "SELECT * FROM `quebank` where id in($qlist);";
                        $result6xtd = $conn->query($sql5);
                        if ($result6xtd->num_rows > 0) {
                            while ($row5 = $result6xtd->fetch_assoc()) {
                                $qtext = $row5['question'];
                                $stext = $row5['subtext'];


                                $a = substr($opts, ($sl - 1) * 4 + 0, 1);
                                $b = substr($opts, ($sl - 1) * 4 + 1, 1);
                                $c = substr($opts, ($sl - 1) * 4 + 2, 1);
                                $d = substr($opts, ($sl - 1) * 4 + 3, 1);
                                $opt1 = $row5['opt' . $a];
                                $opt2 = $row5['opt' . $b];
                                $opt3 = $row5['opt' . $c];
                                $opt4 = $row5['opt' . $d];


                                $rex = substr($_COOKIE['aaaa'], $sl - 1, 1);
                                // echo $rex;
                                if ($rex == 1) {
                                    // echo 'Y';
                                } else {
                                    // echo 'N';
                                }
                                $sel = 0;
                                if ($rex == $a) {
                                    $sel = '1';
                                } else if ($rex == $b) {
                                    $sel = '2';
                                } else if ($rex == $c) {
                                    $sel = '3';
                                } else if ($rex == $d) {
                                    $sel = '4';
                                }
                                ?>
                                <div id="btn<?php echo $sl; ?>" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-12 d-flex  flex-grow">
                                            <h3 class="text-primary pr-3"><?php echo $sl; ?>.</h3>
                                            <div class="d-block">
                                                <h3 class="text-primary"><?php echo $qtext; ?></h3>
                                                <div class="text-muted text-small"><?php echo $stext; ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 d-flex">
                                            <div class="col-md-6 ">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio1<?php echo $sl; ?>"
                                                        name="rad<?php echo $sl; ?>" value="<?php echo $a; ?>"
                                                        onclick="respon(<?php echo $sl; ?>, <?php echo $a; ?>);" <?php if ($sel == 1)
                                                                  echo ' checked'; ?>>
                                                    <label class="form-check-label <?php if ($sel == 1)
                                                        echo 'text-danger'; ?>"
                                                        for="radio1<?php echo $sl; ?>"><?php echo $opt1; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio2<?php echo $sl; ?>"
                                                        name="rad<?php echo $sl; ?>" value="<?php echo $b; ?>"
                                                        onclick="respon(<?php echo $sl; ?>, <?php echo $b; ?>);" <?php if ($sel == 2)
                                                                  echo ' checked'; ?>>
                                                    <label class="form-check-label <?php if ($sel == 2)
                                                        echo 'text-danger'; ?>"
                                                        for="radio2<?php echo $sl; ?>"><?php echo $opt2; ?></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 d-flex">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio3<?php echo $sl; ?>"
                                                        name="rad<?php echo $sl; ?>" value="<?php echo $c; ?>"
                                                        onclick="respon(<?php echo $sl; ?>, <?php echo $c; ?>);" <?php if ($sel == 3)
                                                                  echo ' checked'; ?>>
                                                    <label class="form-check-label <?php if ($sel == 3)
                                                        echo 'text-danger'; ?>"
                                                        for="radio3<?php echo $sl; ?>"><?php echo $opt3; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio4<?php echo $sl; ?>"
                                                        name="rad<?php echo $sl; ?>" value="<?php echo $d; ?>"
                                                        onclick="respon(<?php echo $sl; ?>, <?php echo $d; ?>);" <?php if ($sel == 4)
                                                                  echo ' checked'; ?>>
                                                    <label class="form-check-label <?php if ($sel == 4)
                                                        echo 'text-danger'; ?>"
                                                        for="radio4<?php echo $sl; ?>"><?php echo $opt4; ?></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>

                                    <div class="row ">
                                        <div class="col-md-12 mt-3">

                                            <?php if ($sl > 1) {
                                                ?>
                                                <div class="float-left col-md-2"><button class="btn btn-danger container-fluid"
                                                        onclick="prev(<?php echo $sl; ?>)">Previous</button></div><?php
                                            }

                                            if ($sl < $qcnt) {
                                                ?>
                                                <div class=" float-right  col-md-2">
                                                    <button class="btn btn-primary container-fluid "
                                                        onclick="next(<?php echo $sl; ?>)">Next</button>
                                                </div><?php
                                            } else {
                                                ?>
                                                <div class=" float-right  col-md-3">
                                                    <button class="btn btn-success container-fluid " onclick="submitpaper()">Submit
                                                        Answer</button>
                                                </div><?php
                                            }
                                            // echo $a . '/' . $b . '/' . $c . '//' . $d;
                                            ?>
                                            <div id="resp<?php echo $sl; ?>" hidden> </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $sl++;
                            }
                        }

                        ?>
                        <div id="btn<?php echo $sl; ?>" style="display:none;;">
                            <div class="row">
                                <div class="col-md-12 d-block text-center">

                                    <h4 class="text-primary">You're now end of your test.</h4>

                                    <div id="stinfo">
                                    <div>
                                        <div>Total Time Taken : <div id="etime"></div>
                                        </div>
                                        <div>Response : 5 out of 8</div>
                                        <div>Submit you Paper?</div>
                                        <button class="btn btn-success" onclick="submitpaper();">Submit your
                                            paper?</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div id="side-bar" style="display:none;">
                        <div class="row pl-3">
                            <div class="">

                                <div class="text-info side-data" class="d-flex" style="">
                                    <span id="tres"><?php echo $re; ?></span> / <?php echo $qcnt; ?>
                                </div>
                                <div class="text-small text-muted data-lbl">Questions</div>
                            </div>
                            <div class="ml-4">
                                <div class="text-info side-data"><?php echo $dur / 60; ?></div>
                                <div class="text-small text-muted data-lbl">Time (M)</div>
                            </div>
                            <div class="ml-4">
                                <div class="text-info side-data"><?php echo $fm; ?></div>
                                <div class="text-small text-muted data-lbl">Full Marks</div>
                            </div>
                        </div>


                        <div class="row  pr-3 pt-3 ">
                            <div class="col-md-12 d-flex pb-3" style="overflow:auto;">
                                <?php



                                // $str = '<script>document.write(localStorage.getItem("curresp"));</script>';
                                

                                // echo $str2;
                                
                                for ($y = 1; $y <= $qcnt; $y++) {
                                    $tox = substr($str2, $y - 1, 1);
                                    // echo $tox;
                                    if ($tox < 1) {
                                        $ccc = 'muted';
                                    } else {
                                        $ccc = 'primary';
                                    }
                                    ?>
                                    <button class="btn btn-<?php echo $ccc; ?> mr-2 " id="bbtn<?php echo $y; ?>"
                                        onclick="curp(<?php echo $y; ?>)"><?php echo $y; ?></button>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                    <div id="side-bar2" class="" style="display:block;">
                        <div class="text-center pt-5">
                            <i class="fa fa-check-circle-o fa-5x"></i>
                            <br>Test are waiting for response...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</main>




<script>
    var curno = document.getElementById("js").innerHTML;
    document.getElementById("btn" + curno).style.display = 'block';

    function next(sl) {
        document.getElementById("btn" + sl).style.display = 'none';
        sl++;
        document.getElementById("btn" + sl).style.display = 'block';
        document.getElementById("js").innerHTML = sl;
    }

    function prev(sl) {
        document.getElementById("btn" + sl).style.display = 'none';
        sl--;
        document.getElementById("btn" + sl).style.display = 'block';
        document.getElementById("js").innerHTML = sl;
    }

    function curp(sl) {
        var x = document.getElementById("js").innerHTML;
        document.getElementById("btn" + x).style.display = 'none';
        document.getElementById("btn" + sl).style.display = 'block';
        document.getElementById("js").innerHTML = sl;
    }



    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function () {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }

</script>

<script>
    function respon(sl, opt) {
        var rrr = sl + '/' + opt;
        document.getElementById("resp" + sl).innerHTML = rrr;
        var qc = <?php echo $qcnt; ?>;
        document.getElementById("bbtn" + sl).classList.remove('btn-muted');
        document.getElementById("bbtn" + sl).classList.add('btn-primary');
        var all = document.getElementById("allresp").innerHTML.trim();
        // alert(all);
        var a = all.substr(0, sl - 1);
        var b = all.substr(sl, qc);
        var ar = a + opt + b;
        document.getElementById("allresp").innerHTML = ar;


        var dd = document.getElementById("curdur").innerHTML;
        // dd = 300;
        localStorage.setItem("dura", dd);
        localStorage.setItem("curno", sl + 1);
        localStorage.setItem("curresp", ar);
        document.cookie = "aaaa=" + ar;
        var tres = 0;
        for (let i = 0; i < ar.length; i++) {
            if (ar[i] == '0') {
                tres++;
            }
        }

        document.getElementById("tres").innerHTML = qc - tres;
        document.getElementById("etime").innerHTML = dd;



        next(sl);
    }
</script>

<script>
    function submitpaper() {
        var curno = parseInt(document.getElementById("js").innerHTML);
        clearInterval(tmr);
        var msg = '';
        var qc = <?php echo $qcnt; ?>;
        msg += ' Total Que : ' + qc;

        var ar = document.getElementById("allresp").innerHTML.trim();
        var nores = 0;
        var corr = 0;
        var wrong = '';
        for (let i = 0; i < ar.length; i++) {
            if (ar[i] == '0') {
                nores++;
            } else if (ar[i] == '1') {
                corr++;
            } else {
                var h = i + 1;
                wrong += h + '.';
            }
        }

        var res = qc - nores;
        msg += ' Response : ' + res;
        msg += ' Correct : ' + corr;


        localStorage.setItem("dura", 0);
        localStorage.setItem("curno", 0);
        localStorage.setItem("curresp", '');
        document.cookie = "aaaa=";
        document.cookie = "exstart=";
        qc++;
        document.getElementById("btn" + curno).style.display = 'none';
        document.getElementById("btn" + qc).style.display = 'block';
        clearInterval(tmr);
        // alert(msg);

        //****************************************************************************************
        // ******************************************************************************* */
        var tdur = <?php echo $tdur;?>;
        var dur = tdur - parseInt(document.getElementById("curdur").innerHTML);
        var etm = document.getElementById("exstart").innerHTML;
        qc--;
        var infor = "eid=<?php echo $id; ?>&et=<?php echo $et; ?>&dur=" + dur + "&tdur=" + tdur + "&qcnt=" + qc + "&qresp=" + res + "&qcorr=" + corr + "&qwrong=" + wrong + "&etm=" + etm;
        // alert(infor);
        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "backend/savesubmitexam.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);
        
            }
        });
    }
</script>

<script>
    var dur = parseInt(<?php echo $dur; ?>);

    function startexam() {
        var exstart = '<?php echo date('Y-m-d H:i:s'); ?>';
        document.cookie = "exstart=" + exstart;
        document.getElementById("exstart").innerHTML = exstart;
        var tmr = setInterval(myTimer, 10);
        next(0);
    }



    function myTimer() {

        var curdur = document.getElementById("curdur").innerHTML;
        curdur = Number(curdur - 0.01).toFixed(2);;
        var perc = curdur * 100 / dur;
        // alert(perc);
        document.getElementById("prog").style.width = perc + "%";
        document.getElementById("curdur").innerHTML = curdur;
        var cl = 0;
        if (perc < 51) {
            cl = (50 - perc) * (255 / 35) + 50;
            if (cl > 255) {
                cl = 255;
            }
            document.getElementById("curdur").style.color = "#" + (cl).toString(16) + '0000';
        } else {
            // document.getElementById("pax").style.backgroundColor = 'gray';
        }

        if (perc < 100) {
            document.getElementById("side-bar").style.display = "block";
            document.getElementById("side-bar2").style.display = "none";
        } else {
            document.getElementById("side-bar").style.display = "none";
            document.getElementById("side-bar2").style.display = "block";
        }
        if (perc == 0) {
            submitpaper();
        }
        localStorage.setItem("dura", curdur);
    }

    if (dura > 0) {
        var tmr = setInterval(myTimer, 10);
    } 
</script>



<script>
    function topi(txt) {
        document.getElementById("topicname").innerHTML = txt;
        document.getElementById("catname").innerHTML = '';
        document.getElementById("subcatname").innerHTML = '';
        document.getElementsByClassName("caret").style.color = 'red';
        console.log(100);
        //   this.style.color  = "red";
    }

    function cat(t, c) {
        event.stopPropagation();
        document.getElementById("topicname").innerHTML = t;
        document.getElementById("catname").innerHTML = c;
        document.getElementById("subcatname").innerHTML = '';
    }

    function subcat(t, c, s) {
        event.stopPropagation();
        document.getElementById("topicname").innerHTML = t;
        document.getElementById("catname").innerHTML = c;
        document.getElementById("subcatname").innerHTML = s;

    }
</script>

<script>
    function saveque(id, tail) {
        var quetext = document.getElementById("quetext").value;
        var opt1 = document.getElementById("opt1").value;
        var opt2 = document.getElementById("opt2").value;
        var opt3 = document.getElementById("opt3").value;
        var opt4 = document.getElementById("opt4").value;

        var topic = document.getElementById("topic").value;
        var category = document.getElementById("category").value;
        var subcategory = document.getElementById("subcategory").value;
        var ql = document.getElementById("level").value;

        var infor = "id=" + id + "&tail=" + tail + "&quetext=" + quetext + "&opt1=" + opt1 + "&opt2=" + opt2 + "&opt3=" + opt3 + "&opt4=" + opt4 + "&topic=" + topic + "&category=" + category + "&subcategory=" + subcategory + "&ql=" + ql;

        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "backend/saveque.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);
                if (id == 0) {
                    window.location.href = 'queeditor.php';
                } else {
                    window.location.href = 'quebank.php';
                }


            }
        });
    }

    function catcat() {
        var topic = document.getElementById("topic").value;
        var infor = "topic=" + topic;

        $("#catcat").html("");

        $.ajax({
            type: "POST",
            url: "backend/fetchcat.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#catcat').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#catcat").html(html);
                document.getElementById("category").value = "<?php echo $catq; ?>";
                subcatcat();
            }
        });
    }

    function subcatcat() {
        var topic = document.getElementById("topic").value;
        var cat = document.getElementById("category").value;
        var infor = "topic=" + topic + "&cat=" + cat;

        $("#subcatcat").html("");
        $.ajax({
            type: "POST",
            url: "backend/fetchsubcat.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#subcatcat').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#subcatcat").html(html);
                document.getElementById("subcategory").value = "<?php echo $subcatq; ?>";
            }
        });
    }
</script>

<script>
    document.getElementById('topic').value = '<?php echo $topicq; ?>';
    catcat();

</script>


<?php

include 'footer.php';