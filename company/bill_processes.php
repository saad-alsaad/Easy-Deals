<?php
$output = array();
include "../../db.php";

$query = "SELECT bills.Bill_id,bills.value,bills.Order_id,bills.Creation_date,bills.Maturity_D,users.First_name,users.Last_name,orders.order_id,orders.payment_type,users.Address FROM bills,users,orders WHERE bills.company_id = '$_SESSION[com_id]' AND users.ID = bills.dealer_id AND orders.order_id = bills.Order_id";

$output = search($conn,$query);

function payment_check($conn,$bill_id){
    $query2 = "SELECT * FROM payments WHERE Bill_id = '$bill_id'";
    mysqli_query($conn, $query2) or die("Error in query 2");
    $result2 = mysqli_query($conn, $query2);

    $total = 0;
    while ($row2 = mysqli_fetch_assoc($result2)){
        $total += $row2['amount'];
    }
    return $total;
}

function search($conn,$query){
    $output = array();

    mysqli_query($conn, $query) or die("Error in query 1");
    $result = mysqli_query($conn, $query);
    for ($i = 0;$row = mysqli_fetch_assoc($result);$i++){

        $output[0][$i] = $row['First_name']." ".$row['Last_name'];;
        $output[1][$i] = $row['Creation_date'];
        $output[2][$i] = $row['Maturity_D'];
        $output[4][$i] = $row['value'];
        $output[7][$i] = $row['Bill_id'];
        $output[8][$i] = $row['Address'];

        //orders
        $order_details = "SELECT order_details.good_id,order_details.goods_q,goods.Name,goods.good_id,goods.price FROM order_details,goods WHERE order_details.order_id = '$row[Order_id]' AND goods.good_id = order_details.good_id";
        mysqli_query($conn, $order_details) or die("Error in query 1");
        $result1 = mysqli_query($conn, $order_details);

        for($k = 0;$row3 = mysqli_fetch_assoc($result1);$k++){
            $output[12][$i][$k] = $row3['price'];
            $output[11][$i][$k] = $row3['goods_q'];
            $output[10][$i][$k] = $row3['Name'];
            $output[9][$i][$k] = ((double)$row3['price']) * ((double)$row3['goods_q']);
        }
        $output[13][$i] = ((double)$row['value']) * 0.16;

        $current_date = date("Y-m-d");
        $datetime1 = date_create($current_date);
        $datetime2 = date_create($output[2][$i]);
        $interval = date_diff($datetime1, $datetime2);
        $d = $interval->format('%R%a');

        if((strpos($d, '+') !== false ) and $d !== "+0"){
            $output[3][$i] = "غـيـر مـنـتـهـيـه";
        }
        else{
            $output[3][$i] = "مـنـتـهـيـه";
        }

        //payment type
        /*
        if($payment_type == ""){
            $q = "SELECT payment_type FROM orders WHERE order_id = '$row[Order_id]'";
            mysqli_query($conn, $q) or die("Error in query 1");
            $rr = mysqli_query($conn, $q);
            $r = mysqli_fetch_assoc($rr);
            $payment_type = $r['payment_type'];
        }*/

        if($row['payment_type'] == '0'){
            $output[5][$i] = "كــاش";
            $output[6][$i] = payment_check($conn,$row['Bill_id']);
        }
        elseif ($row['payment_type'] == '2'){
            $output[5][$i] = "تــقــســيــط";
            $output[6][$i] = payment_check($conn,$row['Bill_id']);
        }
        elseif ($row['payment_type'] == '1'){
            $output[5][$i] = "شــيــك";
            $query2 = "SELECT * FROM checks WHERE Bill_id = '$row[Bill_id]'";
            mysqli_query($conn, $query2) or die("Error in query 3");
            $result2 = mysqli_query($conn, $query2);

            $total = 0;
            while ($row2 = mysqli_fetch_assoc($result2)){
                $total += $row2['Value'];
            }
            $output[6][$i] = $total;
        }
    }
    return $output;
}

if(isset($_POST['search'])){
    $type = "";
    $sort = "";
    $search_word = "";

    if($_POST['search_word'] != ""){
        $search_word = " AND ( (users.First_name LIKE '%$_POST[search_word]%' OR users.Last_name LIKE '%$_POST[search_word]%') OR (CONCAT(users.First_name,' ',users.Last_name) LIKE '%$_POST[search_word]%'))";
    }

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
        $type = " AND orders.payment_type = '$_POST[payment_type]'";
    }

    if($_POST['sort'] != ""){
        if($_POST['sort'] == "1"){
            $_SESSION['sort_1'] = "selected";
            $sort = " ORDER BY bills.Creation_date";
        }
        elseif ($_POST['sort'] == "2"){
            $_SESSION['sort_2'] = "selected";
            $sort = " ORDER BY bills.Maturity_D";
        }
        elseif ($_POST['sort'] == "3"){
            $_SESSION['sort_3'] = "selected";
            $sort = " ORDER BY bills.value";
        }
        elseif ($_POST['sort'] == "4"){
            $_SESSION['sort_4'] = "selected";
            $sort = " ORDER BY bills.value DESC";
        }
    }


    $search_query = "SELECT bills.Bill_id,bills.value,bills.Order_id,bills.Creation_date,bills.Maturity_D,users.First_name,users.Last_name,orders.order_id,orders.payment_type,users.Address FROM bills,users,orders WHERE bills.company_id = '$_SESSION[com_id]' AND users.ID = bills.dealer_id AND orders.order_id = bills.Order_id".$search_word.$type.$sort;

    $output = search($conn,$search_query);
}
?>