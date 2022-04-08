<?php
session_start();
require "../Info/dealer_identification.php";
require "payment_processes.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Easy Deals | حساب زبون</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../RTL/css/bootstrap-arabic.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link rel="icon" type="text/png" href="../images/Icon.png" >
    <script src="../js/quick_search.js"></script>

    <script src="../js/ajax_jquery3.1.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#upload_icon_ok").hide();
            $("#upload_icon_error").hide();
        });
        var flag = 0;
        function up_image() {
            var oFile = document.getElementById("up_img").files[0];
            if(!(oFile.size <= 5242880)){
                $("#upload_icon_ok").hide();
                $("#upload_icon_error").show();
                document.getElementById("upload_icon_error").innerHTML = " الحجم اكبر من 5";
            }

            else if(!(/(\.png|\.jpg|\.jpeg)$/i.test($("#up_img").val()))) {
                $("#upload_icon_ok").hide();
                $("#upload_icon_error").show();
                document.getElementById("upload_icon_error").innerHTML = "يرجى إختيار صور تنتهي ب png او jpg او jpeg";
            }

            else{
                $("#upload_icon_error").hide();
                $("#upload_icon_ok").show();
                var ff = $("#up_img").val().split('\\');
                document.getElementById("upload_icon_ok").innerHTML = " " + ff[ff.length-1];
            }
        }

    </script>

    <style>
        #payments{
            background-color:  #EFEBE9;
        }

        #upload_icon_ok{
            color: #419641;
        }
        #upload_icon_error{
             color: #ac2925;
         }
    </style>
</head>

<body>
<?php include "header.php"; ?>

