<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';

$hid = 'block';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}


$idx = 0;
$titlex = '';
$bodytextx = '';
$sourx = 0;
$timesx = '';

$tx = '';
$cx = '';
$sx = '';


$sql0 = "SELECT * from currentaffairs where id= '$id' ";
$result1x = $conn->query($sql0);
if ($result1x->num_rows > 0) {
    while ($row0 = $result1x->fetch_assoc()) {
        $idx = $row0["id"];
        $titlex = $row0["title"];
        $bodytextx = $row0["bodytext"];
        $sourx = intval($row0["infosource"]);
        $timesx = $row0["modifiedtime"];

        $tx = $row0["topic"];
        $cx = $row0["category"];
        $sx = $row0["subcategory"];

    }
}


?>

<style>
    .two-lines {
        line-height: 1.5em;
        max-height: 3em;
        overflow: hidden;
        text-align: justify;
        text-overflow: ellipsis;
        width: 100%;
    }

    .source-icon {
        height: 10px;
    }

    .affblock {
        overflow: hidden;
    }

    .affblock::before {
        content: '';
        position: absolute;
        height: 75px;
        width: 1px;
        background: teal;
        left: 37px;
        z-index: 0;
        overflow: hidden;
    }
</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Current Affairs</h1>
            <small>Editor
            </small>
        </div>
        <?php $pagelink = 'Affairs';
        include 'breadcrumb.php'; ?>
    </div>
    <!-- ***************************************************************************************************** -->


    <div class="row">
        <div class="col-md-12">
            <div class="ss">
                <div class="tile-body text-right">
                    <div id="countblock" hidden>0</div>
                    <?php if ($userlevel == 'Administrator' || $userlevel == 'Super Administrator') { ?>
                        <button class="btn btn-primary" onclick="addnew();" hidden>Add a Gyan</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row user" id="newblock" style="display:<?php echo $hid; ?>;">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                    <div class="timeline-post">

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Text for current affairs</label>
                                    <textarea class="form-control" id="textbody"
                                        rows="3 "><?php echo $titlex; ?></textarea>

                                    <small class="form-text text-muted" id="emailHelp"></small>
                                </div>

                                <div class="form-group" hidden>
                                    <label for="exampleInputFile">Add an image</label>
                                    <input class="form-control-file" id="opt1x" type="file" aria-describedby="fileHelp"
                                        disabled />
                                    <small class="form-text text-muted" id="fileHelp">
                                        Add an image if necessary
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-12 d-flex">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleSelect1">Topic / Subject</label>
                                        <select class="form-control" id="topic" onchange="catcat();">
                                            <option value="">Select a topic</option>
                                            <?php
                                            $sql5 = "SELECT topic FROM topics where topic != '' group by topic order by topic";
                                            $result6x = $conn->query($sql5);
                                            if ($result6x->num_rows > 0) {
                                                while ($row5 = $result6x->fetch_assoc()) {
                                                    $topic = $row5["topic"];
                                                    if ($topic == $topicq) {
                                                        $sel = '';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    echo '<option value="' . $topic . '"  ' . $sel . '>' . $topic . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">


                                    <div class="form-group">
                                        <label for="exampleSelect1">Category</label>
                                        <div id="catcat">
                                            <select class="form-control" id="category" onchange="subcatcat();">
                                                <option></option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3">


                                    <div class="form-group">
                                        <label for="exampleSelect1">Sub Category</label>
                                        <div id="subcatcat">
                                            <select class="form-control" id="subcategory">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">


                                    <div class="form-group">
                                        <label for="exampleSelect1">Critical Level</label>
                                        <div id="subcatcat">
                                            <select class="form-control" id="level">
                                                <option></option>
                                                <?php
                                                $sql0 = "SELECT * from sourcelist order  by id; ";
                                                $result1xx = $conn->query($sql0);
                                                if ($result1xx->num_rows > 0) {
                                                    while ($row0 = $result1xx->fetch_assoc()) {
                                                        $idxx = $row0["id"];
                                                        $sourcetitlex = $row0["sourcetitle"];
                                                        if ($sourx == $idxx) {
                                                            $sel = 'selected';
                                                        } else {
                                                            $sel = '';
                                                        }
                                                        echo '<option value="' . $idxx . '" ' . $sel . '>' . $sourcetitlex . '</option>';

                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="tile-footer">
                                        <button class="btn btn-success" type="submit"
                                            onclick="saveque(<?php echo $id; ?>,0);">Submit</button>
                                        <button class="btn btn-danger" onclick="canc();">Cancel</button>
                                        <div id="stinfo"></div>
                                    </div>
                                </div>
                            </div>

                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>







</main>

<script>
    document.getElementById("countblock").innerHTML = '<?php echo $ooo; ?>';
    var postblock = document.getElementById("postblock").offsetHeight;
    var winh = window.innerHeight;
    if (postblock < winh) {
        // document.getElementById("postblock").style.height = winh + 5 + 'px';
    }

    function fulldisp(id) {

        var p = document.getElementById("body" + id);
        p.classList.remove("two-lines");
    }

    function lll(id) {
        var cnt = parseInt(document.getElementById('ll' + id).innerHTML);
        var tail = 0;
        if (document.getElementById('lll' + id).classList.contains('fa-thumbs-o-up')) {
            $('#lll' + id).removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
            cnt++;
            tail = 1;
        } else {
            $('#lll' + id).removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
            cnt--;
            tail = 0;
        }

        var infor = "id=" + id + "&tail=" + tail + "&module=gyan";
        // alert(infor);
        $("#lll" + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/savelike.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#lll' + id).html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#lll" + id).html(html);



            }
        });

        document.getElementById('ll' + id).innerHTML = cnt;
    }
</script>


<script>
    function addnew() {
        document.getElementById("newblock").style.display = 'block';
    }
    function canc() {
        document.getElementById("quetext").value = '';
        document.getElementById("textbody").value = '';
        document.getElementById("topic").value = '';
        document.getElementById("category").value = '';
        document.getElementById("subcategory").value = '';
        document.getElementById("level").value = '';
        document.getElementById("newblock").style.display = 'none';
    }
</script>
<script>
    function saveque(id, tail) {
        var quetext = '';
        var textbody = document.getElementById("textbody").value;

        var topic = document.getElementById("topic").value;
        var category = document.getElementById("category").value;
        var subcategory = document.getElementById("subcategory").value;
        var ql = document.getElementById("level").value;

        var infor = "id=" + id + "&tail=" + tail + "&quetext=" + quetext + "&textbody=" + textbody + "&topic=" + topic + "&category=" + category + "&subcategory=" + subcategory + "&ql=" + ql;
        // alert(infor);
        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "backend/savecuraffair.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('****************');
            },
            success: function (html) {
                $("#stinfo").html(html);
                // document.getElementById("quetext").value = '';
                document.getElementById("textbody").value = '';


                document.getElementById("topic").value = '';
                document.getElementById("category").value = '';
                document.getElementById("subcategory").value = '';
                document.getElementById("level").value = '';
                // document.getElementById("newblock").style.display = 'none';
                if (id == 0) {
                    // window.location.href = 'queeditor.php';
                } else {
                    // window.location.href = 'index.php';
                }


            }
        });
    }
</script>

<script>
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
                document.getElementById("category").value = "<?php echo $cx; ?>";
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
                document.getElementById("subcategory").value = "<?php echo $sx; ?>";
            }
        });
    }
</script>


<script>
    function loadmore() {
        var curcount = parseInt(document.getElementById("countblock").innerHTML);
        var jax = curcount - 1;
        var ppp = document.getElementById("loadmore-" + jax).innerHTML;
        var check = ppp.indexOf("End of Gyan");
        if (check == -1) {
            var infor = "curcount=" + curcount;
            $("#loadmore-" + curcount).html("");
            $.ajax({
                type: "POST",
                url: "backend/loadmore.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#loadmore-' + curcount).html('...');
                },
                success: function (html) {
                    $("#loadmore-" + curcount).html(html);
                    document.getElementById("countblock").innerHTML = curcount + 1;
                }
            });
        }
        var postblock = document.getElementById("postblock").offsetHeight;
        var winh = window.innerHeight;
        if (postblock < winh) {
            // document.getElementById("postblock").style.height = winh + 5 + 'px';
        }
    }
</script>

<script>
    document.getElementById('topic').value = '<?php echo $tx; ?>';
    catcat();

</script>

<script>
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            loadmore();
        }
    });
</script>

<?php include 'footer.php';