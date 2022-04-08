<?php
include "../db.php";
$sending_flag = array();
$ID = $_POST['ID'];
$ID2 = $_POST['ID2'];
$message = $_POST['message'];

if($ID != "" && $ID2 != "" && $message != ""){
    $q = "INSERT INTO notification (sender_id, receiver_id, Message, sent_time, type, status) VALUES ('$ID','$ID2','$message',NOW(),0,0)";
    if(!mysqli_query($conn, $q)){
        $sending_flag = array("flag"=>"1");
    }
    else{
    	$sending_flag = array("flag"=>"9");
    }

    echo json_encode(array("sending_flag"=>$sending_flag),JSON_UNESCAPED_UNICODE);
}
?>