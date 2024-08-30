<?php
include 'header.php';
include 'topbar.php';
include 'navbar.php';

?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-university"></i> Current Affairs</h1>
            <p>The important issues and facts around the world are listed here.</p>
        </div>
        <?php $pagelink = 'Current Affairs';
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
            <?php
            $sql0 = "SELECT year FROM currentaffairs where year>0 group by year order by year desc";
            $result1 = $conn->query($sql0);
            if ($result1->num_rows > 0) {
                while ($row0 = $result1->fetch_assoc()) {
                    $year = $row0["year"];

                    echo '<h5>' . $year . '</h5>';

                    echo '<div class="row ">';

                    $sql0m = "SELECT month FROM currentaffairs where year='$year' group by month order by month desc";
                    $result1m = $conn->query($sql0m);
                    if ($result1m->num_rows > 0) {
                        while ($row0m = $result1m->fetch_assoc()) {
                            $month = $row0m["month"];

                            $sql0mc = "SELECT count(*) as cnt FROM currentaffairs where year='$year' and month='$month'";
                            $result1mc = $conn->query($sql0mc);
                            if ($result1mc->num_rows > 0) {
                                while ($row0mc = $result1mc->fetch_assoc()) {
                                    $cnt = $row0mc["cnt"];
                                }
                            }
                            ?>

                            <div class="col-md-2" onclick="goto(<?php echo $month; ?>, <?php echo $year; ?>);">
                                <div class="timeline-post">
                                    <b><?php echo date('F', strtotime("2024-$month-01")); ?></b>
                                    <div style="font-size:10px;"><?php echo $cnt; ?> Facts</div>
                                </div>
                            </div>

                            <?php
                        }
                    }

                    echo '</div>';
                }
            }
            ?>
        </div>


</main>




<script>
    function goto(month, year) {
        window.location.href = 'currentaffairs.php?year=' + year + '&month=' + month;
    }
</script>






<?php include 'footer.php';