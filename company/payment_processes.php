<?php
include "../../db.php";
$output = array();

$query = "SELECT payments.dealer_id,payments.amount,payments.Date,payments.type,payments.Bill_id,users.ID,users.First_name,users.Last_name,payments.voucher_img FROM payments,bills,users WHERE bills.Bill_id = payments.Bill_id AND bills.company_id = '$_SESSION[com_id]' AND users.ID = payments.dealer_id";

$output = search($conn,$query);

function search ($conn,$query){
    $output = array();
    mysqli_query($conn, $query) or die("Error in query 1");
    $result = mysqli_query($conn, $query);

    for($i = 0;$row = mysqli_fetch_assoc($result);$i++){
        $output[0][$i] = $row['Bill_id'];
        $output[1][$i] = $row['First_name']." ".$row['Last_name'];
        $output[2][$i] = $row['amount'];
        $output[3][$i] = $row['Date'];
        $output[5][$i] = $row['voucher_img'];
        if($row['type'] == '0')
            $output[4][$i] = "كـاش";
        elseif ($row['type'] == '1')
            $output[4][$i] = "شـيـك";
        elseif ($row['type'] == '2')
            $output[4][$i] = "تـقـسـيـط";
    }
    return $output;
}

if(isset($_POST['search'])){
    $payment_type = "";
    $sort = "";
    $search_word = "";

    if($_POST['word'] != "")
        $search_word = " AND ( (users.First_name LIKE '%$_POST[word]%' OR users.Last_name LIKE '%$_POST[word]%') OR (CONCAT(users.First_name,' ',users.Last_name) LIKE '%$_POST[word]%'))";

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
        $payment_type = " AND payments.type = '$_POST[payment_type]'";
    }

    if($_POST['sort'] == "2"){
        $_SESSION['payment_amount'] = "selected";
        $sort = " ORDER BY payments.amount DESC";
    }
    else{
        $sort = " ORDER BY payments.Date DESC";
        $_SESSION['payment_date'] = "selected";
    }

    $search_query = "SELECT payments.dealer_id,payments.amount,payments.Date,payments.type,payments.Bill_id,users.ID,users.First_name,users.Last_name,payments.voucher_img FROM payments,bills,users WHERE bills.Bill_id = payments.Bill_id AND bills.company_id = '$_SESSION[com_id]' AND users.ID = payments.dealer_id".$search_word.$payment_type.$sort;
    $output = search($conn,$search_query);
}