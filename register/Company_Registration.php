<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#00A105" />
    <title>Easy Deals | إنشاء حساب شركة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../RTL/css/bootstrap-arabic.min.css" rel="stylesheet">
    <link href="../css/registration.css" rel="stylesheet">
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/validators.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="icon" type="text/png" href="../images/Icon.png" >
</head>

<?php
session_start();
$city = array();
include "../db.php";
include_once("../Info/analytics.php");
include_once ("../Info/Checking.php");
include_once ("../Info/Check_ip.php");
//if(checkProxy($ip)){
 //   header("Location: ../Block.php");
 //   exit();
//}
$city_query = "SELECT * FROM city";
$city_result = mysqli_query($conn, $city_query);
for ($i = 0;$city_row = mysqli_fetch_assoc($city_result);$i++){
    $city[0][$i] = $city_row['city_id'];
    $city[1][$i] = $city_row['name'];
}

$flag = 0;
$check = "";
$captch = 0;
if (isset($_POST['reg'])){
    require "../Info/captcha.php";
    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        $captch =  1;
    }
    else{
        if(preg_match('/^[A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z]{3,20}$/',$_POST['reg_firstname'])){
            if(preg_match('/^[A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z]{3,20}$/',$_POST['reg_lastname'])){
                if(preg_match('/^[0-9A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z]{3,20}$/',$_POST['username'])){
                    if(preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*()_=+|])[a-zأ-يA-Z0-9!@#$%^&()_=+|*]{6,20}$/',$_POST['reg_password'])){
                        if($_POST['reg_password'] == $_POST['reg_password_confirm']){
                           if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['Email'])){
                               if(preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/',$_POST['reg_no'])){
                                   if($_POST['reg_no1'] == "" || preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/',$_POST['reg_no1'])){
                                       if(preg_match('/^[ )(0-9A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z]{3,50}$/',$_POST['reg_cname'])){
                                           if($_POST['city'] != ""){
                                               if(preg_match('/^[0-9A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z- ]{3,20}$/',$_POST['reg_address'])) {
                                                   if (preg_match('/^[0-9A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z- ]{3,50}$/', $_POST['reg_c_address'])) {
                                                       if ($_POST['reg_desc'] != "") {
                                                           if ($_POST['reg_agree']) {
                                                               $flag = 1;
                                                               $query = "SELECT Username FROM users WHERE Username = '$_POST[username]' OR Email = '$_POST[Email]'";
                                                               mysqli_query($conn, $query) or die('Error querying database.');
                                                               $result = mysqli_query($conn, $query);
                                                               $row = mysqli_fetch_assoc($result);
                                                               $company_name = mysqli_real_escape_string($conn, $_POST['reg_cname']);

                                                               $query2 = "SELECT company_id FROM company WHERE name LIKE '%$company_name%'";
                                                               mysqli_query($conn, $query2) or die('Error querying database.');
                                                               $result2 = mysqli_query($conn, $query2);
                                                               $row2 = mysqli_fetch_assoc($result2);

                                                               $query5 = "SELECT user_id FROM user_phone WHERE phone = '$_POST[reg_no]'";
                                                               mysqli_query($conn, $query5) or die('Error querying database.');
                                                               $result5 = mysqli_query($conn, $query5);
                                                               $row5 = mysqli_fetch_assoc($result5);

                                                               if ($row) {
                                                                   if ($row['Username'] == $_POST['username']) {
                                                                       $check = "إسـم الـمـسـتـخدم غير متاح .. يرجى إختيار إسم اخر";
                                                                   } else {
                                                                       $check = "لا يمكنك إستخدام هذا الايميل";
                                                                   }
                                                               }
                                                               elseif ($row2) {
                                                                   $check = "لا يمكن إنشاء أكثر من حساب لنفس الشركة";
                                                               }
                                                               elseif ($row5){
                                                                   $check = "لا يمكن استخدام نفس الرقم لاكثر من حساب";
                                                               }
                                                               else {
                                                                   $password = password_hash($_POST['reg_password'],PASSWORD_DEFAULT);
                                                                   $ins_query1 = "INSERT INTO users (Username, First_name, Last_name, Email, User_type, Address, Password, city_id, registration_date, last_login) VALUES ('$_POST[username]','$_POST[reg_firstname]','$_POST[reg_lastname]','$_POST[Email]',0,'$_POST[reg_address]','$password','$_POST[city]',NOW(),NOW())";
                                                                   if(mysqli_query($conn, $ins_query1)){
                                                                       $query3 = "SELECT ID FROM users WHERE Username = '$_POST[username]'";
                                                                       mysqli_query($conn, $query3) or die("error in database query");
                                                                       $result3 = mysqli_query($conn, $query3);
                                                                       $row3 = mysqli_fetch_assoc($result3);

                                                                       // add the company
                                                                       $ins_query2 = "INSERT INTO company (name, address, city_id, telephone, email, description) VALUES ('$_POST[reg_cname]','$_POST[reg_c_address]','$_POST[city]','$_POST[reg_no]','$_POST[Email]','$_POST[reg_desc]')";
                                                                       if(mysqli_query($conn, $ins_query2)){
                                                                           $query4 = "SELECT company_id FROM company WHERE name = '$_POST[reg_cname]'";
                                                                           mysqli_query($conn, $query4) or die("error in database query");
                                                                           $result4 = mysqli_query($conn, $query4);
                                                                           $row4 = mysqli_fetch_assoc($result4);

                                                                           // add the user to top_manager table
                                                                           $ins_query3 = "INSERT INTO top_manager (user_id, company_id) VALUES ('$row3[ID]','$row4[company_id]')";
                                                                           mysqli_query($conn, $ins_query3);

                                                                           //phone
                                                                           $ins_query4 = "INSERT INTO user_phone (phone, user_id) VALUES ('$_POST[reg_no]','$row3[ID]')";
                                                                           mysqli_query($conn, $ins_query4);

                                                                           $_SESSION['id'] = $row3['ID'];
                                                                           $_SESSION['f_name'] = $_POST['reg_firstname'];
                                                                           $_SESSION['l_name'] = $_POST['reg_lastname'];
                                                                           $_SESSION['com_id'] = $row4['company_id'];
                                                                           $_SESSION['user_type'] = '0';
                                                                           $_SESSION['email'] = $_POST['Email'];

                                                                           header("Location: ../company/top_manager/index.php");
                                                                           exit();
                                                                       }
                                                                       else{
                                                                           $check = "خطأ بالتسجيل";
                                                                       }
                                                                   }else{
                                                                       $check = "خطأ بالتسجيل";
                                                                   }

                                                               }
                                                           }
                                                       }
                                                   }
                                               }
                                           }
                                       }
                                   }
                               }
                           }
                       }
                   }
                }
            }
        }
    }
    if($flag == 0)
        $check = "يــرجى إدخـال الـمعلومات الصحيحة";
}
?>

