<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
include 'func.php';

$curcount = $_POST['curcount'];

$sql0 = "SELECT * from dailyaffairs where entrytime < '$td'  and status=1 order by id desc LIMIT 1 OFFSET $curcount ;";
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

        ?>
        <div class="timeline-post">
            <div class="post-media">
                <a href="#"><img class="post-logo" src="source/post-logo.jpg" /></a>
                <div class="content" style="flex-grow:1;">
                    <h5>
                        <div class="float-right  btn p-1"><img src="source/<?php echo $sour; ?>.png" class="source-icon" />
                        </div>
                        <a href="#"><?php echo $title; ?></a>
                    </h5>
                    <div class="text-muted text-small d-block">
                        <small class="text-info">
                            <?php echo $ttx; ?> <i class="fa fa-circle-thin"></i>
                        </small>
                        <small><?php timeago($times); ?></small>
                    </div>
                </div>
            </div>
            <div class="post-content">
                <div class="two-lines"><?php echo $bodytext; ?></div>
            </div>
            <ul class="post-utility text-small">
                <li class="likes" onclick="lll(<?php echo $id; ?>);">
                    <div><i id="lll<?php echo $id; ?>" class="fa fa-fw fa-lg fa-thumbs-o-up"></i>
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
} else {
    ?>
    <div class="text-center text-muted">End of Gyan</div>
    <?php
}
$curcount++;

?>


<div id="loadmore-<?php echo $curcount; ?>"></div>