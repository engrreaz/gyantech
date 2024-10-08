<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';


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
            <h1><i class="fa fa-th"></i> Topics / Category</h1>
            <p>Add / Edit Topics, Categories and Subcategories.</p>
        </div>
        <?php $pagelink = 'Topics';
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
                <h5 class="mb-3">Topics & Categories</h5>
                <div class="row ">
                    <div class="col-md-6">
                        <ul id="myUL">

                            <?php
                            // echo var_dump($topics);
                            foreach ($topics as $item) {
                                ?>
                                <li onclick="topi('<?php echo $item; ?>');"><span class="caret"><?php echo $item; ?></span>
                                    <ul class="nested">
                                        <?php
                                        $sql0 = "SELECT category FROM topics where topic='$item'  and category !='' group by category order by category";
                                        $result1 = $conn->query($sql0);
                                        if ($result1->num_rows > 0) {
                                            while ($row0 = $result1->fetch_assoc()) {
                                                $cate = $row0["category"];

                                                ?>

                                                <li onclick="cat('<?php echo $item; ?>','<?php echo $cate; ?>');">
                                                    <span class="caret">
                                                        <?php echo $cate; ?>
                                                    </span>

                                                    <ul class="nested">

                                                        <?php
                                                        $sql0 = "SELECT subcategory FROM topics where topic='$item' and category='$cate' and   subcategory !='' group by subcategory order by subcategory";
                                                        $result2 = $conn->query($sql0);
                                                        if ($result2->num_rows > 0) {
                                                            while ($row0 = $result2->fetch_assoc()) {
                                                                $subcate = $row0["subcategory"];
                                                                ?>

                                                                <li
                                                                    onclick="subcat('<?php echo $item; ?>','<?php echo $cate; ?>','<?php echo $subcate; ?>');">
                                                                    <span class="caret"><?php echo $subcate; ?></span>
                                                                    <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-md-6">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Topic/Subject</label>
                            <input class="form-control" id="topicname" type="text" value="" aria-describedby="emailHelp"
                                placeholder="" />
                            <small class="form-text text-muted" id="emailHelp"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <input class="form-control" id="catname" type="text" value="" aria-describedby="emailHelp"
                                placeholder="" />
                            <small class="form-text text-muted" id="emailHelp"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sub Category</label>
                            <input class="form-control" id="subcatname" type="text" value=""
                                aria-describedby="emailHelp" placeholder="" />
                            <small class="form-text text-muted" id="emailHelp"></small>
                        </div>
                        <div class="form-group d-flex">
                            <button class="btn btn-primary" onclick="savecat();">Submit Category</button>
                            <div id="subcatcat" class="p-2"></div>
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
        document.getElementById("topicname").value = txt;
        document.getElementById("catname").value = '';
        document.getElementById("subcatname").value = '';
        document.getElementsByClassName("caret").style.color = 'red';
        console.log(100);
        //   this.style.color  = "red";
    }

    function cat(t, c) {
        event.stopPropagation();
        document.getElementById("topicname").value = t;
        document.getElementById("catname").value = c;
        document.getElementById("subcatname").value = '';
    }

    function subcat(t, c, s) {
        event.stopPropagation();
        document.getElementById("topicname").value = t;
        document.getElementById("catname").value = c;
        document.getElementById("subcatname").value = s;

    }


</script>


<script>
    function savecat() {
        var topic = document.getElementById("topicname").value;
        var cat = document.getElementById("catname").value;
        var subcat = document.getElementById("subcatname").value;
        var infor = "topic=" + topic + "&cat=" + cat + "&subcat=" + subcat;;

        $("#subcatcat").html("");
        $.ajax({
            type: "POST",
            url: "backend/savecat.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#subcatcat').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#subcatcat").html(html);

                document.getElementById("topicname").value = '';
                document.getElementById("catname").value = '';
                document.getElementById("subcatname").value = '';

                $.notify({
                    title: "",
                    message: "Data Saved Successfully",
                    icon: 'fa fa-check'
                }, {
                    type: "success"
                });


            }
        });
    }
</script>


<script type="text/javascript">

    $('#demoSwal').click(function () {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });
</script>






<?php include 'footer.php';


