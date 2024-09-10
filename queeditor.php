<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';

if ($userlevel == 'Super Administrator' || $userlevel == 'Administrator') {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = 0;
    }

    if (isset($_GET['tail'])) {
        $tail = $_GET['tail'];
    } else {
        $tail = 0;
    }

    // topic list
    $topics = array();
    $sql0 = "SELECT topic FROM topics group by topic order by topic";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $topics[] = $row0['topic'];
        }
    }

    $topicq = $catq = $subcatq = $quetextq = $opt1 = $opt2 = $opt3 = $opt4 = '';
    $qlevel = 5;
    $like = $dislike = $test = $pass = 0;
    $sql0 = "SELECT * FROM quebank where id='$id'";
    $result01 = $conn->query($sql0);
    if ($result01->num_rows > 0) {
        while ($row0 = $result01->fetch_assoc()) {
            $topicq = $row0['topic'];
            $catq = $row0['category'];
            $subcatq = $row0['subcategory'];
            $quetextq = $row0['question'];
            $opt1 = $row0['opt1'];
            $opt2 = $row0['opt2'];
            $opt3 = $row0['opt3'];
            $opt4 = $row0['opt4'];
            $qlevel = $row0['quelevel'];

            $like = $row0['likecount'];
            $dislike = $row0['dislikecount'];
            $test = $row0['testtaken'];
            $pass = $row0['testpass'];
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
    </style>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Questions Editor</h1>
                <p>Add or edit your question inside quetions bank.</p>
            </div>
            <?php include 'breadcrumb.php'; ?>
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
                    <div class="row">

                        <div class="col-md-8">
                            <h5 class="mb-3">Question Submission Form</h5>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <ul class="post-utility d-flex">
                                    <li class="likes"><i class="fa fa-fw fa-lg fa-thumbs-up"></i> <?php echo $like;?></li>
                                    <li class="likes"><i class="fa fa-fw fa-lg fa-thumbs-down"></i> <?php echo $dislike;?></li>

                                    <li class="likes"><i class="fa fa-fw fa-lg fa-question"></i> <?php echo $test;?> Test Taken</li>
                                    <li class="comments"><i class="fa fa-fw fa-lg fa-check"></i> <?php echo $pass;?> Test Pass</li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="row ">
                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Question</label>
                                <input class="form-control" id="quetext" type="text" value="<?php echo $quetextq; ?>"
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
                                <label for="exampleInputEmail1">Option # 1</label>
                                <input class="form-control" id="opt1" type="text" value="<?php echo $opt1; ?>"
                                    aria-describedby="emailHelp" placeholder="Option - A" />
                                <small class="form-text text-muted" id="emailHelp"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Option # 2</label>
                                <input class="form-control" id="opt2" type="text" value="<?php echo $opt2; ?>"
                                    aria-describedby="emailHelp" placeholder="Option - B" />
                                <small class="form-text text-muted" id="emailHelp"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Option # 3</label>
                                <input class="form-control" id="opt3" type="text" value="<?php echo $opt3; ?>"
                                    aria-describedby="emailHelp" placeholder="Option - C" />
                                <small class="form-text text-muted" id="emailHelp"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Option # 4</label>
                                <input class="form-control" id="opt4" type="text" value="<?php echo $opt4; ?>"
                                    aria-describedby="emailHelp" placeholder="Option - D" />
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
                                        <option value="1" <?php if ($qlevel == 1)
                                            echo 'selected'; ?>>Easy</option>
                                        <option value="3" <?php if ($qlevel == 3)
                                            echo 'selected'; ?>>Basic</option>
                                        <option value="5" <?php if ($qlevel == 5)
                                            echo 'selected'; ?> selected>Standard
                                        </option>
                                        <option value="7" <?php if ($qlevel == 7)
                                            echo 'selected'; ?>>Intermadiate</option>
                                        <option value="10" <?php if ($qlevel == 10)
                                            echo 'selected'; ?>>Extreme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"
                                    onclick="saveque(<?php echo $id; ?>,0);">Submit</button>
                                <div id="stinfo"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>












    </main>




    <script>
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
} else {
    include 'access-denied.php';
}

include 'footer.php';