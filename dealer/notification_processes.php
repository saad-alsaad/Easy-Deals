<?php
include "db.php";
$output = array();
$dealers = array();
$sending_flag = 0;

        $q = "SELECT users.First_name, users.Last_name,users.ID FROM users,top_manager,financial_manager WHERE users.ID = financial_manager.user_id OR users.ID = top_manager.user_id GROUP BY users.ID";
        mysqli_query($conn, $q) or die('Error querying database 2');
        $result = mysqli_query($conn, $q);

        for($i = 0; $r1 = mysqli_fetch_assoc($result);$i++){
        $dealers[0][$i] = $r1['ID'];
        $dealers[1][$i] = $r1['First_name'].' '.$r1['Last_name'];
    }


function manager_search($conn,$query){
    $out = array();
    mysqli_query($conn, $query) or die('Error querying database 1');

    $result = mysqli_query($conn, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $out[$i] = $row['ID'];
        $i++;
    }
    return $out;
}
$query = "SELECT notification.sender_id, notification.receiver_id, notification.type, notification.sent_time, notification.Message, users.ID,users.First_name,users.Last_name FROM notification,users WHERE notification.receiver_id = '$_SESSION[id]' AND users.ID = notification.sender_id";
$output = not_search($conn,$query);
function not_search($conn,$query){
    $output = array();
    $i = 0;
    mysqli_query($conn, $query) or die('Error querying database.');
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {
        $output[0][$i] = $row['sent_time'];
        $output[0][$i] = str_replace(' '," -- ",$output[0][$i]);
        $output[1][$i] = $row['Message'];
        $output[2][$i] = $row['First_name'].' '. $row['Last_name'];
        $output[3][$i] = $row['type'];
        $i++;
    }

    return $output;
}



if(isset($_POST['send'])){
    if($_POST[type] != ""){
        $q = "INSERT INTO notification (sender_id, receiver_id, Message, sent_time, type, status) VALUES ('$_SESSION[id]','$_POST[type]','$_POST[message]',NOW(),0,0)";
        if(mysqli_query($conn, $q))
            $_SESSION['not_flag'] = "3";
        else
            $_SESSION['not_flag'] = "2";
    }
    else{
        $_SESSION['not_flag'] = "1";
    }
    header("Location: Notifications.php");
    exit();
}

if(isset($_POST['search'])){
    $search_word = "";
    $type = " AND notification.type = 0";
    if($_POST['search_word'] != ""){
        $search_word = " AND ((users.First_name LIKE '%$_POST[search_word]%') OR (users.Last_name LIKE '%$_POST[search_word]%') OR (CONCAT(users.First_name,' ',users.Last_name) LIKE '%$_POST[search_word]%'))";
    }

    if($_POST['type'] == "0"){
        $type = " AND notification.type = 0";
        $_SESSION['type_0'] = "selected";
    }
    elseif ($_POST['type'] == "1"){
        $type = " AND notification.type = 1";
        $search_word = "";
        $_SESSION['type_1'] = "selected";
    }
    elseif ($_POST['type'] == "3"){
        $type = " AND notification.type = 3";
        $search_word = "";
        $_SESSION['type_3'] = "selected";
    }

    $search_query = "SELECT notification.sender_id, notification.receiver_id, notification.type, notification.sent_time, notification.Message, users.ID,users.First_name,users.Last_name FROM notification,users WHERE notification.receiver_id = $_SESSION[id] AND users.ID = notification.sender_id".$type.$search_word;

    $output = not_search($conn,$search_query);
}
?>