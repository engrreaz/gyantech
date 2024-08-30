<?php
$page_name = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$sql0 = "SELECT * FROM loader where page='$page_name' order by id LIMIT 1";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $id = $row0["id"];
        $load_title = $row0["title"];
        $load_subtitle = $row0["subtitle"];
        $load_icon = $row0["icon"];
        $load_description = $row0["description"];
        $load_progress = $row0["progress"];
    }
} else {
    $load_title = $page_name;
    $load_subtitle = 'Page are loading now';
    $load_icon = 'sync';
    $load_description = 'Please wait, while loading. It may take time to loading....';
    $load_progress = 0;
}

?>
<style>
    .spinner-grow {
        height: 15px;
        width: 15px;
    }
</style>




<div class="d-block text-center">
    <i class="mdi mdi-<?php echo $load_icon; ?> mdi-36px text-primary"></i>
    <h4 class="text-primary"><?php echo $load_title; ?></h4>
    <div class="text-small text-secondary"><?php echo $load_subtitle; ?></div>
    <div class="text-small text-muted"><small><?php echo $load_description; ?></small></div>
    <?php if ($load_progress == 1) { ?>
        <div class="progress">
            <div class="progress-bar" id="load_progress_bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                aria-valuemax="100" style="width:0%">
            </div>
        </div>
        <div class="sr-onlyx mt-1 text-small" id="load_prog">0% Complete</div>
        <div id="perc" hidden>0</div>
    <?php } else { ?>
        <div class="spinner-grow m-1 p-0 text-small text-primary" role="status"></div>
        <div class="spinner-grow m-1 p-0 text-small text-primary" role="status"></div>
        <div class="spinner-grow m-1 p-0 text-small text-primary" role="status"></div>
        <div class="spinner-grow m-1 p-0 text-small text-primary" role="status"></div>
        <div class="spinner-grow m-1 p-0 text-small text-primary" role="status"></div>
    <?php } ?>

    <div id="timesec" class="text-small text-muted" hidden>0</div>
    <div id="tts" class="text-small text-muted" hidden>0</div>
    <div id="loader-data" hidden>-------------------</div>
</div>


<script>
    const myInterval = setInterval(myTimer, 300);

    function myTimer() {
        //Math.floor(Math.random() * 101);
        var num = parseInt(document.getElementById("perc").innerHTML) + 1;
        var sec = parseInt(document.getElementById("timesec").innerHTML) + 1;
        if (num >= 100) num = 0;

        document.getElementById("load_progress_bar").style.width = num + "%";
        document.getElementById("load_prog").innerHTML = num + "% Complete";
        document.getElementById("perc").innerHTML = num;
        document.getElementById("timesec").innerHTML = sec;
        document.getElementById("tts").innerHTML = sec / 2 + ' Seconds.';
    }

    function myStopFunction() {
        clearInterval(myInterval);
    }
</script>