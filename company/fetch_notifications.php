<?php
include "../db.php";
session_start();

if(!empty($_REQUEST['q']) && !preg_match('/^[ ]{1,20}$/',$_REQUEST['q'])) {

    $word = $_REQUEST['q'];
    $query1 = "SELECT notification.sender_id, users.First_name,users.Last_name FROM notification,users WHERE notification.receiver_id = $_SESSION[id] AND users.ID = notification.sender_id AND ( (users.First_name LIKE '%$word%' OR users.Last_name LIKE '%$word%') OR (users.First_name + ' ' + users.Last_name) = '$word') GROUP BY notification.sender_id";
    $result = mysqli_query($conn, $query1);

    while($row = mysqli_fetch_assoc($result)){

        $name = $row['First_name']." ".$row['Last_name'];
        echo '<option onclick="add_word(this.value)">'.$name.'</option>';
    }
}