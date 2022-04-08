<?php
if($_SESSION['id'] == ''){
    header("Location: ../Login.php");
    exit();
}
elseif($_SESSION['user_type'] == '0'){
    header("Location: ../company/top_manager/index.php");
    exit();
}
elseif($_SESSION['user_type'] == '1'){
    header("Location: ../company/financial_manager/index.php");
    exit();
}
elseif($_SESSION['user_type'] == '2'){
    header("Location: ../company/goods_manager/index.php");
    exit();
}
?>