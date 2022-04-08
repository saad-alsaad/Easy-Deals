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
    <script src="../../js/quick_search.js"></script>

    <style>
        #bills{
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
                        <h2><center> الــــفــــواتــــيـــر </center></h2><br>
                    </div>
                </div>
                <form action="Bills.php" method="post">
                    <div class="form-group col-lg-12 Form_Group Edges">
                        <div class="col-lg-3">
                            <input type="text" class="form-control" list="live_search" name="search_word" id="word" placeholder="بــحــــث" onkeyup='state(this.value,"../fetch_bills.php")'>

                            <datalist id="live_search">
                            </datalist>

                        </div>
                        <div class="col-lg-2">
                            <select class="form-control" name="sort">
                                <option value="" <?php echo $_SESSION['sort_0']; ?> >تــرتــيــب حــســب</option>
                                <option value="1" <?php echo $_SESSION['sort_1']; ?> >تاريخ الإصدار</option>
                                <option value="2" <?php echo $_SESSION['sort_2']; ?> >تاريخ الإنتهاء</option>
                                <option value="3" <?php echo $_SESSION['sort_3']; ?> >الاعلى قـــيـــمـــة</option>
                                <option value="4" <?php echo $_SESSION['sort_4']; ?> >الأقـــل قـــيـــمـــة</option>
                            </select>
                            <?php unset($_SESSION['sort_0']); unset($_SESSION['sort_1']); unset($_SESSION['sort_2']); unset($_SESSION['sort_3']); unset($_SESSION['sort_4']); ?>
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
                            <input type="submit" name="search" class="btn btn-primary Edges" value="بــحــث"/>
                        </div>
                    </div>
                </form>
                <div>
                    <hr>
                </div>

                <?php
                if(!$output){
                    echo "لا نـتـائـج";
                }
                else{
                    for($i = count($output[0])-1; $i >= 0; $i--){
                        echo "
                <div class='form-group col-md-12 Record_Group Edges' style='padding-bottom: 6px;'>
                    
                    <div class='col-md-3'>
                        <label class='form-control'  style='background-color: #EFEBE9; border-color: #EFEBE9; '>تاريخ الإصدار:</label>
                    </div>
                    
                    <div class='col-lg-3'>
                        <label class='form-control'>".$output[1][$i]."</label>
                    </div>
                    
                    <div class='col-lg-3'>
                        <label class='form-control'  style='background-color: #EFEBE9; border-color: #EFEBE9; '>الـعـنـوان:</label>
                    </div>
                    
                    <div class='col-lg-3'>
                        <label class='form-control'>".$output[8][$i]."</label>
                    </div>
                    
                    <div class='col-lg-3'>
                        <label class='form-control'  style='background-color: #EFEBE9; border-color: #EFEBE9; '>مطلوب من السيد:</label>
                    </div>
                    
                    <div class='col-lg-3'>
                        <label class='form-control'>".$output[0][$i]."</label>
                    </div>

                    <div class='col-lg-3'>
                        <label class='form-control'  style='background-color: #EFEBE9; border-color: #EFEBE9; '>رقم الفاتورة:</label>
                    </div>
                    
                    <div class='col-lg-2'>
                        <label class='form-control'>".$output[7][$i]."</label>
                    </div>


                    <div class='col-sm-1'>
                        <button class='btn btn-warning Edges' data-toggle='collapse' data-target='#$i'>تفاصيل</button>
                    </div>
                    
                    <div id=$i class='collapse col-lg-12'>
                                <br>";

                        echo "
                        <div class='form-group col-lg-11'>
                         <div class='col-lg-2'>
                                    <label><center>الـمـبـلـغ</center></label>
                         </div>
                                
                         <div class='col-lg-4'>
                                    <label><center>تـفـاصـيـل</center></label>
                         </div>
                             
                         <div class='col-lg-2'>
                                    <label><center>عــدد</center></label>
                         </div>
           
                         <div class='col-lg-2'>
                                    <label ><center>سـعـر</center></label>
                         </div>
                         </div>
                        ";
                        for($k = 0; $k < count($output[10][$i]);$k++){
                            echo "
                        <div class='form-group col-lg-11'>
                             <div class='col-lg-2'>
                                    <label class='form-control'>".$output[9][$i][$k]."</label>
                             </div>
                                
                             <div class='col-lg-4'>
                                    <label class='form-control'>".$output[10][$i][$k]."</label>
                             </div>
                             
                             <div class='col-lg-2'>
                                    <label class='form-control'>".$output[11][$i][$k]."</label>
                             </div>
                             
                             <div class='col-lg-2'>
                                    <label class='form-control'>".$output[12][$i][$k]."</label>
                             </div>
                        </div>
                            ";
                        }
                        echo "
                        
                        <div class='form-group col-lg-11'>
                            <hr style='border-color: #0b0b0b;'>
                             <div class='col-lg-2'>
                                    <label class='form-control'><center>".$output[13][$i]."</center></label>
                                    <center><label>ض . ق . م</label></center>
                             </div>
                             
                             <div class='col-lg-4'>
                                    <label class='form-control'><center>".$output[4][$i]."</center></label>
                                    <center><label>مجموع المبلغ</label></center>
                             </div>
                                
                             <div class='col-lg-4'>
                                    <label class='form-control'><center>".$output[6][$i]."</center></label>
                                    <center><label>المبلغ المدفوع</label></center>
                             </div>
                             
                             <div class='col-lg-2'>
                                    <label class='form-control'><center>".$output[2][$i]."</center></label>
                                    <center><label>تاريخ نهاية الفاتورة</label></center>
                             </div>
                        </div>
                            ";
                        echo "</div>
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