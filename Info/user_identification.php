<?php

if($_SESSION['id'] == ''){
    header("Location: ../../Login.php");
    exit();
}
elseif($_SESSION['user_type'] == '1'){
    header("Location: company/financial_manager/index.php");
    exit();
}
elseif($_SESSION['user_type'] == '2'){
    header("Location: company/goods_manager/index.php");
    exit();
}
elseif($_SESSION['user_type'] == '3'){
    header("Location: dealer/index.php");
    exit();
}
?>