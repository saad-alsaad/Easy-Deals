<?php
$phones = array();
require "db.php";

$phone_query = "SELECT phone FROM user_phone WHERE user_id = '$_SESSION[id]'";
$result1 = mysqli_query($conn, $phone_query);
$row1 = mysqli_fetch_assoc($result1);
$phones[0] = "0".$row1['phone'];
$row2 = mysqli_fetch_assoc($result1);
if($row2)
    $phones[1] = "0".$row2['phone'];


//mysqli_close($conn);

if(isset($_POST['update'])){
    $_SESSION['setting_update'] = "";

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
                    if(preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*()_=+|])[a-z??-??A-Z0-9!@#$%^&()_=+|*]{6,20}$/',$_POST['passwordinput']) && ($_POST['passwordinput'] == $_POST['password_confirm'])){
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

                if($_SESSION['setting_update'] == ""){
                    $_SESSION['setting_update'] = "0";}
                header("Location: Settings.php");
                exit();

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