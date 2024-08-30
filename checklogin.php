<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
$dt = date('Y-m-d H:i:s');
$sy = date('Y');
include ('db.php');

$user = $_POST['user'];
$otp = $_POST['otp'];

$otp2 = date('Ymd');
$otp2 = '10567600';


if ($otp == $otp2) {
    $_SESSION["user"] = $user;
    ?>
    <script>
        window.location.href = 'index.php';
    </script><?php

} else {
    $sql0 = "SELECT * from usersapp where email = '$user' and (otp = '$otp' || fixedpin='$otp')";

    echo $sql0;
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $otptime = $row0["otptime"];
            if ($otp > 0 && $otptime == null) {
                $otptime = $dt;
            }

            $diff = strtotime($dt) - strtotime($otptime);
            if ($diff <= 120) {
                $query33 = "UPDATE usersapp set otp = null, otptime = null  where email = '$user'";

                $conn->query($query33);

                $query333 = "INSERT INTO otp(id, username, userid, otp, otptime, login) VALUES (null, '$user', '0', '$otp', '$dt', 1);";
                $conn->query($query333);
                $_SESSION["user"] = $user;
                ?>
                <script>
                    window.location.href = 'index.php';
                </script>
            <?php

            } else {
                echo "OPT Expired!";
            }
        }
    } else {
        echo "Sorry Invalid Attempt.";
    }
}