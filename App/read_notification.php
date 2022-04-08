<?php
    require "../db.php";
    $output = array();
    $full_name = "";
    $ID = $_POST['ID'];
    if($ID != ""){
    $query = "SELECT notification.notification_id, notification.sender_id,notification.Message,notification.type,notification.sent_time FROM notification,users WHERE notification.receiver_id = '$ID' AND notification.type != 0 AND users.ID = notification.sender_id ORDER BY notification.notification_id DESC";
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

            $message = $row['Message'];

            $output[$i] =array("not_id"=>$row['notification_id'],"sender"=>$full_name,"message"=>$message,"sent_time"=>$row['sent_time']);
            $i++;
        }
    }
    else
    {
        array_push($output,array("لا يوجد نتائج"));;
    }

        $update_query = "UPDATE notification SET status=1 WHERE status=0 AND type != 0 AND receiver_id = 'ID'";
        mysqli_query($conn, $update_query);

     $data = array('notification' => $output);

   echo json_encode($data,JSON_UNESCAPED_UNICODE);
}
?>