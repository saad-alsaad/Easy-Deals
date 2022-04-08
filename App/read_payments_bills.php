<?php
include "../db.php";
$output1 = array();
$user_type = "0";
$ID = $_POST['ID'];
if($ID != ""){
    $query = "SELECT User_type from users WHERE ID = '$ID'";
    mysqli_query($conn, $query) or die("Error in query 1");
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if($row['User_type'] == "3"){
    	$user_type = "3";
        $query1 = "SELECT * FROM bills,company WHERE bills.dealer_id = '$ID' AND company.company_id = bills.company_id ORDER BY bills.Maturity_D LIMIT 6";
        mysqli_query($conn, $query1) or die("Error in query 1");
        $result1 = mysqli_query($conn, $query1);

        for($i = 0;$row1 = mysqli_fetch_assoc($result1);$i++){

        $output1[$i] = array("bill_id"=>$row1['Bill_id'],"name"=>$row1['name'],"amount"=>$row1['value'],"date"=>$row1['Maturity_D']);
        }
    }
    else{
        if($row['User_type'] == "0"){
        	// 10 means top manager
        	$user_type = "9";
            $query2 = "SELECT company_id from top_manager WHERE user_id = '$ID'";
        }
        elseif($row['User_type'] == "1"){
        	$user_type = "1";
            $query2 = "SELECT company_id from financial_manager WHERE user_id = '$ID'";
        }
        else{
        	$user_type = "2";
            $query2 = "SELECT company_id from goods_manager WHERE user_id = '$ID'";
        }
            mysqli_query($conn, $query2) or die("Error in query 2");
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            
        $query1 = "SELECT payments.dealer_id,payments.Date,payments.amount,payments.type,payments.Bill_id,users.ID,users.First_name,users.Last_name FROM payments,bills,users WHERE bills.Bill_id = payments.Bill_id AND bills.company_id = '$row2[company_id]' AND users.ID = payments.dealer_id ORDER BY payments.Date DESC LIMIT 6";

        mysqli_query($conn, $query1) or die("Error in query 1");
        $result1 = mysqli_query($conn, $query1);

        for($i = 0;$row1 = mysqli_fetch_assoc($result1);$i++){
            $p_type = "";
            if($row1['type'] == '0')
                $p_type = "كـاش";
            elseif ($row1['type'] == '1')
                $p_type = "شـيـك";
            elseif ($row1['type'] == '2')
                $p_type = "تـقـسـيـط";
            $name = $row1['First_name']." ".$row1['Last_name'];
            $output1[$i] = array("bill_id"=>$row1['Bill_id'],"name"=>$name,"amount"=>$row1['amount'],"type"=>$p_type);
        }
    }

    $data = array("$user_type" => $output1);

    echo json_encode($data,JSON_UNESCAPED_UNICODE);
}

?>