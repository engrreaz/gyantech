<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';

// if ($userlevel == 'Super Administrator') {
// topic list
$topics = array();
$sql0 = "SELECT topic FROM topics group by topic order by topic";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $topics[] = $row0['topic'];
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
            <h1><i class="fa fa-dashboard"></i> My Exam</h1>
            <p>Start a beautiful journey here</p>
        </div>
        <?php $pagelink = 'My Exam';
        include 'breadcrumb.php'; ?>
    </div>
    <!-- ***************************************************************************************************** -->


    <div class="row user">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">Create a beautiful dashboard</div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="tile">
                <h4 class="ml-3">Question Query Parameters</h4>
                <div class="tile-body d-flex">
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
                                        echo '<option value="' . $topic . '">' . $topic . '</option>';
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
                                <select class="form-control" id="category">
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
                                    <option value="1">Easy</option>
                                    <option value="3">Basic</option>
                                    <option value="5" selected>Standard</option>
                                    <option value="7">Intermadiate</option>
                                    <option value="10">Extreme</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive" id="quetable">
                        <?php $topic = '';
                        $cat = '';
                        $subcat = '';
                        include 'backend/examtablemain.php'; ?>
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

    function goto(id, tail) {
        window.location.href = 'queeditor.php?id=' + id + "&tail=" + tail;
    }

</script>


<script>
    function startexam(id, tail) {
        window.location.href = 'test-test.php?id=' + id + "&tail=" + tail;
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

        var infor = "id=" + id + "&tail=" + tail + "&quetext=" + quetext + "&opt1=" + opt1 + "&opt2=" + opt2 + "&opt3=" + opt3 + "&opt4=" + opt4 + "&topic=" + topic + "&category=" + category + "&subcategory=" + category;

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
                window.location.href = 'queeditor.php';

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
                quetable();
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
                quetable();
            }
        });
    }


    function nofetch() {
        quetable();
    }

    function quetable() {
        var topic = document.getElementById("topic").value;
        var cat = document.getElementById("category").value;
        var subcat = document.getElementById("subcategory").value;
        var infor = "topic=" + topic + "&cat=" + cat + "&subcat=" + subcat;

        $("#quetable").html("");
        $.ajax({
            type: "POST",
            url: "backend/examtable.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#quetable').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#quetable").html(html);
            }
        });
    }

    localStorage.setItem("dura", 0);
    localStorage.setItem("curno", 0);
    localStorage.setItem("curresp", '');
    document.cookie = "aaaa=";
    document.cookie = "exstart=";
</script>





<?php
// } else {
//     include 'access-denied.php';
// }


include 'footer.php';


