<?php
session_start();
// include_once 'auth/gpConfig.php';
$_SESSION["user"] = '';

// unset($_SESSION['token']);
// unset($_SESSION['userData']);

// $gClient->revokeToken();


session_destroy();


header("Location:index.php");
?>
<!-- <script>
    window.location.href = 'index.php';
</script>  -->