<?php
include "../../db.php";
$output = array();
$search_output = array();
$date_flag = 0;
$search_flag = 0;

$query1 = "SELECT orders.order_id,orders.Date_time,orders.status,orders.dealer_id,orders.payment_type,users.First_name,users.Last_name FROM orders,users WHERE Company_id = '$_SESSION[com_id]' AND users.ID = orders.dealer_id";

$output = search($conn,$query1);

function search($conn,$query){
    $output = array();
    mysqli_query($conn, $query) or die('Error querying database 1');
    $res = mysqli_query($conn, $query);
    $k = 0;
    while ($r1 = mysqli_fetch_assoc($res)){
        if($r1['status'] == '0')
            $output[0][$k] = "لـم يـتـم الـرد";
        elseif($r1['status'] == '1')
            $output[0][$k] = "تـمت الـمـوافـقـة";
        elseif ($r1['status'] == '2')
            $output[0][$k] = "تـم الـرفـض";
        $output[9][$k] = $r1['order_id'];
        $output[1][$k] = $r1['Date_time'];
        $output[1][$k] = str_replace(' '," -- ",$output[1][$k]);

        //dealer info
        $output[10][$k] = $r1['dealer_id'];
        $output[2][$k] = $r1['First_name'].' '.$r1['Last_name'];
        $output[5][$k] = $r1['First_name'];
        $output[6][$k] = $r1['Last_name'];
        //------------

        //check payment type
        if($r1['payment_type'] == '0'){
            $output[12][$k] = "كــاش";
        }
        elseif ($r1['payment_type'] == '1'){
            $output[12][$k] = "شــيــك";
        }
        elseif ($r1['payment_type'] == '2'){
            $output[12][$k] = "تــقــســيــط";
        }
        //------------


        $query3 = "SELECT * FROM order_details WHERE order_id = ".$r1['order_id'];
        mysqli_query($conn, $query3) or die('Error querying database 3');
        $res2 = mysqli_query($conn, $query3);
        $output[15][$k] = 0;
        $total = 0;
        for($t = 0;$r3 = mysqli_fetch_assoc($res2);$t++){
            $output[3][$k][$t] = $r3['goods_q'];

            $query4 = "SELECT good_id,available_q,Name,good_details, price, Sold_q FROM goods WHERE good_id = ".$r3['good_id'];

            mysqli_query($conn, $query4) or die('Error querying database 4');
            $res3 = mysqli_query($conn, $query4);
            $r4 = mysqli_fetch_assoc($res3);
            $output[14][$k][$t] = 0;
            $output[4][$k][$t] = $r4['Name'];
            $output[7][$k][$t] = $r4['good_details'];
            $output[18][$k][$t] = $r4['price'];
            $output[8][$k][$t] = $r4['price'] * $r3['goods_q'];
            $total += (double)$output[8][$k][$t];
            $output[13][$k][$t] = $r4['good_id'];
            $output[16][$k][$t] = $r4['available_q'];
            $output[17][$k][$t] = $r4['Sold_q'];
            if(((int)$r4['available_q']) < ((int) $output[3][$k][$t])){
                $output[14][$k][$t] = 1;
                $output[15][$k] = 1;
            }
        }
        $output[11][$k] = $total."";

        $k++;
    }

    return $output;
}


if(isset($_POST['search'])){
    $word = $_POST['search_word'];
    if($_POST['payment_type'] != ""){
        if($_POST['payment_type'] == "0"){
            $_SESSION['type_0'] = "selected";
        }
        elseif ($_POST['payment_type'] == "1"){
            $_SESSION['type_1'] = "selected";
        }
        else{
            $_SESSION['type_2'] = "selected";
        }
        $payment_type = " AND orders.payment_type = '$_POST[payment_type]'";
    }

    else
        $payment_type = "";

    $query1 = "SELECT orders.order_id,orders.Date_time,orders.status,orders.dealer_id,orders.payment_type,users.First_name,users.Last_name FROM orders,users WHERE orders.Company_id = '$_SESSION[com_id]' AND users.ID = orders.dealer_id AND ((users.First_name LIKE '%$word%') OR (users.Last_name LIKE '%$word%') OR (CONCAT(users.First_name,' ',users.Last_name) LIKE '%$word%'))".$payment_type;
    $output = search($conn,$query1);
}

if(isset($_POST['deny'])){
    $id = $output[9][((int)$_POST['id'])];
    $dealer_id = $output[10][$_POST['id']];
    $message = "تـم رفـض طـلـبـك";
    // change order status
    $q = "Update orders SET status = 2 WHERE order_id = '$id'";
    mysqli_query($conn, $q);

    //send notification to dealer
    $q1 = "INSERT INTO notification (sent_time, Message, sender_id, receiver_id, type) VALUES (NOW(),'$message','$_SESSION[id]','$dealer_id',1)";
    mysqli_query($conn, $q1);

    header("Location: Orders.php");
}

function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

if(isset($_POST['accept'])){
    $id = $output[9][((int)$_POST['id'])];
    $dealer_id = $output[10][$_POST['id']];
    $value = $output[11][$_POST['id']];
    $m_date = $_POST['m_date'];
    $available = array();
if($output[15][$_POST['id']] != 1){
       if(validateDate($m_date)){
        $message = "تـمـت الـمـوافـقـة عـلـى طـلـبـك";
        $message1 = "تـم إصـدار فـاتـورة والـتـي سـتـنـتـهـي بـتـاريـخ : ".$m_date;

        $q = "Update orders SET status = 1 WHERE order_id = '$id'";
        mysqli_query($conn, $q);
        for ($e = 0;$e < count($output[16][$_POST['id']]);$e++){
            $av = $output[16][$_POST['id']][$e] - $output[3][$_POST['id']][$e];
            $g_id = $output[13][$_POST['id']][$e];
            $sold = $output[17][$_POST['id']][$e] + $output[3][$_POST['id']][$e];
            $qq = "UPDATE goods SET available_q = $av, Sold_q = $sold  WHERE good_id = $g_id";
            mysqli_query($conn, $qq);
        }

        $q1 = "INSERT INTO bills (company_id, dealer_id, manager_id, Creation_date, Maturity_D, Order_id,value,active) VALUES ('$_SESSION[com_id]','$dealer_id','$_SESSION[id]',CURRENT_DATE(),CAST('$m_date' AS DATE),$id,$value,1)";
        mysqli_query($conn, $q1);

        $current_date = date("Y-m-d H:i:s");
        //send order notification to dealer
        $q2 = "INSERT INTO notification (sent_time, Message, sender_id, receiver_id, type) VALUES ('$current_date','$message','$_SESSION[id]','$dealer_id',1)";
        mysqli_query($conn, $q2);

        //send bill notification to dealer
        $q3 = "INSERT INTO notification (sent_time, Message, sender_id, receiver_id, type) VALUES ('$current_date','$message1','$_SESSION[id]','$dealer_id',2)";
        mysqli_query($conn, $q3);

        $q4 = "INSERT INTO notification (sent_time, Message, sender_id, receiver_id, type) VALUES ('$current_date','$message1','$dealer_id','$_SESSION[id]',2)";
        mysqli_query($conn, $q4);

           $_SESSION['order_feedback'] = "1";
       }
       else{
           $_SESSION['order_feedback'] = "2";
       }
    }
    else{
        $_SESSION['order_feedback'] = "3";
    }
    header("Location: Orders.php");
exit();
}
?>