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
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <style>
        #goods{
            background-color:  #EFEBE9;
        }
    </style>

</head>

<body>
<?php
require $header;
?>

<div id="wrapper">
    <!-- /. NAV TOP  -->
    <?php require "Main_Menu.php"; ?>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner" >
            <div class="container Edges" style="width: 100%; background-color: #FFFFFF;">
                <?php

                echo "
                        <div class='form-group'>
                            <div class='col-md-12'>
                            <br>";
                if($_SESSION['good_feedback'] == "1"){
                    echo "<div class='alert alert-success'>
                                        <strong>تم الإضافة بنجاح</strong>
                                  </div><br>";
                }
                elseif($_SESSION['good_feedback'] == "2"){
                    echo "
                                                  <div class='alert alert-danger'>
                                                        <strong>حدثت مشكلة في إضافة الـبـيـانـات يرجى التأكد من البيانات المدخلة والمحاولة مرةأخرى </strong>
                                                  </div><br>
                                    ";
                }
                elseif ($_SESSION['good_feedback'] == "3"){
                    echo "
                                                  <div class='alert alert-danger'>
                                                        <strong>يـرجـى إدخـال بـيـانـات صـحـيـحـة</strong>
                                                  </div><br>
                                    ";
                }
                elseif ($_SESSION['good_feedback'] == "4"){
                    echo "
                                                  <div class='alert alert-danger'>
                                                        <strong>يـرجـى إدخـال كـمـيـات صـحـيـحـة</strong>
                                                  </div><br>
                                    ";
                }
                echo "</div>
                        </div>";

                unset($_SESSION['good_feedback']);
                ?>
                <div class="form-group">
                    <div class="col-md-12">
                        <h2><center> الــــبــــــضــــــــائـــــع </center></h2><br>
                    </div>
                </div>

                <div class="form-group col-lg-12 Form_Group Edges" >
                    <form action="Goods.php" method="post">
                        <div class="col-lg-3">
                            <input type="text" list="live_search" id="word" class="form-control" name="search_word" placeholder="بــحــــث" onkeyup='state(this.value,"../fetch_goods.php")'>
                            <datalist id="live_search">
                            </datalist>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control" name="sort">
                                <option value="">تــرتــيــب حــســب</option>
                                <option value="1" <?php echo $_SESSION['good_date']; ?>>التاريخ</option>
                                <option value="2" <?php echo $_SESSION['good_q']; ?>>أعلى كــمــيــة</option>
                            </select>
                            <?php unset($_SESSION['good_date']); unset($_SESSION['good_q']); ?>
                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" name="good_type">
                                <option value="">النـــوع</option>
                                <?php for ($i = 0;$i< count($types);$i++){
                                    echo "<option value= $type_ids[$i]"." ".$_SESSION[$type_ids[$i].'']." >$types[$i]</option>";
                                }
                                unset($_SESSION[$type_ids[$i].'']);
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-1">
                            <input type="submit" name="search" class="btn btn-primary Edges" value="بــحــث"/>
                        </div>
                    </form>
                    <div class="col-lg-3">
                        <button class='btn btn-primary Edges' data-toggle='collapse' data-target='#add'>إضـــافـــة</button>
                    </div>
                </div>

                <form action='Goods.php' method='post'>
                    <div class="form-group col-lg-12 Record_Group Edges collapse" id="add" style='padding-bottom: 6px;'>
                        <div class='col-lg-3'>
                            <input class='form-control' name='good' placeholder='الـــبــضــاعـــة'>
                        </div>

                        <div class='col-lg-2'>
                            <input class='form-control' name='quantity' placeholder='الـــكــمــيــة'>
                        </div>

                        <div class='col-lg-2'>
                            <input class='form-control' name='sold_quantity' placeholder='كــمـــيــة المـــبــيــعـــات'>
                        </div>

                        <div class='col-lg-2'>
                            <input class='form-control' name='price' placeholder='سعر السلعة'>
                        </div>

                        <div class='col-lg-2'>
                            <select class='form-control' name='type'>
                                <?php for ($i = 0;$i< count($types);$i++){
                                    echo "<option value= $type_ids[$i] >$types[$i]</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class='col-lg-1'>
                            <input class='btn btn-primary Edges' data-toggle='collapse' data-target='#add_details' value='تفاصيل' style="width: 100%;">
                        </div>

                        <div class='col-lg-12'>
                            <div id="add_details" class='collapse'>
                                <br>
                                <div class='col-lg-5'>
                                    <textarea class='form-control' name="details" style='resize: none; height: 80px' placeholder="مـواصـفـات الـسـلـعـة"></textarea>
                                </div>
                                <div class='col-lg-1'>
                                    <br>
                                    <button class='btn btn-primary Edges' type='submit' name='add_new'>إضـــافـــة</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div>
                    <hr>
                </div>

                <div class="form-group col-lg-12 Record_Group Edges">
                    <div class="col-lg-3">
                        <label class="form-control"><center>الـبـضـاعــة</center></label>
                    </div>

                    <div class="col-lg-1">
                        <label class="form-control">متوفر</label>
                    </div>

                    <div class="col-lg-1">
                        <label class="form-control"><center>المباع</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control"><center>سـعـر السلعة</center></label>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-control"><center>تــاريـــخ الإدخـــال</center></label>

                    </div>
                </div>

                <?php
                if(!$output){
                    echo "لا نـــتـــائـــج";
                }
                else{
                    for($i = count($output[0])-1; $i >= 0 ; $i--){
                        echo "
                <div class='form-group col-sm-12 Record_Group Edges' style='padding-bottom: 6px;'>
                    <div class='col-lg-3'>
                        <label class=\"form-control\" ><center>".$output[0][$i]."</center></label>
                    </div>

                    <div class='col-lg-1'>
                        <label class=\"form-control\" ><center>".$output[1][$i]."</center></label>
                    </div>
                        
                    <div class='col-lg-1'>
                        
                        <input class='form-control' value='".$output[2][$i]."'>
                    </div>

                    <div class='col-sm-2'>
                        <label class='form-control'><center>".$output[8][$i]."</center></label>
                    </div>

                    <div class='col-sm-3'>
                        <label class='form-control'><center>".$output[3][$i]."</center></label>
                    </div>

                    <div class='col-lg-1'>
                        <button class='btn btn-warning Edges' data-toggle='collapse' data-target='#$i'>تفاصيل</button>
                    </div>
                    
                    <div class='col-lg-11'>
                        <div id=$i class='collapse'>
                            <br>
                            <div class='col-lg-5'>
                                <textarea class='form-control' name='details' style='resize: none; height: 80px'>".$output[7][$i]."</textarea>
                            </div>
                            <div class='col-lg-2'>
                                <label>تمت الإضافة من :</label>
                                <label class='form-control'>".$output[5][$i]."</label>
                            </div>
                            
                            <div class='col-lg-2'>
                                <label>نوع السلعة :</label>
                                <label class='form-control'>".$output[6][$i]."</label>
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