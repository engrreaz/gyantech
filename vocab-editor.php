<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';

// if ($userlevel == 'Super Administrator') {
// topic list
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

$root_word = $pos = '';
$sql0 = "SELECT * FROM vocab_word where id='$id'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $root_word = $row0['word'];
        $pos = $row0['pos'];
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
            <h1><i class="fa fa-dashboard"></i> Vocabulary</h1>
            <p>Start a beautiful journey here</p>
        </div>
        <?php $pagelink = 'Vocab Editor';
        include 'breadcrumb.php'; ?>
    </div>
    <!-- ***************************************************************************************************** -->


    <div class="row user">

        <div class="col-md-12">
            <div class="tile">
                <h4 class="ml-3">Root/Origianl Word</h4>
                <div class="tile-body d-flex">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleSelect1">Word</label>
                            <input type="text" id="word" class="form-control" value="<?php echo $root_word; ?>" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleSelect1">Parts of Speech</label>
                            <div id="catcat">
                                <select class="form-control" id="pos">
                                    <option></option>
                                    <option value="Noun" <?php if ($pos == 'Noun') {
                                        echo 'selected';
                                    } ?>>Noun</option>
                                    <option value="Pronoun" <?php if ($pos == 'Pronoun') {
                                        echo 'selected';
                                    } ?>>Pronoun
                                    </option>
                                    <option value="Adjective" <?php if ($pos == 'Adjective') {
                                        echo 'selected';
                                    } ?>>Adjective
                                    </option>
                                    <option value="Verb" <?php if ($pos == 'Verb') {
                                        echo 'selected';
                                    } ?>>Verb</option>
                                    <option value="Adverb" <?php if ($pos == 'Adverb') {
                                        echo 'selected';
                                    } ?>>Adverb</option>
                                    <option value="Preposition" <?php if ($pos == 'Preposition') {
                                        echo 'selected';
                                    } ?>>
                                        Preposition</option>
                                    <option value="Conjunction" <?php if ($pos == 'Conjunction') {
                                        echo 'selected';
                                    } ?>>
                                        Conjunction</option>
                                    <option value="Interjection" <?php if ($pos == 'Interjection') {
                                        echo 'selected';
                                    } ?>>
                                        Interjection</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleSelect1">Critical Level</label>
                            <div id="subcatcat">
                                <button class="btn btn-primary"
                                    onclick="save(<?php echo $id; ?>, 'word');">Save/Update</button>
                                <div id="word-box"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Bengali Meaning -->
        <div class="col-md-12">
            <div class="tile">
                <h5 class="ml-3">English - Bengali Meaning</h5>
                <div class="tile-body d-flex">
                    <div class="col-md-6">
                        <div id="mean-box">
                            <?php
                            $sql0 = "SELECT * FROM vocab_mean where word_id='$id' and word='$root_word'";
                            $result1 = $conn->query($sql0);
                            if ($result1->num_rows > 0) {
                                while ($row0 = $result1->fetch_assoc()) {
                                    $mean_id = $row0['id'];
                                    $mean = $row0['meaning'];

                                    echo $mean . ',';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            <input id="mean-id" />
                            <label for="exampleSelect1">Meaning (New/Updated)</label>
                            <input type="text" id="txt_e2b" class="form-control" value="<?php echo $root_word; ?>" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleSelect1">&nbsp;</label>
                            <div id="subcatcat">
                                <button class="btn btn-primary"
                                    onclick="save(<?php echo $id; ?>, 'mean');">Save/Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- E2E Meaning -->
        <div class="col-md-12">
            <div class="tile">
                <h5 class="ml-3">English - English Meaning</h5>
                <div class="tile-body d-flex">
                    <div class="col-md-6">
                        <div id="e2e-box">
                            <?php
                            $sql0 = "SELECT * FROM vocab_e2e where word_id='$id' and word='$root_word'";
                            $result2 = $conn->query($sql0);
                            if ($result2->num_rows > 0) {
                                while ($row0 = $result2->fetch_assoc()) {
                                    $mean_id = $row0['id'];
                                    $mean = $row0['eng_meaning'];

                                    echo $mean . ',';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="e2e-id" />
                            <label for="exampleSelect1">E2E (New/Updated)</label>
                            <input type="text" id="txt_e2e" class="form-control" value="<?php echo $root_word; ?>" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleSelect1">&nbsp;</label>
                            <div id="subcatcat">
                                <button class="btn btn-primary"
                                    onclick="save(<?php echo $id; ?>, 'e2e');">Save/Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Synonym Meaning -->
        <div class="col-md-12">
            <div class="tile">
                <h5 class="ml-3">Synonym</h5>
                <div class="tile-body d-flex">
                    <div class="col-md-6">
                        <div id="syno-box">
                            <?php
                            $sql0 = "SELECT * FROM vocab_synonym where word_id='$id' and word='$root_word'";
                            $result1 = $conn->query($sql0);
                            if ($result1->num_rows > 0) {
                                while ($row0 = $result1->fetch_assoc()) {
                                    $mean_id = $row0['id'];
                                    $mean = $row0['syno_word'];

                                    echo $mean . ',';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="syno-id" />
                            <label for="exampleSelect1">Synonym (New/Updated)</label>
                            <input type="text" id="txt_syno" class="form-control" value="<?php echo $root_word; ?>" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleSelect1">&nbsp;</label>
                            <div id="subcatcat">
                                <button class="btn btn-primary"
                                    onclick="save(<?php echo $id; ?>, 'syno');">Save/Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Antonym Meaning -->
        <div class="col-md-12">
            <div class="tile">
                <h5 class="ml-3">Antonym Meaning</h5>
                <div class="tile-body d-flex">
                    <div class="col-md-6">
                        <div id="anto-box">
                            <?php
                            $sql0 = "SELECT * FROM vocab_antonym where word_id='$id' and word='$root_word'";
                            $result1 = $conn->query($sql0);
                            if ($result1->num_rows > 0) {
                                while ($row0 = $result1->fetch_assoc()) {
                                    $mean_id = $row0['id'];
                                    $mean = $row0['anto_word'];

                                    echo $mean . ',';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="anto-id" />
                            <label for="exampleSelect1">Antonym (New/Updated)</label>
                            <input type="text" id="txt_anto" class="form-control" value="<?php echo $root_word; ?>" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleSelect1">&nbsp;</label>
                            <div id="subcatcat">
                                <button class="btn btn-primary"
                                    onclick="save(<?php echo $id; ?>, 'anto');">Save/Update</button>
                            </div>
                        </div>
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

    function viewexam(id, tail) {
        window.location.href = 'test-review.php?id=' + id + "&tail=" + tail;
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
    function save(id, tail) {
        var getid = 0;
        var word = document.getElementById("word").value;
        var pos = document.getElementById("pos").value;
        var e2b = document.getElementById("txt_e2b").value;
        var e2e = document.getElementById("txt_e2e").value;
        var syno = document.getElementById("txt_syno").value;
        var anto = document.getElementById("txt_anto").value;


        var infor = "id=" + id + "&tail=" + tail + "&word=" + word + "&pos=" + pos + "&e2b=" + e2b + "&e2e=" + e2e + "&syno=" + syno + "&anto=" + anto;


        if (tail != 'word') {
            var idx = document.getElementById(tail + "-id").value ;
            if (idx =='') idx = 0;
            infor = infor + '&idx=' + idx;
        }
        alert(infor);

        tail = tail + '-box';

        $("#" + tail).html("");

        $.ajax({
            type: "POST",
            url: "backend/save-vocab.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#' + tail).html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#" + tail).html(html);
                getid = document.getElementById("iiiddd").innerHTML;

                if (tail == 'word-box') {
                    window.location.href = 'vocab-editor.php?id=' + getid;
                }

            }
        });
    }


</script>





<?php
// } else {
//     include 'access-denied.php';
// }


include 'footer.php';


