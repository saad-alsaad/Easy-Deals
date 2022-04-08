<?php
session_start();
    $_SESSION['id'] = '';
    $_SESSION['f_name'] = '';
    $_SESSION['l_name'] = '';
    $_SESSION['com_id'] = '';
    $_SESSION['user_type'] = '';
    $_SESSION['email'] = '';
    header("Location: ../Login.php");
    exit();
?>