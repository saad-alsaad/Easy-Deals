<?php
send_email("Easy Deals <mail@foreasydeals.com>","saadalsaad00@gmail.com","Test","test test test test");


function send_email($from,$to,$subject,$message){
    $headers = "From : $from\r\n";
    $headers .= "Content-type: text/html\r\n";
    mail($to,$subject,$message,$headers);
}
?>