<?php
    require_once('connect.php');

    $Login = trim($_GET['id']);

    $sql = "UPDATE user SET isActive = 1 WHERE Login = '$Login'";
    mysqli_query($conn, $sql);

    header("Location: ../admin_actuser.php");
?>