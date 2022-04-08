<?php
$output = array();
include "db.php";

$query = "SELECT DISTINCT dealer_id FROM bills WHERE company_id = '$_SESSION[com_id]'";

$output = search($conn,$query);

function search($conn,$query,$search = ""){
    $output = array();

    mysqli_query($conn, $query) or die("Error in query 1");
    $result = mysqli_query($conn, $query);

    for($i = 0;$row = mysqli_fetch_assoc($result);$i++){
        $query2 = "SELECT users.First_name,users.Last_name,city.name,user_phone.phone FROM users,city,user_phone WHERE users.ID = '$row[dealer_id]' AND users.city_id = city.city_id AND users.ID = user_phone.user_id".$search;
        mysqli_query($conn, $query2) or die("Error in query 1");
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $output[0][$i] = $row2['First_name']." ".$row2['Last_name'];
        $output[1][$i] = $row2['name'];

        $query3 = "SELECT Maturity_D,active FROM bills WHERE dealer_id = '$row[dealer_id]' AND company_id = '$_SESSION[com_id]'";
        mysqli_query($conn, $query3) or die("Error in query 1");
        $result3 = mysqli_query($conn, $query3);

        $not_paid = 0;
        $finished = 0;
        $j = 0;
        for(;$row3 = mysqli_fetch_assoc($result3);$j++){
            $current_date = date("Y-m-d");
            $datetime1 = date_create($current_date);
            $datetime2 = date_create($row3['Maturity_D']);
            $interval = date_diff($datetime1, $datetime2);
            $d = $interval->format('%R%a');

            if((strpos($d, '+') !== false ) and $d !== "+0" and $row3['active'] == '1'){
                $not_paid +=1;
            }
            else{
                $finished +=1;
            }
        }
        $output[2][$i] = $j;
        $output[3][$i] = $not_paid;
        $output[4][$i] = $finished;
        $output[5][$i] = $row2['phone'];
    }
    return $output;
}

if(isset($_POST['search'])){
    $search_word = "";
    if($_POST['word'] != ""){
        $search_word = " AND ( (users.First_name LIKE '%$_POST[word]%' OR users.Last_name LIKE '%$_POST[word]%') OR (users.First_name + ' ' + users.Last_name) = '$_POST[word]')";
    }

    $search_query = "SELECT DISTINCT dealer_id FROM bills WHERE company_id = '$_SESSION[com_id]'";

    $output = search($conn,$search_query,$search_word);
}