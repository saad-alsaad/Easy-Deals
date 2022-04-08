<?php
session_start();
require "../Info/dealer_identification.php";
?>
    <!DOCTYPE html>
    <html>
    <?php require "cart_pro.php" ?>
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

        <script src="../js/ajax_jquery3.1.0.min.js"></script>

        <style>
            #cart{
                background-color:  #EFEBE9;
            }
        </style>

    </head>

    <body>
    <?php require "header.php"; ?>

    <div id="wrapper">
        <!-- /. NAV TOP  -->
        <?php require "Main_Menu.php"; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner" >
                <div class="container" style="width: 100%;">
                    <br>
                    <?php
                        echo "
                        <div class='form-group'>
                            <div class='col-md-12'>";
                            if($_SESSION['cart_feedback'] == "1"){
                                echo "
                                <div class='alert alert-success'>
                                        <strong>تــم إرسـال الـطـلـب بـنـجـاح</strong>
                                </div>";
                            }elseif ($_SESSION['cart_feedback'] == "2"){
                                echo "
                                <div class='alert alert-danger'>
                                        <strong>لايمكنك ارسال طلب لاكتر من شركة</strong>
                                </div>";
                            }elseif ($_SESSION['cart_feedback'] == "3"){
                                echo "
                                <div class='alert alert-danger'>
                                        <strong>يـرجى إدخـال الـكـمـيات المطلوبة لكل سلعة</strong>
                                </div>";
                            }
                            elseif ($_SESSION['cart_feedback'] == "5"){
                                echo "
                                <div class='alert alert-danger'>
                                        <strong>يرجى تحديد نوع الدفع</strong>
                                </div>";
                            }
                            elseif ($_SESSION['cart_feedback'] == "6"){
                                echo "
                                <div class='alert alert-danger'>
                                        <strong>يرجى تحديد الكميات بشكل صحيح</strong>
                                </div>";
                            }
                            echo "</div>
                        </div>
                    ";
                        unset($_SESSION['cart_feedback']);
                    ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <h2><center> سلة المشتريات </center></h2><br>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 Form_Group Edges" >
                        <form action="cart.php" method="post">
                            <div class="col-lg-1">
                                <input type="submit" name="ord" class="btn btn-primary Edges" value=" طلب"/>
                            </div>
                            <div class='col-lg-1'>
                                <button class='btn btn-primary Edges' name='remove' >إفراغ السلة</button>
                            </div>
                    </div>

                    <div>
                        <hr>
                    </div>

                    <div class="form-group col-lg-12 Record_Group Edges">
                        <div class="col-lg-3">
                            <label class="form-control"><center>الـسـلـعـة</center></label>
                        </div>

                        <div class="col-lg-2">
                            <label class="form-control"><center>السعر</center></label>
                        </div>

                        <div class="col-lg-2">
                            <label class="form-control"><center>الكمية المطلوبة</center></label>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-control"><center>الـشـركـة</center></label>
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
                    </div>

                    <?php
                        for($i=0;$i<$_SESSION['c']; $i++){
                            // check if the row not empty
                            if($_SESSION['gid'][$i] != ""){
                            echo "
                <div class='form-group col-sm-12 Record_Group Edges' style='padding-bottom: 6px;'>
               
                    <div class='col-lg-3'>
                        <label class=\"form-control\" ><center>".$_SESSION['gud'][$i] ."</center></label>
                    </div>

                    <div class='col-lg-2'>
                        <label class=\"form-control\" ><center>".$_SESSION['price'][$i] ."</center></label>
                    </div>
                        
                    <div class='col-lg-2'>
                       
                     <input class='form-control' value='1' name=".$i." > 
                    </div>  
                    
                    <div class='col-lg-3'>
                        <label class=\"form-control\" ><center>".$_SESSION['company'][$i]."</center></label>
                    </div>
                    
                    <div class='col-lg-1'>
                            <button class='btn btn-primary Edges' name=remove".$i." >الغاء السلعة</button>
                        </div>
                    
                </div>";
                }}
                echo "</form>";
                ?>
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