<?php
session_start();

if(isset($_GET["view"]))
{
    require "../db.php";
    $output = array();
    $order_count = 0;
    $reminder_count = 0;
    $bill_count = 0;
    $message_count = 0;
    

    if($_GET["view"] != '')
    {
        $update_query = "UPDATE notification SET status=1 WHERE status=0 AND receiver_id = '$_SESSION[id]'";
        mysqli_query($conn, $update_query);
    }

    $query = "SELECT notification.notification_id, notification.sender_id,notification.Message,SUBSTRING(notification.Message,1,50),notification.type,users.First_name,users.Last_name FROM notification,users WHERE notification.receiver_id = '$_SESSION[id]' AND users.ID = notification.sender_id ORDER BY notification.notification_id DESC  LIMIT 6 ";
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

            $output[$i]= '
   <li style="background-color: #FCFDFF;">
    <a href="Notifications.php">
     <strong>' .$full_name.'</strong><br />
     <small ><em>'.$message.'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
            $i++;
        }
    }
    else
    {
        $output[0] = '<li><a href="Notifications.php" class="text-bold text-italic">لا يـوجـد إشــعارات</a></li>';
    }

    $final_result = "";
    $query_1 = "SELECT type FROM notification WHERE status=0 AND receiver_id = '$_SESSION[id]'";
    $result_1 = mysqli_query($conn, $query_1);
    $count = mysqli_num_rows($result_1);

    while ($row1 = mysqli_fetch_assoc($result_1)){
        if($row1['type'] == '3'){
            $reminder_count++;
        }
        elseif($row1['type'] == '2'){
            $bill_count++;
        }
        elseif($row1['type'] == '1'){
            $order_count++;
        }
        elseif ($row1['type'] == '0'){
            $message_count++;
        }
    }

     for($k = 0; $k < count($output); $k++)
         $final_result .= $output[$k];
     //$data = $final_result;

     $data = array(
         'notification'   => $final_result,
         'unseen_notification' => $count,
         'unseen_orders' => $order_count,
         'unseen_bills' => $bill_count,
         'unseen_reminders' => $reminder_count,
         'unseen_message' => $message_count
     );

   echo json_encode($data);
}
?>