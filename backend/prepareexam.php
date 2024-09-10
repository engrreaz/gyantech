<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$examcode = $_POST['examcode'];
$opts = '';

$queset[] = '';
$sql0 = "SELECT * from examtype where examcode='$examcode' and entryby = '$usr' LIMIT 1";
$result1 = $conn->query($sql0);
if ($result1->num_rows > 0) {
    while ($row0 = $result1->fetch_assoc()) {
        $id = $row0["id"];
        $qcnt = $row0["quecount"];

        for ($i = 1; $i <= 10; $i++) {
            $t = 't' . $i;
            $c = 'c' . $i;
            $t = $row0["topicno_" . $i];
            $c = $row0["quecnt_" . $i];

            $sql0d = "SELECT id from quebank where topicid='$t'  ORDER BY RAND( ) LIMIT $c ";
            $result1d = $conn->query($sql0d);
            if ($result1d->num_rows > 0) {
                while ($row0d = $result1d->fetch_assoc()) {
                    $ids = $row0d["id"];
                    $queset[] = $ids;
                }
            }
        }
    }
}

$needmore = $qcnt - count($queset);
do {
    $queset = array_unique($queset);
    $needmore = $qcnt - count($queset) + 1;
    $sql0d = "SELECT id from quebank  ORDER BY RAND() LIMIT $needmore ";
    $result1dx = $conn->query($sql0d);
    if ($result1dx->num_rows > 0) {
        while ($row0d = $result1dx->fetch_assoc()) {
            $idss = $row0d["id"];
            $queset[] = $idss;
        }
    }
} while ($needmore > 0);

$qqq = implode('-', $queset);
echo $qqq;
// // echo '<br>';
// echo '<pre>' . print_r($queset) . '</pre>';
// ;
// echo $examcode;
for ($u = 0; $u < $qcnt; $u++) {
    $opts .= str_shuffle(1234);
}

$query331 = "INSERT INTO examlist (id, examtype, questions, options, username, createtime) VALUES (NULL, '$id', '$qqq', '$opts', '$usr', '$cur');";
echo $query331;
$conn->query($query331);
// echo 'Saved';