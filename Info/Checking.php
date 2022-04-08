<?php
if(!empty($_SERVER["HTTP_CLIENT_IP"])){
    $IP = $_SERVER["HTTP_CLIENT_IP"];
}
else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
    $IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else{
    $IP = $_SERVER["REMOTE_ADDR"];
}

$sql = "INSERT INTO visitors (ip, Date_time, mac) VALUES ('$IP',NOW(),'Not found')";

if(!mysqli_query($conn,$sql)){
    echo "problem";
}
?>