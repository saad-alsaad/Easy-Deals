<!DOCTYPE html>
<?php
session_start();
if($_SESSION['user_type'] == '0'){
    header("Location: company/top_manager/index.php");
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

include "db.php";

include_once("Info/analytics.php");
include_once ("Info/Checking.php");
include_once ("Info/Check_ip.php");
//if(checkProxy($ip)){
 //   header("Location: Block.php");
  //  exit();
//}
$flag = 0;
if(isset($_POST['login'])){

    $query = "SELECT ID, First_name, Last_name, User_type, Password, Email FROM users WHERE Username = '$_POST[user_name]'";
    mysqli_query($conn, $query) or die('Error querying database 1');
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($_POST['lg_password'],$row["Password"])){
            $query3 = "UPDATE users SET last_login = NOW() WHERE ID = '$row[ID]'";
            mysqli_query($conn, $query3) or die('Error querying database 3');
            
            $_SESSION['id'] = $row['ID'];
            $_SESSION['f_name'] = $row['First_name'];
            $_SESSION['l_name'] = $row['Last_name'];
            $_SESSION['user_type'] = $row['User_type'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['username_flag'] = "9";
            if($row['User_type'] == 0){
                //top manager
                $query2 = "SELECT company_id FROM top_manager WHERE user_id = ".$row['ID'];
                mysqli_query($conn, $query2) or die('Error querying database 2');
                $result2 = mysqli_query($conn, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $_SESSION['com_id'] = $row2['company_id'];
                header("Location: company/top_manager/index.php");

            }
            elseif ($row['User_type'] == 1){
                //financial manager
                $query2 = "SELECT company_id FROM financial_manager WHERE user_id = ".$row['ID'];
                mysqli_query($conn, $query2) or die('Error querying database 2');
                $result2 = mysqli_query($conn, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $_SESSION['com_id'] = $row2['company_id'];
                header("Location: company/financial_manager/index.php");

            }
            elseif ($row['User_type'] == 2){
                // goods manager
                $query2 = "SELECT company_id FROM goods_manager WHERE user_id = ".$row['ID'];
                mysqli_query($conn, $query2) or die('Error querying database 2');
                $result2 = mysqli_query($conn, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $_SESSION['com_id'] = $row2['company_id'];
                header("Location: company/goods_manager/index.php");
            }
            elseif ($row['User_type'] == 3){
                // dealer
                //cart counter
                $_SESSION['c'] = 0;
                header("Location: dealer/index.php");
                exit();
            }
        }
        else{
            $flag = 2;
        }
    }
    else{
        $flag = 1;
    }
}

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Easy Deals | تسجيل دخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#00A105" />
    <link href="RTL/css/bootstrap-arabic.min.css" rel="stylesheet">
    <link rel="icon" type="text/png" href="images/Icon.png" >
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        #wrap {
            min-height: 100%;
        }

        #main {
            overflow: auto;
            padding-bottom: 180px; /* must be same height as the footer */
        }

        #footer {
            position: relative;
            margin-top: -180px; /* negative value of footer height */
            height: 180px;
            clear: both;
        }

        /* Opera Fix thanks to Maleika (Kohoutec) */
        body:before {
            content: "";
            height: 100%;
            float: left;
            width: 0;
            margin-top: -32767px;/* thank you Erik J - negate effect of float*/
        }
        html,
        body {
            height: 100%;
            background: #efefef;
        }
        /*=== 2. Anchor Link ===*/
        a {
            color: #aaaaaa;
            transition: all ease-in-out 200ms;
        }
        a:hover {
            color: #333333;
            text-decoration: none;
        }
        /*=== 3. Text Outside the Box ===*/
        .etc-login-form {
            color: #919191;
        }
        .etc-login-form p {
            margin-bottom: 5px;

        }
        /*=== 4. Main Form ===*/
        .login-form-1 {
            max-width: 30%;
            border-radius: 5px;
            margin-right: 0;
        }
        .main-login-form {
            position: relative;
        }
        .login-form-1 .form-control {
            border: 0;
            box-shadow: 0 0 0;
            border-radius: 0;
            background: transparent;
            color: #555555;
            padding: 7px 0;
            font-weight: bold;
            height:auto;
        }
        .login-form-1 .form-control::-webkit-input-placeholder {
            color: #999999;
        }
        .login-form-1 .form-control:-moz-placeholder,
        .login-form-1 .form-control::-moz-placeholder,
        .login-form-1 .form-control:-ms-input-placeholder {
            color: #999999;
        }
        .login-form-1 .form-group {
            margin-bottom: 0;
            border-bottom: 2px solid #efefef;
            padding-right: 20px;
            position: relative;
        }
        .login-form-1 .form-group:last-child {
            border-bottom: 0;
        }
        .login-group {
            background: #ffffff;
            color: #999999;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .login-group-checkbox {
            padding: 5px 0;
        }
        /*=== 5. Login Button ===*/
        .login-form-1 .login-button {
            position: absolute;
            right: 95%;
            top: 50%;
            background: #ffffff;
            color: #999999;
            padding: 11px 0;
            width: 50px;
            height: 50px;
            margin-top: -25px;
            border: 5px solid #efefef;
            border-radius: 50%;
            transition: all ease-in-out 500ms;
        }
        .login-form-1 .login-button:hover {
            color: #555555;
            transform: rotate(450deg);
        }

        /*=== 7. Form - Main Message ===*/
        .login-form-main-message {
            background: #ffffff;
            color: #999999;
            border-left: 3px solid transparent;
            border-radius: 3px;
            margin-bottom: 8px;
            font-weight: bold;
            height: 0;
            padding: 0 20px 0 17px;
            opacity: 0;
            transition: all ease-in-out 200ms;
        }

        /*=== 8. Custom Checkbox & Radio ===*/
        /* Base for label styling */
        [type="checkbox"]:not(:checked),
        [type="checkbox"]:checked,
        [type="radio"]:not(:checked),
        [type="radio"]:checked {
            position: absolute;
            right: -9999px;
        }
        [type="checkbox"]:not(:checked) + label,
        [type="checkbox"]:checked + label,
        [type="radio"]:not(:checked) + label,
        [type="radio"]:checked + label {
            position: relative;
            padding-right: 25px;
            padding-top: 1px;
            cursor: pointer;
        }
        /* checkbox aspect */
        [type="checkbox"]:not(:checked) + label:before,
        [type="checkbox"]:checked + label:before,
        [type="radio"]:not(:checked) + label:before,
        [type="radio"]:checked + label:before {
            content: '';
            position: absolute;
            right: 0;
            top: 2px;
            width: 17px;
            height: 17px;
            border: 0 solid #aaa;
            background: #f0f0f0;
            border-radius: 3px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3);
        }
        /* checked mark aspect */
        [type="checkbox"]:not(:checked) + label:after,
        [type="checkbox"]:checked + label:after,
        [type="radio"]:not(:checked) + label:after,
        [type="radio"]:checked + label:after {
            position: absolute;
            color: #555555;
            transition: all .2s;
        }
        /* checked mark aspect changes */
        [type="checkbox"]:not(:checked) + label:after,
        [type="radio"]:not(:checked) + label:after {
            opacity: 0;
            transform: scale(0);
        }
        [type="checkbox"]:checked + label:after,
        [type="radio"]:checked + label:after {
            opacity: 1;
            transform: scale(1);
        }
        /* disabled checkbox */
        [type="checkbox"]:disabled:not(:checked) + label:before,
        [type="checkbox"]:disabled:checked + label:before,
        [type="radio"]:disabled:not(:checked) + label:before,
        [type="radio"]:disabled:checked + label:before {
            box-shadow: none;
            border-color: #8c8c8c;
            background-color: #878787;
        }
        [type="checkbox"]:disabled:checked + label:after,
        [type="radio"]:disabled:checked + label:after {
            color: #555555;
        }
        [type="checkbox"]:disabled + label,
        [type="radio"]:disabled + label {
            color: #8c8c8c;
        }
        /* accessibility */
        [type="checkbox"]:checked:focus + label:before,
        [type="checkbox"]:not(:checked):focus + label:before,
        [type="checkbox"]:checked:focus + label:before,
        [type="checkbox"]:not(:checked):focus + label:before {
            border: 1px dotted #f6f6f6;
        }
        /* hover style just for information */
        label:hover:before {
            border: 1px solid #f6f6f6 !important;
        }
        /*=== Customization ===*/
        /* radio aspect */
        [type="checkbox"]:not(:checked) + label:before,
        [type="checkbox"]:checked + label:before {
            border-radius: 3px;
        }
        [type="radio"]:not(:checked) + label:before,
        [type="radio"]:checked + label:before {
            border-radius: 35px;
        }
        /* selected mark aspect */
        [type="checkbox"]:not(:checked) + label:after,
        [type="checkbox"]:checked + label:after {
            content: '✔';
            top: 0;
            right: 2px;
            font-size: 14px;
        }
        [type="radio"]:not(:checked) + label:after,
        [type="radio"]:checked + label:after {
            content: '\2022';
            top: 0;
            right: 3px;
            font-size: 30px;
            line-height: 25px;
        }
        /*=== 9. Misc ===*/
        .logo {
            padding: 15px 0;
            font-size: 25px;
            color: #aaaaaa;
            font-weight: bold;
        }

    </style>
    <script src="js/jquery-1.11.3.min.js"></script>
