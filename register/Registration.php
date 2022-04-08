<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#00A105" />
    <title>Easy Deals | إنشاء حساب</title>
    <link href="../RTL/css/bootstrap-arabic.min.css" rel="stylesheet">

    <link rel="icon" type="text/png" href="../images/Icon.png" >

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


<body style="background-color: #F5F5F5;">
<?php
include "../db.php";
include_once("../Info/analytics.php");
include_once ("../Info/Checking.php");
?>
<div id="wrap">
    <div id="main">
<header class="navbar navbar-inverse navbar-static-top" >
    <div class="container">
        <div>
            <div class="nav navbar-nav navbar-right">
                <span class="navbar-brand"><img src="../images/Logo.svg" height="100" width="120" style="margin-top: -32%" title="Easy Deals"></span>
            </div>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="../index.php">الصفحة الرئيسية</a></li>
            <li><a href="../Login.php">تسجيل الدخول</a></li>
            <li class="active"><a>انشاء حساب</a></li>
            <li><a href="../Privacy_Policy.php">سياسة الخصوصية</a></li>
        </ul>
    </div>
</header>

<div class="container" style="background-color: #F5F5F5;">
    <article class="row" style="margin-top: 9%; background-color: #F5F5F5;">
        <section class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h4>حساب شركة</h4></center>
                </div>
                <div class="panel-body">
                    <p>إذا كـنـت مـديـر لـشـركـة لاتـتردد بالـضـغـط عـلـى تـسـجـيل<br>كـل مـا تـحـتـاجـه هـو إدخـال بـيـانـاتـك بالإضـافـة إلـى بـيـانـات شـركـتـك<br>يـرجـى الـتـأكـد مـن إدخـال جـمـيـع الـبـيـانـات بـشـكـل صـحـيـح لـتـجـنـب حـدوث أي مـشـكـلـة فـي الـخـدمـة</p><br>
                    <a href="Company_Registration.php" class="btn btn-primary col-lg-6 col-lg-offset-3">تسجيل</a>
                </div>
            </div>
        </section>
        <aside class="col-lg-6">
            <form class="panel panel-group form-horizontal" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center><h4>حساب تاجر</h4></center>
                    </div>
                    <div class="panel-body">
                        <p>إذا كـنـت تـاجـر تـبـحـث عـن خـدمـات تـسـاعـدك في تـجـارتـك لا تـتـردد بالـضـغـط عـلى تـسـجـيـل<br>كـل مـا تـحـتـاجـه هـو إدخـال بـيـانـاتـك الـشـخـصـيـة<br>يـرجـى الـتـأكـد مـن إدخـال جـمـيـع الـبـيـانـات بـشـكـل صـحـيـح لـتـجـنـب حـدوث أي مـشـكـلـة فـي الـخـدمـة</p><br>
                        <a href="Dealer_Registration.php" class="btn btn-primary col-lg-6 col-lg-offset-3">تسجيل</a>
                    </div>
                </div>
            </form>
        </aside>
    </article>
</div>
    </div>
</div>

<div id="footer">
    <?php
    include "Footer.php";
    ?>
</div>

</body>
</html>