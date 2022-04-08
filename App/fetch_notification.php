<?php

    require "../db.php";
    $output = array();
    $full_name = "";
    $ID = $_POST['ID'];
    if($ID != ""){
    $query = "SELECT notification.notification_id, notification.sender_id,notification.Message,SUBSTRING(notification.Message,1,50),notification.type,users.First_name,users.Last_name FROM notification,users WHERE notification.receiver_id = '$ID' AND notification.status=0 AND users.ID = notification.sender_id ORDER BY notification.notification_id DESC LIMIT 6";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $i = 0;
        while($row = mysqli_fetch_array($result))
        {
            $message = "";
            if($row['type'] === '3'){
                $full_name = "رسـالـة تـذكـيـر";
            }
            elseif($row['type'] === '2'){
                $full_name = "فاتورة جديدة";
            }
            elseif($row['type'] === '1'){
                $full_name = "طـلـب جـديـد";
            }
            elseif ($row['type'] === '0'){
                $full_name = "مــن : ".$row['First_name'].' '. $row['Last_name'];
            }

            $message = $row['SUBSTRING(notification.Message,1,50)'];

            $output[$i] =array("not_id"=>$row['notification_id'],"sender"=>$full_name,"message"=>$message);
            $i++;
        }
    }
    else
    {
        array_push($output,array("not found"));;
    }

     $data = array('notification' => $output);

   echo json_encode($data,JSON_UNESCAPED_UNICODE);
}
?>