<?php
include "../db.php";
session_start();

if(!empty($_REQUEST['q']) && !preg_match('/^[ ]{1,20}$/',$_REQUEST['q'])) {

    $search = $_REQUEST['q'];

    $query = "SELECT Name FROM goods WHERE company_id = '$_SESSION[com_id]' AND Name LIKE '%$search%'";

    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){
        $good_name = $row['Name'];
        echo '<option onclick="add_word(this.value)">'.$good_name.'</option>';
    }
}
?>