<body style=" height: 100%;">
<?php
include_once("../Info/analytics.php");
include_once ("../Info/Checking.php");
?>
<header class="navbar navbar-inverse navbar-static-top" >
    <div class="container">
        <div>
            <div class="nav navbar-nav navbar-right">
                <span class="navbar-brand"><img src="../images/Logo.svg" height="100" width="120" style="margin-top: -32%" title="Easy Deals"></span>
            </div>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="../index.php"><strong>الصفحة الرئيسية</strong></a></li>
            <li><a href="../Login.php"><strong>تسجيل الدخول</strong></a></li>
            <li class="active"><a href="Registration.php"><strong>انشاء حساب</strong></a></li>
            <li><a href="../Privacy_Policy.php"><strong>سياسة الخصوصية</strong></a></li>
        </ul>
    </div>
</header>

<!-- REGISTRATION FORM -->
<div class="text-center" style="padding:3% 0;">
    <div class="logo">إنشاء حساب شركة</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form action="Company_Registration.php" method="post" id="register-form" class="text-right">
            <div class="login-form-main-message">Welcome</div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group form_group_edges" id="form_reg_firstname">
                        <label for="reg_firstname" class="sr-only">First Name</label>
                        <input type="text" class="form-control" id="reg_firstname" name="reg_firstname" placeholder="الإسم الأول" onkeyup="name_validator('#reg_firstname','#form_reg_firstname')">
                    </div>
                    <div class="form-group form_group_edges" id="form_reg_lastname">
                        <label for="reg_lastname" class="sr-only">Last Name</label>
                        <input type="text" class="form-control" id="reg_lastname" name="reg_lastname" placeholder="الإسم الاخير" onkeyup="name_validator('#reg_lastname','#form_reg_lastname')">
                    </div>
                    <div class="form-group form_group_edges" id="form_username">
                        <label for="username" class="sr-only">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="إسم المستخدم" onkeyup="username_validator('#username','#form_username')">
                    </div>
                    <div class="form-group form_group_edges" id="form_reg_password">
                        <label for="reg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="كلمة المرور" onkeyup="password_validator('#reg_password','#form_reg_password')">
                    </div>
                    <div class="form-group form_group_edges" id="form_reg_password_confirm">
                        <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                        <input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="تأكيد كلمة المرور" onkeyup="confirmation_validator('#reg_password','#reg_password_confirm','#form_reg_password_confirm')">
                    </div>

                    <div class="form-group form_group_edges" id="form_Email">
                        <label for="Email" class="sr-only">Email</label>
                        <input type="text" class="form-control" id="Email" name="Email" placeholder="الإيميل" onkeyup="email_validator('#Email','#form_Email')">
                    </div>

                    <div class="form-group form_group_edges" id="form_reg_no">
                        <label for="reg_no" class="sr-only">mobile No.</label>
                        <input type="text" class="form-control" id="reg_no" name="reg_no" placeholder="رقم الجوال" onkeyup="phone_validator('#reg_no','#form_reg_no')">
                    </div>

                    <div class="form-group form_group_edges" id="form_reg_no1">
                        <label for="reg_no1" class="sr-only">mobile No.</label>
                        <input type="text" class="form-control" id="reg_no1" name="reg_no1" placeholder="رقم جوال (إختياري)" onkeyup="phone_validator('#reg_no1','#form_reg_no1')">
                    </div>

                    <div class="form-group form_group_edges" id="form_reg_address">
                        <label for="reg_address" class="sr-only">address.</label>
                        <input type="text" class="form-control" id="reg_address" name="reg_address" placeholder="الـعـنـوان" onkeyup="address_validator('#reg_address','#form_reg_address')">
                    </div>

                    <div class="form-group form_group_edges" id="form_reg_cname">
                        <label for="reg_cname" class="sr-only">Company Name</label>
                        <input type="text" class="form-control" id="reg_cname" name="reg_cname" placeholder="إسم الشركة" required>
                    </div>
                    <div class="form-group form_group_edges">
                        <label for="reg_city"></label>
                        <div >
                            <select id="reg_city" name="city" class="form-control" required>
                                <option value="">إختار محافظتك</option>
                                <?php
                                for ($i = 0;$i<count($city[0]);$i++){
                                    echo "
                                    <option value=".$city[0][$i].">".$city[1][$i]."</option>
                                    ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form_group_edges" id="form_reg_c_address">
                        <label for="reg_cname" class="sr-only">Company Address</label>
                        <input type="text" class="form-control" id="reg_c_address" name="reg_c_address" placeholder="عنوان الشركة" onkeyup="address_validator('#reg_c_address','#form_reg_c_address')">
                    </div>

                    <div class="form-group form_group_edges" id="form_c_description">
                        <label for="reg_desc" class="sr-only">Company description</label>
                        <textarea type="textarea" class="form-control" id="reg_desc" name="reg_desc" placeholder="وصف الشركة" required></textarea>
                    </div>

                    <div class="form-group form_group_edges">
                        
                        <div class="g-recaptcha form-control" id="recaptcha" data-sitekey="6LfdDCIUAAAAAMyAE9v49OEmKOhfvYv54JwLB2TT"></div>
                    
                    </div>
                    <div class="form-group col-lg-6 login-group-checkbox ">
                        <input type="checkbox" class="" id="reg_agree" name="reg_agree" required>
                        <label for="reg_agree">سياسة وشروط الموقع<a href="../Privacy_Policy.php"> هنـا</a></label>
                    </div><br>
                </div>
                <button type="submit" name="reg" class="login-button"><i class="glyphicon glyphicon-chevron-left"></i></button>

            </div>
            <div class="form-group" style="margin-left: 55%;">
                <p>هل لديك حساب ؟ <a href="../Login.php">تسجيل دخول</a></p>
            </div>
            <?php
            if($captch == 1){
                $captch = 0;
            echo "
            <div class=\"alert-danger col-lg-6\" style=\"margin-right: 43%\"> يـرجـى الـتحـقـق مـن الـكـابـتـشـا </div>";

            }
            elseif($check != ""){
                echo "
                <div class=\"alert-danger col-lg-6\" style=\"margin-right: 43%\">".$check."</div>";
                $check = "";
            }
            ?>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

<?php
include "Footer.php";
?>
</body>
</html>