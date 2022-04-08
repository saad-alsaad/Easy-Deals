<?php
include_once("../../Info/analytics.php");
?>

<script>
    window.onload = function(){
        var backgroundAudio=document.getElementById("btn_sound");
        backgroundAudio.volume=0.5;
        var backgroundAudio2=document.getElementById("not_sound");
        backgroundAudio2.volume=11;
    }

    $( document ).ready(function() {
        var audio = $("#btn_sound")[0];

        $("#main_page").mousedown(function() {
            audio.play();
        });

        $("#orders").mousedown(function() {
            audio.play();
        });

        $("#bills").mousedown(function() {
            audio.play();
        });

        $("#payments").mousedown(function() {
            audio.play();
        });

        $("#notifications").mousedown(function() {
            audio.play();
        });

    });
</script>

<audio id="btn_sound" >
    <source src="../../sound/button.mp3">
</audio>

<audio id="not_sound" >
    <source src="../../sound/Notification0.mp3">
</audio>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center user-image-back">
                <img src="../../images/find_user.png" class="img-responsive" />
            </li>

            <li>
                <a href="index.php" id="main_page"><i class="fa fa-desktop"></i>الصـفـحـة الرئـيـسـيـة</a>
            </li>

            <li>
                <a href="Orders.php" id="orders"><i class="fa fa-table "></i>الطـلـبـات</a>
            </li>

            <li>
                <a href="Bills.php" id="bills"><i class="fa fa-edit "></i>الـفـواتـيـر</a>
            </li>

            <li>
                <a href="Payments.php" id="payments"><i class="fa fa-sitemap "></i>الدفـعـات</a>
            </li>

            <li>
                <a href="Notifications.php" id="notifications"><i class="fa fa-edit "></i>الإشـعـارات</a>
            </li>
        </ul>
    </div>
</nav>