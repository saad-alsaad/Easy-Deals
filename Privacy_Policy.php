<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#00A105" />
    <title>Privacy Policy</title>
    <link  rel="stylesheet" href="RTL/css/bootstrap-arabic.css">
    <link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">
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
        }
    </style>
</head>
<body>
<?php
include "db.php";
include_once("Info/analytics.php");
include_once ("Info/Checking.php");
?>
<div id="wrap">
    <div id="main">
<header class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div>
            <div class="nav navbar-nav navbar-right">
                <span class="navbar-brand"><img src="images/Logo.svg" height="100" width="120" style="margin-top: -32%" title="Easy Deals"></span>
            </div>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="index.php">الصفحة الرئيسية</a></li>
            <li><a href="Login.php">تسجيل الدخول</a></li>
            <li><a href="register/Registration.php">انشاء حساب</a></li>
            <li class="active"><a>سياسة الخصوصية</a></li>
        </ul>
    </div>
</header>
<div class="container">
    <br>
    <article class="row">
        <section class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>سياسة الخصوصية وحماية المعلومات</h4>
                </div>
                <div class="panel-body">
                    <p>
                        .<br>
                        .<br>
                        .<br>
                        .<br>
                        .<br>
                        .<br>
                        .<br>
                        .<br>
                        .<br>
                        .<br>
                    </p>
                </div>
            </div>
        </section>
    </article>
</div>
    </div>
</div>
<!-- Footer -->
<div id="footer">
<?php
include "Footer.php";
?>
</div>
</body>

</html>