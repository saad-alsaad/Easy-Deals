<?php
session_start();
require "../../Info/user_identification.php";
require "manager_processes.php";
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
    <script src="../../js/validators.js"> </script>
    <script src="../../js/quick_search.js"></script>

    <style>
        #managers{
            background-color:  #F3F3F3;
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

                <?php
                // exist username
                if($_SESSION['username_flag'] === "1"){
                    echo "
                    <br>
                    <div class='form-group'>
                            <div class='col-md-12'>
                                  <div class='alert alert-danger'>
                                        <strong>إسـم المستخدم غير متاح , يرجى إختيار اسم مستخدم اخر</strong>
                                  </div><br>
                            </div>
                    </div>
                    ";
                }
                // incorrect data
                elseif($_SESSION['username_flag'] === "2"){
                    echo "
                    <br>
                    <div class='form-group'>
                            <div class='col-md-12'>
                                  <div class='alert alert-danger'>
                                        <strong>يرجى إدخال بيانات صحيحة</strong>
                                  </div><br>
                            </div>
                    </div>";
                }
                //done
                elseif ($_SESSION['username_flag'] === "3"){
                    echo "
                    <br>
                    <div class='form-group'>
                            <div class='col-md-12'>
                                  <div class='alert alert-success'>
                                        <strong>تـمـت الـعـمـلـيـة بـنـجـاح</strong>
                                  </div><br>
                            </div>
                    </div>";

                }
                unset($_SESSION['username_flag']);
                ?>

                <div class="form-group">
                    <div class="col-md-12">
                        <h2><center> الـــــمــــدراء </center></h2><br>
                    </div>
                </div>

                <div class="form-group col-lg-12 Form_Group Edges">
                    <form action="Managers.php" method="post">
                        <div class="col-lg-3">
                            <input name="search" list="live_search" id="word" type="text" class="form-control" placeholder="بــحــــث" onkeyup='state(this.value,"fetch_managers.php")'>

                            <datalist id="live_search">
                            </datalist>

                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" name="type">
                                <option value='' <?php echo $_SESSION['type_0']; ?> >جميع المدراء</option>
                                <option value='1' <?php echo $_SESSION['type_1']; ?> >مـديـر مـالـي</option>
                                <option value='2' <?php echo $_SESSION['type_2']; ?> >مـديـر بـضـائـع</option>
                            </select>
                            <?php unset($_SESSION['type_2']); unset($_SESSION['type_1']); unset($_SESSION['type_0']); ?>
                        </div>

                        <div class="col-lg-1">
                            <input type="submit" name="sub" class="btn btn-primary Edges" value="بــحــث"/>
                        </div>
                    </form>
                        <div class="col-lg-3">
                            <button class='btn btn-primary Edges' data-toggle='collapse' data-target='#add'>إضـــافـــة</button>
                        </div>
                </div>
                <form action="Managers.php" method="post" >
                    <div class="form-group col-lg-12 Record_Group Edges collapse" style='padding-bottom: 6px;' id="add">
                        <div class="col-lg-3">
                            <input class="form-control" type="text" name="username" id="username" placeholder="إســم الــمــســتــخــدم" onkeyup="username_validator('#username','#username')">
                        </div>

                        <div class="col-lg-3">
                            <input class="form-control"  type="text" name="first_name" id="fname" placeholder="الإســم الأول" onkeyup="name_validator('#fname','#fname')">
                        </div>

                        <div class="col-lg-3">
                            <input class="form-control"  type="text" name="last_name" id="lname" placeholder="الإســم الأخــيــر" onkeyup="name_validator('#lname','#lname')">
                        </div>
                        <div class="col-lg-3">
                            <input class="form-control"  type="text" name="phone" id="phone" placeholder="رقـم الـجـوال" onkeyup="phone_validator('#phone','#phone')">
                        </div>
                        <br><br>
                        <div class="col-lg-3">
                            <input class="form-control"  type="text" name="address" id="address" placeholder="الـعـنـوان" onkeyup="address_validator('#address','#address')">
                        </div>

                        <div class="col-lg-3">
                            <input class="form-control"  type="text" name="email" id="email" placeholder="الإيـمـيل" onkeyup="email_validator('#email','#email')">
                        </div>

                        <div class="col-lg-3">
                            <select class="form-control" name="city_name">
                                <?php
                                if(!$cities){
                                    echo "<option value=''>لا يــوجــد مـدن</option>";
                                }
                                else{
                                    for($i = 0; $i < count($cities[0]);$i++){
                                        echo "<option value= ".$cities[0][$i].">".$cities[1][$i]."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" name="type">
                                <option value='1'>مــدير مالي</option>
                                <option value='2'>مديــر بـضـائـع</option>
                            </select>
                        </div>

                        <div class='col-lg-1'>
                            <input class='btn btn-primary Edges' type='submit' name='add_new' value='إضـــافـــة'/>
                        </div>

                    </div>
                </form>

                <div class="form-group col-lg-12 Record_Group Edges">
                    <div class="col-lg-2">
                        <label class="form-control"><center>إســم الــمــســتــخــدم</center></label>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-control"><center>الإســم كـامـلا</center></label>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-control"><center>الـبـريـد الإلـكـتـرونـي</center></label>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-control"><center>الـعـنـوان</center></label>

                    </div>
                </div>

                <?php
                if(!$output){
                    echo "لا يــوجــد مــدراء";
                }
                else{
                    for($i = 0; $i < count($output[0]);$i++){
                        echo "
                        <div class='form-group col-sm-12 Record_Group Edges' style='padding-bottom: 6px;'>
                            <div class='col-lg-2'>
                                <label class='form-control' style='resize: none; height: 35px;'>".$output[0][$i]."</label>
                            </div>

                            <div class='col-lg-3'>
                                <label class='form-control' ><center>".$output[1][$i]."</center></label>
                            </div>

                            <div class='col-lg-3'>
                                <label class='form-control' ><center>".$output[2][$i]."</center></label>
                            </div>
                            
                            <div class='col-lg-3'>
                                <label class='form-control' ><center>".$output[3][$i]."</center></label>
                            </div>
                            
                            <div class='col-lg-1'>
                                <button class='btn btn-warning Edges' data-toggle='collapse' data-target='#$i' >تـفـاصـيـل</button>
                            </div>

                            <div class='col-lg-12'>
                                <div id=$i class='collapse' >
                                    <div class='col-lg-2'>
                                        <label style='margin-right: 3%'>الـمـدينـة:</label>
                                        <label class='form-control' ><center>".$output[4][$i]."</center></label>
                                    </div class='col-lg-2'>
                                    
                                     <div class='col-lg-3'>
                                        <label style='margin-right: 3%'>مـديـر:</label>
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