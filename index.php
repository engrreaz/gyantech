<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hid = 'block';
} else {
    $id = 0;
    $hid = 'none';
}

$idx = 0;
$titlex = '';
$bodytextx = '';
$sourx = 0;
$timesx = '';

$tx = '';
$cx = '';
$sx = '';


$sql0 = "SELECT * from dailyaffairs where id= '$id' ";
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
        height: 20px;
    }
</style>

<main class="app-content">
    <div class="app-title" hidden>
        <div>
            <h1><i class="fa fa-dashboard"></i> Blank Page</h1>
            <p>Start a beautiful journey here</p>
        </div>
        <?php include 'breadcrumb.php'; ?>
    </div>
    <!-- ***************************************************************************************************** -->


    <div class="row">
        <div class="col-md-12">
            <div class="ss">
                <div class="tile-body text-right">
                    <div id="countblock" hidden>0</div>
                    <?php if ($userlevel == 'Administrator' || $userlevel == 'Super Administrator') { ?>
                        <button class="btn btn-primary" onclick="addnew();">Add a Gyan</button>
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
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Question</label>
                                    <input class="form-control" id="quetext" type="text" value="<?php echo $titlex; ?>"
                                        aria-describedby="emailHelp" placeholder="Question Text Here" />
                                    <small class="form-text text-muted" id="emailHelp"></small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Add an image</label>
                                    <input class="form-control-file" id="opt1x" type="file" aria-describedby="fileHelp"
                                        disabled />
                                    <small class="form-text text-muted" id="fileHelp">
                                        Add an image if necessary
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Details <b>Gyan</b> Here</label>
                                    <textarea class="form-control" id="textbody"
                                        rows="5"><?php echo $bodytextx; ?></textarea>

                                    <small class="form-text text-muted" id="emailHelp"></small>
                                </div>








                            </div>
                            <div class="col-md-4">
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
                                <div class="form-group">
                                    <label for="exampleSelect1">Category</label>
                                    <div id="catcat">
                                        <select class="form-control" id="category" onchange="subcatcat();">
                                            <option></option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Sub Category</label>
                                    <div id="subcatcat">
                                        <select class="form-control" id="subcategory">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

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


    <div class="row user" id="postblock">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">

                    <?php
                    $sql0 = "SELECT * from dailyaffairs where entrytime like '$td%' and status=1 order by id desc;";
                    $ooo = 0;
                    $result1t = $conn->query($sql0);
                    $nr = $result1t->num_rows;
                    if ($nr < 3) {
                        $sql0 = "SELECT * from dailyaffairs where   status=1  order by entrytime desc LIMIT 3;";
                        $ooo = 3 - $nr;
                    }


                    $result1 = $conn->query($sql0);
                    if ($result1->num_rows > 0) {
                        while ($row0 = $result1->fetch_assoc()) {
                            $id = $row0["id"];
                            $title = $row0["title"];
                            $bodytext = $row0["bodytext"];
                            $sour = intval($row0["infosource"]);
                            $times = $row0["modifiedtime"];
                            $who = $row0["entryby"];

                            $likes = $row0["likes"];
                            $shares = $row0["shares"];
                            $comments = $row0["comments"];

                            $ttx = $row0["topic"];
                            $ccx = $row0["category"];
                            $ssx = $row0["subcategory"];


                            $sql0g = "SELECT gyan from likebox where user='$usr' and itemid='$id'  order by responsetime desc LIMIT 1;";
                            $result1g = $conn->query($sql0g);
                            if ($result1g->num_rows > 0) {
                                while ($row0g = $result1g->fetch_assoc()) {
                                    $gyan = $row0g["gyan"];
                                    if ($gyan == 0) {
                                        $likeicon = 'fa-thumbs-o-up';
                                    } else {
                                        $likeicon = 'fa-thumbs-up';
                                    }
                                }
                            } else {
                                $likeicon = 'fa-thumbs-o-up';
                            }


                            ?>
                            <div class="timeline-post mb-1">
                                <div class="post-media">
                                    <a href="#"><img class="post-logo" src="source/post-logo.jpg" /></a>
                                    <div class="content" style="flex-grow:1;">
                                        <h5>
                                            <!-- <div class="float-right  btn p-1 pr-0"><img src="source/.png"
                                                    class="source-icon" /></div> -->
                                            <a href="#"><?php echo $title; ?></a>
                                        </h5>
                                        <div class="text-muted text-small d-block">
                                            <small class="text-info">
                                                <?php echo $ttx; ?> <i class="fa fa-circle-thin"></i>
                                            </small>
                                            <small><?php
                                            echo date('d-m-Y', strtotime($times));
                                            // timeago($times); 
                                            ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <div id="body<?php echo $id; ?>" class="two-lines" onclick="fulldisp(<?php echo $id; ?>);">
                                        <?php echo $bodytext; ?>
                                    </div>
                                </div>
                                <ul class="post-utility text-small">
                                    <li class="likes" onclick="lll(<?php echo $id; ?>);" style="cursor:pointer;">
                                        <div><i id="lll<?php echo $id; ?>" class="fa fa-fw fa-lg <?php echo $likeicon; ?>"></i>
                                            <span id="ll<?php echo $id; ?>"><?php echo $likes; ?></span> Likes
                                        </div>
                                    </li>
                                    <li class="shares" id="sss"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>
                                            <?php echo $shares; ?> Shares</a></li>

                                    <?php if ($who == $usr) { ?>
                                        <li class="shares " id="lnk"><a href="index.php?id=<?php echo $id; ?>&tail=0">
                                                Edit</a></li>
                                    <?php } ?>

                                    <li class="comments" id="ccc"><i class="fa fa-fw fa-lg fa-comment-o"></i>
                                        <?php echo $comments; ?> Comments</li>
                                </ul>
                            </div>
                            <?php
                        }
                    }
                    ?>


                    <div id="loadmore-<?php echo $ooo - 1; ?>"></div>
                    <div id="loadmore-<?php echo $ooo; ?>"></div>

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
        var quetext = document.getElementById("quetext").value;
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
            url: "backend/saveaffair.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);
                document.getElementById("quetext").value = '';
                document.getElementById("textbody").value = '';


                document.getElementById("topic").value = '';
                document.getElementById("category").value = '';
                document.getElementById("subcategory").value = '';
                document.getElementById("level").value = '';
                document.getElementById("newblock").style.display = 'none';
                if (id == 0) {
                    // window.location.href = 'queeditor.php';
                } else {
                    window.location.href = 'index.php';
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