<div id="wrapper">
    <!-- /. NAV TOP  -->
    <?php include "Main_Menu.php"; ?>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="container" style="width: 100%;">
                <div class="form-group">
                    <br>
                    <?php

                    echo "
                        <div class='form-group'>
                            <div class='col-md-12'>
                            <br>";
                    if($_SESSION['payment_feedback'] == "1"){
                        echo "<div class='alert alert-success'>
                                        <strong>تم الإرسال بنجاح</strong>
                                  </div><br>";
                    }
                    elseif($_SESSION['payment_feedback'] == "2"){
                        echo "
                                                  <div class='alert alert-danger'>
                                                        <strong>حدث خطأ برفع الصورة يرجى المحاولة مرة أخرى </strong>
                                                  </div><br>
                                    ";
                    }
                    elseif ($_SESSION['payment_feedback'] == "3"){
                        echo "
                                                  <div class='alert alert-danger'>
                                                        <strong>حجم الصورة كورة يرجى إختيار حجم أقل من 5 ميغا</strong>
                                                  </div><br>
                                    ";
                    }
                    elseif ($_SESSION['payment_feedback'] == "4"){
                        echo "
                                                  <div class='alert alert-danger'>
                                                        <strong>يرجى إختيار صورة من نوع jpg أو png أو jpeg</strong>
                                                  </div><br>
                                    ";
                    }
                    echo "</div>
                        </div>";

                    unset($_SESSION['payment_feedback']);
                    ?>
                    <div class="col-md-12">
                        <h2 id="uuu"><center> الـــدفــــعـــات </center></h2><br>
                    </div>
                </div>

                <div class="form-group col-lg-12 Form_Group Edges">
                <form action="Payments.php" method="post">
                    <div class="col-lg-3">
                        <input type="text" name="word" list="live_search" id="word" class="form-control" placeholder="بــحــــث" onkeyup='state(this.value,"fetch_payments.php")'>

                        <datalist id="live_search">

                        </datalist>
                    </div>
                        <div class="col-lg-2">
                            <select class="form-control" name="sort">
                                <option value="">تــرتــيــب حــســب</option>
                                <option value="1" <?php echo $_SESSION['payment_date']; ?>>التاريخ</option>
                                <option value="2" <?php echo $_SESSION['payment_amount']; ?>>قــــيمة الــــدفــــع</option>
                                <?php unset($_SESSION['payment_date']); unset($_SESSION['payment_amount']); ?>
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" name="payment_type">
                                <option value="">نـــوع الــدفــع</option>
                                <option value="0" <?php echo $_SESSION['type_0']; ?> >كـــــاش</option>
                                <option value="2" <?php echo $_SESSION['type_2']; ?> >تـــقـــســـيـــط</option>
                                <option value="1" <?php echo $_SESSION['type_1']; ?> >شـــيــكـــات</option>
                            </select>
                            <?php unset($_SESSION['type_0']); unset($_SESSION['type_1']); unset($_SESSION['type_2']); ?>
                        </div>

                        <div class="col-lg-1">
                            <button type="submit" name="search" class="btn btn-primary Edges">بــحــث</button>
                        </div>
                </form>
                        <div class="col-lg-3">
                            <button class='btn btn-primary Edges' data-toggle='collapse' data-target='#add'>دفعة جــديــدة</button>
                        </div>
                </div>

                <div>
                    <hr>
                </div>

                <form action="Payments.php" method="post" enctype="multipart/form-data">
                    <div class='form-group col-lg-12 Record_Group Edges collapse' id="add" style='padding-bottom: 6px;'>
                        <div class='col-lg-3'>
                            <input type="text" id="gooddd" class="form-control" name="good" placeholder="قــــيمة الــــدفــــع">
                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" name="payment_type">
                                <option value="">نـــوع الــدفــع</option>
                                <option value="0" <?php echo $_SESSION['type_0']; ?> >كـــــاش</option>
                                <option value="2" <?php echo $_SESSION['type_2']; ?> >تـــقـــســـيـــط</option>
                                <option value="1" <?php echo $_SESSION['type_1']; ?> >شـــيــكـــات</option>
                            </select>
                            <?php unset($_SESSION['type_0']); unset($_SESSION['type_1']); unset($_SESSION['type_2']); ?>

                        </div>
                        <div class="col-lg-2">
                        <select name="type" class="form-control">
                            <option value="">رقم الـــفاتــورة</option>
                            <?php
                            for ($i = 0; $i < count($dealers[0]);$i++){
                                echo "<option value=".$dealers[0][$i].">".$dealers[1][$i]."</option>";
                            }
                            ?>
                        </select>
                        </div>

                        <div class='col-lg-4'>
                            <input type="file" name="up_img"  class="upload_img" id="up_img" accept="image/png,image/jpg,image/jpeg" onchange="up_image()" />
                            <label for="up_img" class="btn btn-default Edges">
                                <span class="glyphicon glyphicon-upload"> صورة الوصل</span>
                            </label>
                            <span id="upload_icon_ok" class="glyphicon glyphicon-ok" ></span>
                            <span id="upload_icon_error" class="glyphicon glyphicon-remove" ></span>
                        </div>

                        <div class='col-lg-1'>
                            <button class='btn btn-primary Edges' type='submit' name='add_new'>إضـــافـــة</button>
                        </div>

                    </div>
                </form>

                <div class="form-group col-lg-12 Record_Group Edges">

                    <div class="col-lg-2">
                        <label class="form-control"><center>قــــيمة الــــدفــــع</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control"><center>نـوع الـدفـع</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control"><center>رقم الـــفاتــورة</center></label>

                    </div>
                    <div class="col-lg-3">
                        <label class="form-control"><center>اسم الشركة</center></label>

                    </div>

                    <div class="col-lg-2">
                        <label class="form-control"><center>التاريخ</center></label>
                    </div>
                </div>

                <?php
                if(!$output){
                    echo "لا يوجد نتائج";
                }
                else{for($i = 0; $i < count($output[0]); $i++){
                    echo "
                <div class='form-group col-lg-12 Record_Group Edges' style='padding-bottom: 6px;'>
                    
                    
                    <div class='col-lg-2'>
                        <label class='form-control'><center>".$output[2][$i]."</center></label>
                    </div>

                    <div class=\"col-lg-2\">
                        <label class=\"form-control\"><center>".$output[4][$i]."</center></label>
                    </div>

                    <div class='col-lg-2'>
                        <label class='form-control'><center>".$output[0][$i]."</center><label>
                    </div>
                    <div class='col-lg-3'>
                        <label class='form-control'><center>".$output[6][$i]."</center></label>
                    </div>

                    <div class='col-lg-2'>
                        <label class='form-control'><center>".$output[3][$i]."</center></label>
                    </div>

                    <div class='col-lg-1'>
                        <button class='btn btn-warning Edges' data-toggle='collapse' data-target='#$i'>تفاصيل</button>
                    </div>
                    
                    <div class='col-lg-10'>
                        <div id=$i class='collapse'>
                                   <ul class=\"media-list\">
                                      <li class=\"media\">
                                        <div class=\"media-body col-lg-2\">
                                          <h4 class=\"media-heading\">الـوصـل:</h4>
                                        </div>
                                        <div class=\"media-left\">
                                          <a href=".$output[5][$i].">
                                            <img class=\"media-object\" src=".$output[5][$i]." alt=\"...\" width='250' height='250'>
                                          </a>
                                        </div>
                                      </li>
                                    </ul>
                        </div>
                    </div>
                </div>";}} ?>
            </div>
        </div>
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="../js/jquery-1.11.3.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="../RTL/js/bootstrap-arabic.min.js"></script>

</body>

</html>
<?php include "../notification/dealer_notification_checker.php"; ?>