</head>
<body>
<?php
include_once("Info/analytics.php");
include_once ("Info/Checking.php");
?>
<header class="navbar navbar-inverse navbar-static-top" >
    <div class="container">
        <div>
            <div class="nav navbar-nav navbar-right">
                <span class="navbar-brand"><img src="images/Logo.svg" height="100" width="120" style="margin-top: -32%" title="Easy Deals"></span>
            </div>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="index.php">الصفحة الرئيسية</a></li>
            <li class="active"><a>تسجيل الدخول</a></li>
            <li><a href="register/Registration.php">انشاء حساب</a></li>
            <li><a href="Privacy_Policy.php">سياسة الخصوصية</a></li>
        </ul>
    </div>
</header>
<!-- Where all the magic happens -->
<!-- LOGIN FORM -->
<div id="wrap">
    <div id="main">
<center>
    <br><br><br><br><br><br>
    <div class="logo">تسجيـــل دخـــول</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="login-form" class="text-left" action="Login.php" method="post">
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="lg_username" class="sr-only">Username</label>
                        <input type="text" class="form-control" id="lg_username" name="user_name" placeholder="إسم المستخدم" required>
                    </div>
                    <div class="form-group">
                        <label for="lg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="كلمة المرور" required>
                    </div>
                    <div class="form-group login-group-checkbox">
                        <input type="checkbox" id="lg_remember" name="lg_remember">
                        <label for="lg_remember">تذكر</label>
                    </div>
                </div>
                <button type="submit" name="login" class="login-button"><i class="glyphicon glyphicon-chevron-left"></i></button>

            </div>
            <div class="etc-login-form col-lg-12">
                <p> نسيت كلمة المرور ؟ <a href="#">إضغط هنا</a></p>
                <p> مستخدم جديد ؟ <a href="register/Registration.php">أنشئ حساب</a></p>
            </div>
            <br><br>
        </form>

    </div>
    <div class='form-group'>
        <div class='col-md-12'>
            <?php
            if($flag == 1){ ?>
            <div class='alert alert-danger'>
                <strong>خــطـأ بـإسـم المـسـتـخـدم</strong>
            </div>
            <?php $flag = 0; } elseif($flag == 2){ ?>
            <div class='alert alert-danger'>
                <strong>خــطـأ بكـلـمـة الـمـرور</strong>
            </div>
            <?php $flag = 0;} ?>
        </div>
    </div>
    <!-- end:Main Form -->

</center>
</div>
</div>
<div id="footer">
    <?php
    include "Footer.php";
    ?>
</div>


</body>
</html>
