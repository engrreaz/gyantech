<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$id = $_POST['id'];
$tail = $_POST['tail'];
$word = $_POST['word'];
$pos = $_POST['pos'];
$e2b = $_POST['e2b'];
$e2e = $_POST['e2e'];
$syno = $_POST['syno'];
$anto = $_POST['anto'];
$idx = 0;
if ($tail != 'word') {
    $idx = $id;
    $id = $_POST['idx'];
}


if ($id > 0) {
    switch ($tail) {
        case 'word':
            $sql = "UPDATE vocab_word SET word='$word', pos='$pos' where id='$id'";
            break;
        case 'mean':
            $sql = "UPDATE vocab_mean SET meaning='$word' where id='$id'";
            break;
        case 'e2e':
            $sql = "UPDATE vocab_e2e SET eng_meaning='$word' where id='$id'";
            break;
        case 'syno':
            $sql = "UPDATE vocab_synonym SET syno_word='$word' where id='$id'";
            break;
        case 'anto':
            $sql = "UPDATE vocab_antonym SET anto_word='$word' where id='$id'";
            break;
        default:
            break;
    }
} else {
    switch ($tail) {
        case 'word':
            $sql = "INSERT INTO vocab_word (id, word, pos, notes, entryby, entrytime) VALUES (NULL, '$word', '$pos', '', '$usr', '$cur')";
            break;
        case 'mean':
            $sql = "INSERT INTO  vocab_mean  (id, word_id, word, meaning, notes, entryby, entrytime) VALUES (NULL, '$idx', '$word', '$e2b', '', '$usr', '$cur')";
            break;
        case 'e2e':
            $sql = "INSERT INTO  vocab_e2e  (id, word_id, word, eng_meaning, notes, entryby, entrytime) VALUES (NULL, '$idx', '$word', '$e2e', '', '$usr', '$cur')";
            break;
        case 'syno':
            $sql = "INSERT INTO  vocab_synonym  (id, word_id, word, syno_word, notes, entryby, entrytime) VALUES (NULL, '$idx', '$word', '$syno', '', '$usr', '$cur')";
            break;
        case 'anto':
            $sql = "INSERT INTO  vocab_antonym  (id, word_id, word, anto_word, notes, entryby, entrytime) VALUES (NULL, '$idx', '$word', '$anto', '', '$usr', '$cur')";
            break;
        default:
            break;
    }
}

echo $sql;
$conn->query($sql);

if ($id == 0) {
    // $id = mysqli_insert_id($conn);
    $id = $conn->insert_id;
}

echo '<div id="iiiddd">' . $id . '</div>';

echo 'Pack Pack';


switch ($tail) {
    case 'word':
        break;
    case 'mean':
        $pick = "Select * from vocab_mean where word_id='$idx' and word='$word'";
        $fld = 'meaning';
        break;
    case 'e2e':
        $pick = "Select * from vocab_e2e where word_id='$idx' and word='$word'";
        $fld = 'eng_meaning';
        break;
    case 'syno':
        $pick = "Select * from vocab_synonym where word_id='$idx' and word='$word'";
        $fld = 'syno_word';
        break;
    case 'anto':
        $pick = "Select * from vocab_antonym where word_id='$idx' and word='$word'";
        $fld = 'anto_word';
        break;
    default:
        break;
}

$result1 = $conn->query($pick);
if ($result1->num_rows > 0) {
    while ($row0 = $result1->fetch_assoc()) {
        $wrd_id = $row0['id'];
        $wrd = $row0[$fld];

        echo $wrd . ', ';
    }
}


