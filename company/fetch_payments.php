<?php
include "../db.php";
session_start();

if(!empty($_REQUEST['q']) && !preg_match('/^[ ]{1,20}$/',$_REQUEST['q'])) {

    $word = $_REQUEST['q'];
    $query1 = "SELECT payments.dealer_id,payments.Bill_id,users.ID,users.First_name,users.Last_name FROM payments,bills,users WHERE bills.Bill_id = payments.Bill_id AND bills.company_id = '$_SESSION[com_id]' AND users.ID = payments.dealer_id AND ( (users.First_name LIKE '%$word%' OR users.Last_name LIKE '%$word%') OR (users.First_name + ' ' + users.Last_name) = '$word') GROUP BY payments.dealer_id";
    $result = mysqli_query($conn, $query1);

    while($row = mysqli_fetch_assoc($result)){

        $name = $row['First_name']." ".$row['Last_name'];
        echo '<option onclick="add_word(this.value)">'.$name.'</option>';
    }
}