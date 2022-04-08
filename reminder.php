<?php
include "db.php";
include "Sending_SMS.php";

$query = "SELECT bills.Bill_id, bills.Maturity_D,bills.value,bills.Order_id,bills.dealer_id, bills.manager_id,bills.company_id,company.name FROM bills,company WHERE bills.Maturity_D > CURRENT_DATE() AND bills.active = 1 AND company.company_id = bills.company_id";
mysqli_query($conn, $query) or die("Error in query 1");
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)){
    //dealer id

    //first name and last name for the dealer
    $q2 = "SELECT First_name,Last_name FROM users WHERE ID = '$row[dealer_id]'";
    mysqli_query($conn, $q2) or die("Error in query 1");
    $res2 = mysqli_query($conn, $q2);
    $row2 = mysqli_fetch_assoc($res2);
    $name = $row2['First_name']." ".$row2["Last_name"];

    // GET A PHONE
    $q4 = "SELECT phone FROM user_phone WHERE user_id = '$row[dealer_id]'";
    $res4 = mysqli_query($conn, $q4);
    $row4 = mysqli_fetch_assoc($res4);
    $phone = "970".$row4['phone'];

    $datetime1 = date_create(date("Y-m-d"));
    $datetime2 = date_create($row['Maturity_D']);
    $interval = date_diff($datetime1, $datetime2);
    $d = $interval->format('%R%a');
    $d = substr_replace($d, "", -1);

    if(((int) $d) == 5 || ((int) $d) == 2 || ((int) $d) == 1 ){
        $message = "تـذكـيـر بـتـاريـخ نهاية الفاتورة المستحقة على ".$name." وقيمتها ".$row['value']." شيكلا وتنتهي بتاريخ ".$row['Maturity_D'];
        $message1 = "تـذكـيـر بـتـاريـخ نهاية الفاتورة رقم ".$row['Bill_id']." المستحقة عليك والتي تنتهي بتاريخ $row[Maturity_D]"." وقيمتها: ".$row['value']." شيكلا "." \nالمستفيد : ".$row['name'];
        $sms_message = "A reminder to your bill number ".$row['Bill_id']." which expire at ".$row['Maturity_D'];
        $q3 = "INSERT INTO notification (receiver_id,sender_id,Message,sent_time,type,status) VALUES ('$row[manager_id]','$row[dealer_id]','$message',NOW(),3,0)";
        $q4 = "INSERT INTO notification (receiver_id,sender_id,Message,sent_time,type,status) VALUES ('$row[dealer_id]','$row[manager_id]','$message1',NOW(),3,0)";
        mysqli_query($conn, $q3);
        mysqli_query($conn, $q4);
        send_sms($sms_message,970569447954);
    }
}
?>