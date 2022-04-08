<?php
session_start();
require "../../Info/user_identification.php";
require "dealer_processes.php";
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Easy Deals | حساب الـشـركة</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="../../RTL/css/bootstrap-arabic.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="../../css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="../../css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link rel="icon" type="text/png" href="../../images/Icon.png" >

        <script src="../../js/ajax_jquery3.1.0.min.js"></script>
        <script src="../../js/validators.js"></script>
        <script src="../../js/quick_search.js"></script>

        <style>
            #dealers{
                background-color:  #EFEBE9;
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
                        <div class="col-md-12">
                            <h2><center> الـــعـــمــلاء </center></h2><br>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 Form_Group Edges">
                        <form action="Dealers.php" method="post">
                            <div class="col-lg-3">
                                <input name="word" list="live_search" id="word" type="text" class="form-control" placeholder="بــحــــث" onkeyup='state(this.value,"fetch_dealers.php")'>

                                <datalist id="live_search">
                                </datalist>

                            </div>

                            <div class="col-lg-2">
                                <select class="form-control">
                                    <option value="">تــرتــيــب حــســب</option>
                                    <option value="" selected>التاريخ</option>

                                </select>
                            </div>

                            <div class="col-lg-2">
                                <select class="form-control" name="sort">
                                    <option value=""> الفواتير </option>
                                    <option value="1">الـفـواتـيـر المتبقية</option>
                                </select>
                            </div>

                            <div class="col-lg-1">
                                <input type="submit" name="search" class="btn btn-primary Edges" value="بــحــث"/>
                            </div>
                        </form>
                        <!--
                        <div class="col-lg-3">
                            <button class='btn btn-primary Edges' data-toggle='collapse' data-target='#add'>إضـــافـــة</button>
                        </div> -->
                    </div>

                    <div class="form-group col-lg-12 Record_Group Edges">
                        <div class="col-lg-3">
                            <label class="form-control"><center>الإســم</center></label>
                        </div>

                        <div class="col-lg-2">
                            <label class="form-control"><center>عـدد الـفـواتـيـر</center></label>
                        </div>

                        <div class="col-lg-3">
                            <label class="form-control"><center>عـدد الفواتير الغير مدفوعة</center></label>
                        </div>

                        <div class="col-lg-3">
                            <label class="form-control"><center>عدد الفواتير المنتهية</center></label>

                        </div>

                    </div>

                    <?php
                    if(!$output){
                        echo "لا يــوجــد عــمــلاء";
                    }
                    else{
                        for($i = count($output[0])-1; $i >= 0 ; $i--){
                            echo "
                        <div class='form-group col-sm-12 Record_Group Edges' style='padding-bottom: 6px;'>
                            <div class='col-lg-3'>
                                <label class='form-control' style='resize: none; height: 35px;'>".$output[0][$i]."</label>
                            </div>

                            <div class='col-lg-2'>
                                <label class='form-control' ><center>".$output[2][$i]."</center></label>
                            </div>

                            <div class='col-lg-3'>
                                <label class='form-control' ><center>".$output[3][$i]."</center></label>
                            </div>
                            
                            <div class='col-lg-3'>
                                <label class='form-control' ><center>".$output[4][$i]."</center></label>
                            </div>
                            
                            <div class='col-lg-1'>
                                <button class='btn btn-warning Edges' data-toggle='collapse' data-target='#$i' >تــفــاصــيــل</button>
                            </div>
                            
                            <div class='col-lg-12'>
                                <div id=$i class='collapse'>
                                    <div class='col-lg-3'>
                                        <label style='margin-right: 3%'>المدينة:</label>
                                        <label class='form-control' ><center>".$output[1][$i]."</center></label>
                                    </div>
                                    <div class='col-lg-3'>
                                        <label style='margin-right: 3%'>الهاتف:</label>
                                        <label class='form-control' ><center>".$output[5][$i]."</center></label>
                                    </div>
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
    <script src="../../js/jquery-1.11.3.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../RTL/js/bootstrap-arabic.min.js"></script>

    </body>

    </html>
<?php require "../../notification/notification_checker.php"; ?>