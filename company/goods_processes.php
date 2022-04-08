<?php
$com_id = $_SESSION['com_id'];
$user_id = $_SESSION['id'];
include "../../db.php";

global $type_ids;
global $addition_flag;
$addition_flag = 0;
$type_ids= array();

$output = array();
//$search = preg_replace("#[^0-9a-z]#i","",$search);
$output = search($conn,"SELECT * FROM goods WHERE company_id = ".$com_id);

$types = array();
$q = "SELECT * FROM company_good_type WHERE company_id = ".$com_id;
mysqli_query($conn, $q) or die('Error querying database.');
$res = mysqli_query($conn, $q);
$k = 0;
while ($r1 = mysqli_fetch_assoc($res)){
    $type_ids[$k] = $r1['type_id'];
    $q1 = "SELECT * FROM goods_types WHERE type_id = ".$r1['type_id'];
    mysqli_query($conn, $q1) or die('Error querying database.');
    $res1 = mysqli_query($conn, $q1);
    $r2 = mysqli_fetch_assoc($res1);
    $types[$k] = $r2['name'];
    $k++;
}


function search($conn,$query){
    $output = array();
    mysqli_query($conn, $query) or die('Error querying database.');

    $result = mysqli_query($conn, $query);

    for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {

        $output[0][$i] = $row['Name'];
        $output[1][$i] = $row['available_q'];
        $output[2][$i] = $row['Sold_q'];
        $output[3][$i] = $row['entry_date_time'];
        $output[8][$i] = $row['price'];
        $output[3][$i] = str_replace(' '," -- ",$output[3][$i]);
        $user_id = $row['added_by_id'];
        $type_id = $row['good_type_id'];

        $query1 = "SELECT First_name, Last_name FROM users WHERE ID = ".$user_id;
        mysqli_query($conn, $query1) or die('Error querying database.');
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_assoc($result1);

        //we need to find better solution in goods types
        $query2 = "SELECT name FROM goods_types WHERE type_id = ".$type_id;
        mysqli_query($conn, $query2) or die('Error querying database.');
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);

        $output[5][$i] = $row1['First_name'] .' '. $row1['Last_name'];
        $output[6][$i] = $row2['name'];
        $output[7][$i] = $row['good_details'];
    }
    return $output;
}

if (isset($_POST['add_new'])){

    if(preg_match('/^[0-9A-Zأ-م-ف-ض-ص-ث-ق-غ-ع-ه-خ-ح-ج-د-ش-س-ب-ل-ا-ت-ن-م-ك-ط-ئ-ء-ؤ-ر-لا-ى-ة-و-ز-ظ-ذ-يa-z- ]{3,100}$/',$_POST['good']) && preg_match('/^[0-9]{1,20}$/',$_POST['quantity']) && preg_match('/^[0-9]{1,20}$/',$_POST['sold_quantity']) && preg_match('/^[0-9-.]{1,20}$/',$_POST['price'])){
        $av_quantity = ((int)$_POST['quantity']) - ((int)$_POST['sold_quantity']);
        if($av_quantity >= 0){
            $good = $_POST['good'];
            $sold = $_POST['sold_quantity'];
            $tp_id = $_POST['type'];
            $details = $_POST['details'];
            $price = $_POST['price'];

            $qr = "INSERT INTO goods (company_id, available_q, Name, Sold_q, entry_date_time, added_by_id,good_type_id, good_details, price)
          VALUES ('$com_id','$av_quantity','$good','$sold',NOW(),'$user_id','$tp_id','$details','$price')";

            if(mysqli_query($conn, $qr)){
                $_SESSION['good_feedback'] = "1";
            }
            else{
                $_SESSION['good_feedback'] = "2";
            }
        }
        else{
            $_SESSION['good_feedback'] = "4";
        }

    }
    else{
        $_SESSION['good_feedback'] = "3";
    }

    header("Location: Goods.php");
    exit();
}


if (isset($_POST['search'])){
    $output = array();
    $search = $_POST['search_word'];
    $good_type = "";
    $sort = "";
    if($_POST['good_type'] != ""){
        $good_type = " AND good_type_id = '$_POST[good_type]'";
        $_SESSION[$_POST['good_type']] = "selected";
    }

    if($_POST['sort'] == "2"){
        $sort = " ORDER BY available_q";
        $_SESSION['good_q'] = "selected";
    }
    else{
        $_SESSION['good_date'] = "selected";
    }

    $output = search($conn,"SELECT * FROM goods WHERE company_id = '$com_id' AND Name LIKE '%$search%'".$good_type.$sort);
}

?>