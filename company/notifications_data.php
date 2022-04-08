<!-- this file only for financial and goods managers -->
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
            #notifications{
                background-color:  #EFEBE9;
            }

        </style>
    </head>

    <body>
    <?php include "header.php"; ?>
    <div id="wrapper">
        <?php include "Main_Menu.php"; ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="container" style="width: 100%;"><br>
                    <?php
                    if($_SESSION['not_flag'] == "3"){
                        echo "
                        <div class='form-group'>
                            <div class='col-md-12'>
                                <div class='alert alert-success'>
                                    <strong> تـم الإرسـال بـنـجاح </strong>
                                </div><br>
                            </div>
                        </div>
                    ";
                    }
                    elseif($_SESSION['not_flag'] == "2"){
                        echo "
                        <div class='form-group'>
                            <div class='col-md-12'>
                                <div class='alert alert-danger'>
                                 <strong> حـدث خـطأ بالإرسـال </strong>
                                 </div><br>
                            </div>
                        </div>
                    ";
                    }
                    elseif($_SESSION['not_flag'] == "1") {
                        echo "
                        <div class='form-group'>
                            <div class='col-md-12'>
                                <div class='alert alert-danger'>
                                <strong> يـرجـى إخـتـيـار مـسـتـقـبل الرسـالة </strong>
                                </div><br>
                            </div>
                        </div>
                    ";
                    }
                    unset($_SESSION['not_flag']);
                    ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <h2><center> الإشـــعــارات </center></h2><br>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 Form_Group Edges">
                        <form action="Notifications.php" method="post">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" list="live_search" id="word" name="search_word" placeholder="بــحــــث. من:" onkeyup='state(this.value,"../fetch_notifications.php")'>

                                <datalist id="live_search">
                                </datalist>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-control" name="sort">
                                    <option value="">تــرتــيــب حــســب</option>
                                    <option value="" selected>التاريخ</option>

                                </select>
                            </div>

                            <div class="col-lg-2">
                                <select class="form-control" name="type">
                                    <option value="">النـــوع</option>
                                    <option value="1" <?php echo $_SESSION['type_1']; ?> >طـــلــب</option>
                                    <option value="3" <?php echo $_SESSION['type_3']; ?> >تــذكــيــر</option>
                                    <option value="0" <?php echo $_SESSION['type_0']; ?> >رســائــل</option>
                                </select>
                                <?php unset($_SESSION['type_1']); unset($_SESSION['type_3']); unset($_SESSION['type_0']); ?>
                            </div>

                            <div class="col-lg-1">
                                <input type="submit" name="search" class="btn btn-primary Edges" value="بــحــث"/>
                            </div>
                        </form>
                        <div class="col-lg-3">
                            <button class='btn btn-primary Edges' data-toggle='collapse' data-target='#add'>رســالــة جــديــدة</button>
                        </div>
                    </div>


                    <form action="Notifications.php" method="post">
                        <div id="add" class='form-group col-sm-12 Record_Group Edges collapse' style='padding-bottom: 6px;'>
                            <div class='col-lg-5'>
                                <textarea class='form-control' name="message" style="resize: none; height: 150px" placeholder="أكـتـب رسـالـتك"></textarea>
                            </div>

                            <div class='col-lg-2'>
                                <select name="manager" class="form-control">
                                    <?php
                                    echo "<option value='' selected>إلـى مـديـر</option>";
                                    for ($i = 0; $i < count($top_managers[0]);$i++){
                                        echo "<option value=".$top_managers[0][$i].">".$top_managers[1][$i]."</option>";
                                    }
                                    ?>
                                </select>
                                <br>
                                <br>
                                <center><input class='btn btn-primary Edges' type='submit' name='send' value='إرســـال' /></center>
                            </div>
                        </div>
                    </form>

                    <div class="form-group col-lg-12 Record_Group Edges">
                        <div class="col-lg-4">
                            <label class="form-control"><center>الــرســالــة</center></label>
                        </div>

                        <div class="col-lg-2">
                            <label class="form-control"><center>الـــمــرســل</center></label>
                        </div>

                        <div class="col-lg-3">
                            <label class="form-control"><center>الـــتــاريــخ والــوقــت</center></label>
                        </div>
                    </div>
                    <?php
                    if(!$output){
                        echo "لا يــوجــد إشــعــارات";
                    }
                    else{
                        for($i = count($output[0])-1; $i >= 0 ; $i--){
                            echo "
                        <div class='form-group col-sm-12 Record_Group Edges' style='padding-bottom: 6px;'>
                            <div class='col-lg-4'>";
                            echo '<input class="form-control" value="'.$output[1][$i].'">';
                            echo "</div>";
                            if($output[3][$i] == '3'){
                                echo "
                                <div class='col-lg-2'>
                                <label class='form-control' ><center>رسـالـة تـذكـيـر</center></label>
                            </div>";
                            }elseif($output[3][$i] == '2'){
                                echo "
                                <div class='col-lg-2'>
                                <label class='form-control' ><center>فـاتـورة جـديـدة</center></label>
                            </div>";
                            }else{
                                echo "
                                <div class='col-lg-2'>
                                <label class='form-control' ><center>".$output[2][$i]."</center></label>
                            </div>";
                            }
                            echo "
                            <div class='col-lg-3'>
                                <label class='form-control' ><center>".$output[0][$i]."</center></label>
                            </div>";

                            if($output[3][$i] == '0' || $output[3][$i] == '3'  || $output[3][$i] == '2'){
                                echo "
                            <div class='col-lg-1'>
                                <button class='btn btn-warning Edges' data-toggle='collapse' data-target='#$i' >تــفــاصــيــل</button>
                            </div>

                            <div class='col-lg-12'>
                                <div id=$i class='collapse'>
                                    <div class='col-lg-12'>
                                        <textarea class='form-control' style='resize: none; height: 100px'>".$output[1][$i]."</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>";}
                            elseif ($output[3][$i] == '1'){
                                echo "<div class='col-lg-1'>
                                <a class='btn btn-warning Edges' href='Orders.php'>ذهاب إلى الطلبات</a>
                            </div>
                        </div>";
                            }
                            else{
                                echo "
                            <div class='col-lg-1'>
                                <button class='btn btn-warning Edges' data-toggle='collapse' data-target='#$i' >تــفــاصــيــل</button>
                            </div>

                            <div class='col-lg-12'>
                                <div id=$i class='collapse'>
                                    <div class='col-lg-12'>
                                        <textarea class='form-control' style='resize: none; height: 100px'>".$output[1][$i]."</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>";
                            }
                        }} ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/jquery-1.11.3.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../RTL/js/bootstrap-arabic.min.js"></script>
    </body>
    </html>
<?php require "../../notification/notification_checker.php"; ?>