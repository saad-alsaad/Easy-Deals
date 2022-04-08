<?php
session_start();
include "db.php";

if(!empty($_REQUEST['q']) && !preg_match('/^[ ]{1,20}$/',$_REQUEST['q'])) {

    $word = $_REQUEST['q'];
    $q1 = "SELECT users.ID, financial_manager.company_id, financial_manager.user_id,users.First_name,users.Last_name FROM financial_manager,users WHERE financial_manager.company_id = '$_SESSION[com_id]' AND users.ID = financial_manager.user_id";
    $result1 = mysqli_query($conn, $q1);

    while($row = mysqli_fetch_assoc($result1)){
        $name = $row['First_name']." ".$row['Last_name'];
        echo '<option onclick="add_word(this.value)">'.$name.'</option>';
    }

    // goods managers
    $q2 = "SELECT users.ID, goods_manager.company_id, goods_manager.user_id,users.First_name,users.Last_name FROM goods_manager,users WHERE goods_manager.company_id = '$_SESSION[com_id]' AND users.ID = goods_manager.user_id";
    $result2 = mysqli_query($conn, $q2);

    while($row = mysqli_fetch_assoc($result2)){
        $name = $row['First_name']." ".$row['Last_name'];
        echo '<option onclick="add_word(this.value)">'.$name.'</option>';
    }
}
?>