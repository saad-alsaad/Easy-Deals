<?php
session_start();
    $_SESSION['id'] = '';
    $_SESSION['f_name'] = '';
    $_SESSION['l_name'] = '';
    $_SESSION['user_type'] = '';
    $_SESSION['gud'] = '';
    $_SESSION['price'] = '';
    $_SESSION['company'] = '';
    $_SESSION['c'] = '';
$_SESSION['cid']='';
$_SESSION['gid']='';
    header("Location: ../Login.php");
    exit();
?>