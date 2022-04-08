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

    <link rel="icon" type="text/png" href="../../images/Icon.png" >
    <!-- javascript -->
    <script src="../../js/ajax_jquery3.1.0.min.js"></script>

    <script src="../../js/validators.js"></script>
    <script src="../../js/quick_search.js"></script>

    <style>
        #payments{
            background-color:  #EFEBE9;
        }
    </style>
</head>

<body>
<?php include $header; ?>

<div id="wrapper">
    <!-- /. NAV TOP  -->
    <?php include "Main_Menu.php"; ?>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="container" style="width: 100%;">
                <div class="form-group">
                    <div class="col-md-12">
                        <h2><center> الـــدفــــعـــات </center></h2><br>
                    </div>
                </div>
                <form action="Payments.php" method="post">
                    <div class="form-group col-lg-12 Form_Group Edges">
                        <div class="col-lg-3">
                            <input type="text" name="word" list="live_search" id="word" class="form-control" placeholder="بــحــــث" onkeyup='state(this.value,"../fetch_payments.php")'>

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
                    </div>
                </form>

                <div>
                    <hr>
                </div>


                <div class="form-group col-lg-12 Record_Group Edges">
                    <div class="col-lg-3">
                        <label class="form-control"><center>الــــزبـــون</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control"><center>قــــيمة الــــدفــــع</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control"><center>نـوع الـدفـع</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control"><center>رقم الـــفاتــورة</center></label>

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
                    <div class='col-lg-3'>
                        <label class=\"form-control\" ><center>".$output[1][$i]."</center></label>
                    </div>
                    
                    <div class='col-lg-2'>
                        <label class='form-control'><center>".$output[2][$i]."</center></label>
                    </div>

                    <div class=\"col-lg-2\">
                        <label class=\"form-control\"><center>".$output[4][$i]."</center></label>
                    </div>

                    <div class='col-lg-2'>
                        <label class='form-control'><center>".$output[0][$i]."</center><label>
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
                                          <a href=../".$output[5][$i].">
                                            <img class=\"media-object\" src=../".$output[5][$i]." alt=\"...\" width='250' height='250'>
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
<script src="../../js/jquery-1.11.3.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="../../RTL/js/bootstrap-arabic.min.js"></script>

</body>
</html>
<?php require "../../notification/notification_checker.php"; ?>