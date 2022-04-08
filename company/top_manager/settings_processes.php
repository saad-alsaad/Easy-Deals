<?php
$company_description = "";
$phones = array();
$goods_types = array();
$com_good_types = array();
require "db.php";

$desc_query = "SELECT description FROM company WHERE company_id = '$_SESSION[com_id]'";
$result = mysqli_query($conn, $desc_query);
$row = mysqli_fetch_assoc($result);
$company_description = $row['description'];

$phone_query = "SELECT phone FROM user_phone WHERE user_id = '$_SESSION[id]'";
$result1 = mysqli_query($conn, $phone_query);
$row1 = mysqli_fetch_assoc($result1);
$phones[0] = "0".$row1['phone'];
$row2 = mysqli_fetch_assoc($result1);
if($row2)
    $phones[1] = "0".$row2['phone'];

$good_types_query = "SELECT * FROM goods_types";
$result2 = mysqli_query($conn, $good_types_query);
for($i = 0;$row3 =  mysqli_fetch_assoc($result2); $i++){
    $goods_types[0][$i] = $row3['type_id'];
    $goods_types[1][$i] = $row3['name'];
    $goods_types[2][$i] = "";
}

$com_types_query = "SELECT goods_types.name,goods_types.type_id FROM company_good_type,goods_types WHERE company_good_type.company_id = '$_SESSION[com_id]' AND goods_types.type_id = company_good_type.type_id";
$result3 = mysqli_query($conn, $com_types_query);
for($i = 0;$row3 =  mysqli_fetch_assoc($result3); $i++){
    $com_good_types[0][$i] = $row3['type_id'];
    $com_good_types[1][$i] = $row3['name'];
}

for($i = 0; $i < count($goods_types[0]); $i++){
    for($j = 0; $j < count($com_good_types[0]); $j++){
        if($goods_types[0][$i] == $com_good_types[0][$j]){
            $goods_types[2][$i] = "checked";

        }
    }
}

//mysqli_close($conn);

if(isset($_POST['update'])){
    $_SESSION['setting_update'] = "";
    if($_POST['company_desc'] != ""){
        if(preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/',$_POST['phone1'])){
            if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['email'])){

                $ph_query1 = "UPDATE user_phone SET phone='$_POST[phone1]' WHERE user_id = '$_SESSION[id]' AND phone = '$phones[0]'";
                $com_query = "UPDATE company SET description='$_POST[company_desc]' WHERE company_id = '$_SESSION[com_id]'";
                if(!mysqli_query($conn,$ph_query1)){
                    $_SESSION['setting_update'] = "1";
                }

                if($_POST['phone2'] != ""){
                    if(preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/',$_POST['phone2'])){
                        if(count($phones) > 1){
                            $ph_query2 = "UPDATE user_phone SET phone='$_POST[phone2]' WHERE user_id = '$_SESSION[id]' AND phone = '$phones[1]'";
                        }
                        else{
                            $ph_query2 = "INSERT INTO user_phone (user_id,phone) VALUES ('$_SESSION[id]','$_POST[phone2]')";
                        }
                        if(!mysqli_query($conn,$ph_query2)){
                            $_SESSION['setting_update'] = "2";
                        }
                    }
                }
                mysqli_query($conn,$com_query);

                if($_POST['passwordinput'] != ""){
                    if(preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*()_=+|])[a-zأ-يA-Z0-9!@#$%^&()_=+|*]{6,20}$/',$_POST['passwordinput']) && ($_POST['passwordinput'] == $_POST['password_confirm'])){
                        $encrypt_password = password_hash($_POST['passwordinput'],PASSWORD_DEFAULT);
                        $query = "UPDATE users SET Email='$_POST[email]',Password='$encrypt_password' WHERE ID = '$_SESSION[id]'";
                        mysqli_query($conn,$query);

                    }else{
                        $_SESSION['setting_update'] = "3";
                    }
                }
                elseif($_POST['passwordinput'] == ""){
                    $query4 = "UPDATE users SET Email='$_POST[email]' WHERE ID = '$_SESSION[id]'";
                    if(!mysqli_query($conn,$query4)){
                        $_SESSION['setting_update'] = "5";
                    }
                    else{
                        $_SESSION['email'] = $_POST['email'];
                    }
                }
                $checkbox_flag = 0;
                $check_box = array();
                for($j = 0,$kk = 0; $j < count($goods_types[0]);$j++){

                    if(isset($_POST[''.$j])){
                        for($t = 0; $t < count($goods_types[0]); $t++){
                            if($_POST[''.$j] == $goods_types[0][$t]){
                                if($goods_types[2][$t] == ""){
                                    $check_box[$kk] = $goods_types[0][$t];
                                    $kk++;
                                    break;
                                }
                            }
                        }
                        $checkbox_flag = 1;
                    }
                }

                if($checkbox_flag = 0){
                    $_SESSION['setting_update'] = "6";
                }
                else{
                   // $query5 = "SELECT FROM "
                    for($o = 0; $o < count($check_box);$o++){
                        $type_query = "INSERT INTO company_good_type (company_id, type_id) VALUES ('$_SESSION[com_id]','$check_box[$o]')";
                        if(!mysqli_query($conn,$type_query)){
                            $_SESSION['setting_update'] = "7";
                        }
                    }

                }

                if($_SESSION['setting_update'] == ""){
                    $_SESSION['setting_update'] = "0";}
                header("Location: Settings.php");
                exit();

            }
        }
    }

    $_SESSION['setting_update'] = "4";
    header("Location: Settings.php");
    exit();
}

if(isset($_POST['cancel'])){
    header("Location: index.php");
    exit();
}