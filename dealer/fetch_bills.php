<?php
include "db.php";
session_start();
if(!empty($_REQUEST['q']) && !preg_match('/^[ ]{1,20}$/',$_REQUEST['q'])) {

    $word = $_REQUEST['q'];
    $query1 = "SELECT bills.Bill_id,company.name,bills.company_id FROM bills,company WHERE bills.dealer_id = '$_SESSION[id]' AND company.company_id = bills.company_id AND company.name LIKE '%$word%' GROUP BY company.company_id";
    $result = mysqli_query($conn, $query1);

    while($row = mysqli_fetch_assoc($result)){

        $name = $row['name'];
        echo '<option onclick="add_word(this.value)">'.$name.'</option>';
    }
}