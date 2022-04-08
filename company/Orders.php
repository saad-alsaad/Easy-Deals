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
    <!-- javascript -->
    <script src="../../js/ajax_jquery3.1.0.min.js"></script>
    <script src="../../js/validators.js"></script>
    <script src="../../js/quick_search.js"></script>

    <style>
        #orders{
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

                <?php
                if($_SESSION['order_feedback'] == "2"){
                    echo "
                    <br>
                    <div class='form-group'>
                            <div class='col-md-12'>
                                  <div class='alert alert-danger'>
                                        <strong>يـرجى التأكد من تاريخ نهاية الفاتورة</strong>
                                  </div><br>
                            </div>
                    </div>
                    ";

                }elseif($_SESSION['order_feedback'] == "1"){
                    echo "
                    <br>
                    <div class='form-group'>
                            <div class='col-md-12'>
                                  <div class='alert alert-success'>
                                        <strong>تمت الموافقة</strong>
                                  </div><br>
                            </div>
                    </div>";

                }elseif($_SESSION['order_feedback'] == "3"){
                    echo "
                    <br>
                    <div class='form-group'>
                            <div class='col-md-12'>
                                  <div class='alert alert-danger'>
                                        <strong>لـيـس لـديـك كـمـيـة كـافـيـة لـقـبـول الـطـلـب</strong>
                                  </div><br>
                            </div>
                    </div>";
                }
                unset($_SESSION['order_feedback']);
                ?>
                <div class="form-group">
                    <div class="col-md-12">
                        <h2><center> الــــطـــلــــبـــات </center></h2><br>
                    </div>
                </div>

                <div class="form-group col-lg-12 Form_Group Edges">
                    <form action="Orders.php" method="post">
                        <div class="col-lg-3">
                            <input type="text" list="live_search" name="search_word" id="word" class="form-control" placeholder="بــحــــث" onkeyup='state(this.value,"../fetch_order.php")'>

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
                    </form>
                    <!--
                    <div class="col-lg-3">
                        <button class='btn btn-primary Edges' data-toggle='collapse' data-target='#add'>طــلــب جــديــد</button>
                    </div>-->
                </div>

                <div>
                    <hr>
                </div>

                <div class="form-group col-lg-12 Record_Group Edges">
                    <div class="col-lg-3 ">
                        <label class="form-control" ><center>الــــزبـــون</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control" ><center>الـــحـــالــة</center></label>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-control" ><center>نـــوع الـــدفــــع</center></label>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-control" ><center>التاريخ</center></label>
                    </div>
                </div>

                <?php
                $output1 = array();
                $output1 = $output;
                if(!$output1){
                    echo "لا يـوجـد نــتــائــج";
                }
                else{
                    $z = 'a';
                    $w = 0;
                    for($i = count($output1[0])-1; $i >= 0 ; $i--){

                        echo "
                <div class='form-group col-lg-12 Record_Group Edges' style='padding-bottom: 6px;'>
                    <div class='col-lg-3'>
                        <label class='form-control'>".$output1[2][$i]."</label>
                    </div>


                    <div class='col-lg-2'>
                        <label class='form-control'>".$output1[0][$i]."</label>
                    </div>

                    <div class='col-lg-2'>
                        <label class='form-control'>".$output1[12][$i]."</label>
                    </div>

                    <div class='col-lg-3'>
                        <label class='form-control'><center>".$output1[1][$i]."</center></label>
                    </div>

                    <div class='col-lg-1'>
                        <button class='btn btn-warning Edges btnn' id='details_button' data-toggle='collapse' data-target='#$i'>تفاصيل</button>
                    </div>
                    
                    <div id=$i class='collapse col-lg-12'>
                                ";
                        echo "<br>
                                <div class='form-group col-lg-11'>
                                    <div class='col-lg-3'>
                                        <label style='margin-right: 2%'>السلعة :</label>
                                    </div>
                                    
                                    <div class='col-lg-1'>
                                        <label style='margin-right: 15%'>الكمية :</label>
                                    </div>
                                    
                                    <div class='col-lg-2'>
                                        <label style='margin-right: 15%'>سعر السلعة :</label>
                                    </div>
                                    
                                    <div class='col-lg-2'>
                                        <label style='margin-right: 15%'>السعر × الكمية :</label>
                                    </div>
                                    
                                </div>";

                        $j = 0;
                        for(;$j < count($output1[4][$i]);$j++){
                            $t = $i."".$j;
                            echo "
                                <br>
                                <div class='form-group col-lg-11'>
                                    <div class='col-lg-3'>
                                        <label class='form-control'>".$output1[4][$i][$j]."</label>
                                    </div>
                                    
                                    <div class='col-lg-1'>
                                        <label class='form-control'>".$output1[3][$i][$j]."</label>
                                    </div>
                                    
                                    <div class='col-lg-2'>
                                        <label class='form-control'>".$output1[18][$i][$j]."</label>
                                    </div>
                                    
                                    <div class='col-lg-2'>
                                        <label class='form-control'>".$output1[8][$i][$j]."</label>
                                    </div>
                                    
                                    <div class='col-lg-2'>
                                        <button class='btn btn-warning Edges ' data-toggle='collapse' data-target='#$t' >تفاصيل السلعة</button>
                                    ";
                            echo "</div>";
                            $flagg = 0;
                            if($output1[14][$i][$j]){
                                echo "
                                             <div class='alert alert-danger col-lg-2'>
                                                <center><strong>ليس لديك كمية كافية</strong></center>
                                             </div>
                                            ";
                            }else{$flagg = 1;
                            }
                            echo "<div class='col-lg-12'>
                                            <div id=
                                    $t class='collapse'>";
                            if($flagg){
                                echo "<br>";
                                $flagg = 0;
                            }
                            echo "
                                                <div class='col-lg-6'>
                                                    <textarea class='form-control' style='resize: none; height: 80px'>".$output1[7][$i][$j]."</textarea>
                                                </div>
                                            </div>
                                        </div>
                                </div>";
                        }
                        /*
                            $t = $i."".$j;
                            echo "
                        <br>
                        <div class='form-group col-lg-11'>
                            <div class='col-lg-3'>
                                <label class='form-control'>".$output1[4][$i][$j]."</label>
                            </div>

                            <div class='col-lg-1'>
                                <label class='form-control'>".$output1[3][$i][$j]."</label>
                            </div>

                            <div class='col-lg-2'>
                                <label class='form-control'>".$output1[18][$i][$j]."</label>
                            </div>

                            <div class='col-lg-2'>
                                <label class='form-control'>".$output1[8][$i][$j]."</label>
                            </div>

                            <div class='col-lg-2'>
                                <button class='btn btn-warning Edges ' data-toggle='collapse' data-target='#$t' >تفاصيل السلعة</button>
                            ";
                            echo "</div>";
                            $flagg = 0;
                            if($output1[14][$i][$j]){
                                echo "
                                     <div class='alert alert-danger col-lg-2'>
                                        <center><strong>ليس لديك كمية كافية</strong></center>
                                     </div>
                                    ";
                            }else{$flagg = 1;}
                            echo "<div class='col-lg-12'>
                                    <div id=$t class='collapse'>";
                            if($flagg){
                                echo "<br>";
                                $flagg = 0;
                            }
                            echo "
                                        <div class='col-lg-6'>
                                            <textarea class='form-control' style='resize: none; height: 80px'>".$output1[7][$i][$j]."</textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>"; */


                        $z = $i."y".$w;
                        if($output1[0][$i] == "لـم يـتـم الـرد"){
                            echo "
                                    <div class='form-group col-lg-11'>
                                        <div class='col-lg-6' style='margin-right: 65%'>
                                             <div class='col-lg-3' >
                                             <br>
                                             <label style='margin-right: 10%'>السعر الإجمالي:</label>
                                                    <label class='form-control'>".$output1[11][$i]."</label>
                                             </div>
                                             <div class='col-lg-9'>
                                                <div class='col-lg-1' style='margin-right: 16%'>
                                                    <br><br>
                                                    <button class='btn btn-primary Edges' data-toggle='modal' data-target='#$z'>قــبــول</button>
                                                </div>                       
                                
                                            <!-- approve from modal -->
                                            <form action='Orders.php' method='post'>
                                        <div class='modal fade' id=$z role='dialog'>
                                                <div class='modal-dialog'>
                                                
                                                  <!-- Modal content-->
                                                  <div class='modal-content'>
                                                    
                                                    <div class='modal-header'>
                                                      <h4 class='modal-title'>تـأكـيـد قـبـول الـطـلـب</h4>
                                                    </div>
                                                   
                                                    <div class='modal-body'>
                                                      <p>يـرجـى إدخـال تـاريـخ نـهـايـة الـفـاتـورة لهذا الطلب</p>
                                                      <input name='m_date' class='form-control' placeholder=' تـاريـخ نـهـايـة الـفـاتـورة مثال: 26-02-2017'>
                                                    </div>
                                                    
                                                    <div class='modal-footer'>
                                                     
                                                     <input name='id' hidden value='$i'>
                                                      <button type='submit' name='accept' class='btn btn-success Edges'>تـأكـيـد</button>
                                                     
                                                    </div>
                                                  </div>
                                                </div>
                                        </div>
                                    </form>
                                    
                                       
                                            <form action='Orders.php' method='post'>
                                                <input name='id' hidden value='$i'/>
                                                <div class='col-lg-1' style='margin-right: 15%'>
                                                    <br><br>
                                                    <button type='submit' name='deny' class='btn btn-danger Edges'>رفــض</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                     </div>
                                        
                                        ";
                        }
                        elseif ($output1[0][$i] == "تـمت الـمـوافـقـة"){
                            echo "
                                    <div class='form-group col-lg-11'>
                                        <div class='col-lg-6' style='margin-right: 65%'>
                                         
                                         <div class='col-lg-3' >
                                         <label >السعر الإجمالي :</label>
                                                <label class='form-control'>".$output1[11][$i]."</label>
                                         </div>
                                            <div class='col-lg-4' style='margin-right: 30%'>
                                            <br>
                                                <label style='color: #2b542c;'>تمت الموافقة</label>
                                            </div>
                                           
                                        </div>
                                    </div>
                                        ";
                        }
                        elseif ($output1[0][$i] == "تـم الـرفـض"){
                            echo "
                                    <div class='form-group col-lg-11'>
                                        <div class='col-lg-6' style='margin-right: 65%'>
                                         <div class='col-lg-3' >
                                         <label >السعر الإجمالي :</label>
                                                <label class='form-control'>".$output1[11][$i]."</label>
                                         </div>
                                            <div class='col-lg-4' style='margin-right: 30%'>
                                            <br>
                                                <label style='color: #ac2925;'>تـم الـرفـض</label>
                                            </div>
                                        </div>
                                    </div>
                                        ";
                        }

                        echo "
                        </div>
                    </div>
                ";

                    }} ?>
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