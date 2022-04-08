<?php
$output = array();
$cities = array();
$output2 = array();
$output1 = array();
$financial_manager_ids = array();
$goods_manager_ids = array();

include "db.php";
include "../../send_email.php";

$city_query = "SELECT * FROM city";
mysqli_query($conn, $city_query) or die('Error querying database.');
$city_result = mysqli_query($conn, $city_query);

for($i = 0;$city_row = mysqli_fetch_assoc($city_result);$i++){
    $cities[0][$i] = $city_row['city_id'];
    $cities[1][$i] = $city_row['name'];
}

function manager_search($conn,$query){
    $out = array();
    mysqli_query($conn, $query) or die('Error querying database.');

    $result = mysqli_query($conn, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $out[$i] = $row['user_id'];
        $i++;
    }
    return $out;
}

function managers_information($conn,$manager_type,$search_word){
    $output = array();
    $search_statement = "";
    if($search_word != ""){
        $word = mysqli_real_escape_string($conn,$search_word);
        $search_statement = " AND ((users.First_name LIKE '%$word%') OR (users.Last_name LIKE '%$word%') OR (CONCAT(users.First_name,' ',users.Last_name) LIKE '%$word%'))";
    }

    if($manager_type == '1')
        $qq = "SELECT user_id FROM financial_manager WHERE company_id = '$_SESSION[com_id]'";
    else
        $qq = "SELECT user_id FROM goods_manager WHERE company_id = '$_SESSION[com_id]'";

    mysqli_query($conn, $qq) or die('Error querying database.');
    $result = mysqli_query($conn, $qq);
    $i = 0;
    while($rrr = mysqli_fetch_assoc($result)){
        $query = "SELECT CONCAT(users.First_name,' ',users.Last_name) 'full_name',users.Email,users.Username,users.Address,users.User_type,city.name FROM users,city WHERE users.ID = '$rrr[user_id]' AND city.city_id = users.city_id".$search_statement;
        mysqli_query($conn, $query) or die('Error querying database.');
        $result1 = mysqli_query($conn, $query);
        if($row = mysqli_fetch_assoc($result1)){
            $output[0][$i] = $row['Username'];
            $output[1][$i] = $row['full_name'];
            $output[2][$i] = $row['Email'];
            $output[3][$i] = $row['Address'];
            $output[6][$i] = $row['city_id'];
            $output[4][$i] = $row['name'];
            if($row['User_type'] == '1')
                $output[5][$i] = "مــديــر مـالـي";
            elseif ($row['User_type'] == '2'){
                $output[5][$i] = "مــديــر بــضــائـع";
            }
            $i++;
        }

    }
    return $output;
}

function store_managers($output1,$output2){
    $output = array();
    $i = 0;
    for (; $i < count($output1[0]);$i++){
        for($j = 0; $j <= 6;$j++)
            $output[$j][$i] = $output1[$j][$i];
    }

    for ($k = $i, $x = 0; $x < count($output2[0]);$k++,$x++){
        for($j = 0; $j <= 6;$j++)
            $output[$j][$k] = $output2[$j][$x];
    }
    return $output;
}

$output1 = managers_information($conn,'1',"");
$output2 = managers_information($conn,'2',"");

$output = store_managers($output1,$output2);

if(isset($_POST['sub'])){
    $output = array();
    $search = $_POST['search'];
    $type = $_POST['type'];
//echo $search;
    if($type == '1'){
        $_SESSION['type_1'] = "selected";
        $output = managers_information($conn,'1',$search);
    }
    elseif ($type == '2'){
        $_SESSION['type_2'] = "selected";
        $output = managers_information($conn,'2',$search);
    }
    else{
        $_SESSION['type_0'] = "selected";
        $output1 = managers_information($conn,'1',$search);
        $output2 = managers_information($conn,'2',$search);
        $output = store_managers($output1,$output2);
    }
}

function random_password( $length = 10 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}


if(isset($_POST['add_new'])){
    if(preg_match('/^[a-zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يA-Z]{3,20}$/',$_POST['first_name'])){
        //echo "reach";
        if(preg_match('/^[a-zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يA-Z]{3,20}$/',$_POST['last_name'])){
            //echo "reach";
            if(preg_match('/^[0-9A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z]{3,20}$/',$_POST['username'])){
                if(preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/',$_POST['phone'])){
                    if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['email'])) {
                        if (preg_match('/^[ A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z0-9-]{13,60}$/',$_POST['address'])) {
                            $username_q = "SELECT ID FROM users WHERE Username = '$_POST[username]' OR Email = '$_POST[email]'";
                            $result = mysqli_query($conn, $username_q);
                            $row = mysqli_fetch_assoc($result);
                            if ($row) {
                                $_SESSION['username_flag'] = "1";

                                header("Location: Managers.php");
                                exit();
                            } else {
                                $city = (int) $_POST['city_name'];
                                $manager_type = (int)$_POST['type'];

                                $password = "";

                                while (1){
                                    $password = random_password();
                                    if(preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*()_=+|])[a-zأ-يA-Z0-9!@#$%^&()_=+|*]{6,20}$/',$password)){
                                        break;
                                    }
                                    continue;
                                }

                                $send_password = $password;
                                $password = password_hash($password,PASSWORD_DEFAULT);

                                $query = "INSERT INTO users (Username, First_name, Last_name, Email, User_type, Address, Password, city_id) VALUES ('$_POST[username]','$_POST[first_name]','$_POST[last_name]','$_POST[email]','$manager_type','$_POST[address]','$password','$city')";

                                if(mysqli_query($conn, $query)){
                                    echo "done";
                                }
                                else{
                                    echo "problem";
                                }

                                $query1 = "SELECT ID FROM users WHERE Username = '$_POST[username]'";
                                mysqli_query($conn, $query1) or die('Error querying database.');
                                $result1 = mysqli_query($conn, $query1);
                                $row1 = mysqli_fetch_assoc($result1);

                                $query2 = "";
                                $manager_type_name = "";
                                if($manager_type == 1){
                                    $query2 = "INSERT INTO financial_manager (user_id, company_id) VALUES ('$row1[ID]','$_SESSION[com_id]')";
                                    $manager_type_name = " مدير مالي ";
                                }
                                elseif($manager_type == 2){
                                    $query2 = "INSERT INTO goods_manager (user_id, company_id) VALUES ('$row1[ID]','$_SESSION[com_id]')";
                                    $manager_type_name = " مدير بضائع ";
                                }
                                mysqli_query($conn, $query2);

                                $query3 = "INSERT INTO user_phone (phone, user_id) VALUES ('$_POST[phone]','$row1[ID]')";
                                mysqli_query($conn, $query3);

                                $_SESSION['username_flag'] = "3";

                                $message = "تم إنشاء حـسـاب لـك مـن قـبـل ".$_SESSION['f_name']." ".$_SESSION['l_name']." بصلاحيات ".$manager_type_name."\n"." إسم المستخدم :  ".$_POST['username']."\n"." كلمة المرور :  ".$send_password;

                                send_email($_POST['email'],"حساب مدير جديد",$message);

                                header("Location: Managers.php");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
    $_SESSION['username_flag'] = "2";
    header("Location: Managers.php");
    exit();
}
?>