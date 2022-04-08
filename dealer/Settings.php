<?php
session_start();
require "../Info/dealer_identification.php";
require "settings_processes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>إعدادات الـحـسـاب</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../RTL/css/bootstrap-arabic.min.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet" />
    <link href="../css/custom.css" rel="stylesheet" />
    <link rel="icon" type="text/png" href="../images/Icon.png" >
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../RTL/js/bootstrap-arabic.min.js"></script>
    <script src="../js/validators.js"> </script>
</head>
<body>
<?php
include_once("../Info/analytics.php");
?>
<header class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div>
            <div class="nav navbar-nav navbar-right">
                <span class="navbar-brand"><img src="../images/Logo.svg" height="100" width="120" style="margin-top: -32%" title="Easy Deals"></span>
            </div>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span><img src="../images/not.svg" height="20" width="20"></a>
                <ul class="dropdown-menu">

                </ul>
            </li>
            <li><a href="index.php"><strong>الـصـفـحـة الـرئـيـسـيـة</strong></a></li>
            <li class="active"><a href="Settings.php"><strong>إعـــدادات</strong></a></li>
            <li><a href="Logout.php"><strong>خــروج</strong></a></li>
        </ul>
    </div>
</header>

<div id="wrapper" style="background-color: #EFEBE9;">
    <div id="page-wrapper" style="margin-left: 10%; min-height:800px;">
        <div id="page-inner" style="min-height:800px;">
            <div class="container" style="width: 100%;">
                <fieldset>
                    <br>
                    <?php
                    if($_SESSION['setting_update'] == "1" || $_SESSION['setting_update'] == "2" || $_SESSION['setting_update'] == "3" || $_SESSION['setting_update'] == "4" || $_SESSION['setting_update'] == "5"){
                        echo "
                                <div class='form-group'>
                                        <div class='col-md-12'>
                                              <div class='alert alert-danger'>";
                        if($_SESSION['setting_update'] == "1"){
                            echo "<strong>لايـمكنك إستخدام هاتف لحساب اخر يرجى التأكد من هاتف 1</strong>";
                        }
                        elseif ($_SESSION['setting_update'] == "2"){
                            echo "<strong>لايـمكنك إستخدام هاتف لحساب اخر يرجى التأكد من هاتف 2</strong>";
                        }
                        elseif($_SESSION['setting_update'] == "3"){
                            echo "<strong>يـرجى إدخال كلمة مرور صحيحة</strong>";
                        }
                        elseif($_SESSION['setting_update'] == "4"){
                            echo "<strong>يـرجى إدخال بـيانـات صـحـيـحـة</strong>";
                        }
                        else{
                            echo "<strong>هـذا الإيـمـيل مـسـتـخدم في حساب اخر</strong>";
                        }
                        echo "</div><br>
                                        </div>
                                </div>
                                ";
                    }
                    elseif($_SESSION['setting_update'] == "0"){
                        echo "
                                <div class='form-group'>
                                        <div class='col-md-12'>
                                              <div class='alert alert-success'>
                                                    <strong>تـم تـحـديـث بـيـانـاتك بنجاح</strong>
                                              </div><br>
                                        </div>
                                </div>";
                    }
                    unset($_SESSION['setting_update']);
                    ?>
                    <form class="form-horizontal" action="Settings.php" method="post">
                        <!-- Form Name -->
                        <h3> إعـدادات الـحـسـاب</h3>
                        <hr>
                        <br>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">الإسـم الأول</label>
                            <div class="col-md-4">
                                <input id="first_name" name="textinput" type="text" class="form-control input-md" value=<?php echo $_SESSION['f_name'];?>>
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="passwordinput">الإسـم الأخير</label>
                            <div class="col-md-4">
                                <input id="last_name" name="last_name" type="text" class="form-control input-md" value=<?php echo $_SESSION['l_name'];?>>

                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="passwordinput">كلمة مرور جديدة</label>
                            <div class="col-md-4">
                                <input id="passwordinput" name="passwordinput" type="password" placeholder="أدخل كلمة مرور لاتقل عن 6 احرف ورمز" class="form-control input-md" onkeyup="password_validator('#passwordinput','#passwordinput')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password_confirm">تأكـيـد كـلمة المرور</label>
                            <div class="col-md-4">
                                <input id="password_confirm" name="password_confirm" type="password" class="form-control input-md" onkeyup="confirmation_validator('#passwordinput','#password_confirm','#password_confirm')">
                            </div>
                        </div>

                        <!-- company description -->


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phone1">رقم الـهـاتـف 1</label>
                            <div class="col-md-4">
                                <input id="phone1" name="phone1" type="text" class="form-control input-md" value="<?php echo $phones[0]; ?>" onkeyup="phone_validator('#phone1','#phone1')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phone2">رقم الـهـاتـف 2</label>
                            <div class="col-md-4">
                                <input id="phone2" name="phone2" type="text" class="form-control input-md" value="<?php echo $phones[1]; ?>" onkeyup="phone_validator('#phone2','#phone2')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">الإيـمـيـل</label>
                            <div class="col-md-4">
                                <input id="email" name="email" type="text" class="form-control input-md" value="<?php echo $_SESSION['email']; ?>" onkeyup="email_validator('#email','#email')">
                            </div>
                        </div>


                        <!-- Select Basic
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="selectbasic">set security question</label>
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Question 1</option>
                                    <option value="2">Question 2</option>
                                    <option value="3">Question 3</option>
                                </select>
                            </div>
                        </div>-->

                        <!-- Multiple Checkboxes
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes">Privacy settings</label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="checkboxes-0">
                                        <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1">
                                        1
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes-1">
                                        <input type="checkbox" name="checkboxes" id="checkboxes-1" value="2">
                                        2
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes-2">
                                        <input type="checkbox" name="checkboxes" id="checkboxes-2" value="3">
                                        3
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes-3">
                                        <input type="checkbox" name="checkboxes" id="checkboxes-3" value="4">
                                        4
                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton"></label>
                            <div class="col-md-4">
                                <button id="singlebutton" name="cancel" type="submit" class="btn btn-danger Edges">إلـغـاء</button>
                                <button id="singlebutton" name="update" type="submit" class="btn btn-success Edges">حـفـظ الـتـغـييـرات</button>
                            </div>
                        </div>

                </fieldset>
                </form>

            </div>
        </div>
    </div>

</div >
<script type="text/javascript">

</script>
</body>
</html>
<?php include "../notification/dealer_notification_checker.php"; ?>