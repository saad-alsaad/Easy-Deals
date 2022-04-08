<?php
include "db.php";
session_start();

if(!empty($_REQUEST['q']) && !preg_match('/^[ ]{1,20}$/',$_REQUEST['q'])) {

    $word = $_REQUEST['q'];
    $query1 = "SELECT payments.dealer_id,payments.amount,payments.Date,payments.type,payments.Bill_id,bills.Bill_id,payments.voucher_img,company.name FROM payments,bills,company WHERE bills.Bill_id = payments.Bill_id AND payments.dealer_id = '$_SESSION[id]' AND company.company_id= bills.company_id AND  company.name LIKE '%$word%' GROUP BY bills.company_id";
    $result = mysqli_query($conn, $query1);

    while($row = mysqli_fetch_assoc($result)){

      //  $aa="select name from company WHERE company_id=".$row['company_id'];
     //   $bc=mysqli_query($conn,$aa);
      //  while($r=mysqli_fetch_array($bc))
           $name = $row['name'];
        echo '<option onclick="add_word(this.value)">'.$name.'</option>';
    }
}