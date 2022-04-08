<?php
include "db.php";
session_start();

if(!empty($_REQUEST['q']) && !preg_match('/^[ ]{1,20}$/',$_REQUEST['q'])) {
    $word = $_GET['q'];
    $query1 = "SELECT company.name FROM orders,company WHERE company.company_id = orders.Company_id AND orders.dealer_id = '$_SESSION[id]' AND (company.name LIKE '%$word%') GROUP BY company.company_id";
    $result = mysqli_query($conn, $query1);

    while($row = mysqli_fetch_assoc($result)){

        $name = $row['name'];
        echo '<option onclick="add_word(this.value)">'.$name.'</option>';
    }
}