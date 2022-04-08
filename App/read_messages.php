<?php
    require "../db.php";
    $output = array();
    $full_name = "";
    $ID = $_POST['ID'];
    if($ID != ""){
    $query = "SELECT notification.sender_id,notification.Message,users.First_name,users.Last_name FROM notification,users WHERE notification.receiver_id = '$ID' AND notification.type = 0 AND users.ID = notification.sender_id GROUP BY  notification.sender_id DESC";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $i = 0;
        while($row = mysqli_fetch_array($result))
        {
            $message = $row['Message'];
            $full_name = $row['First_name']." ".$row['Last_name'];
            $output[$i] =array("sender_id"=>$row['sender_id'],"sender"=>$full_name,"message"=>$message);
            $i++;
        }
    }
    else
    {
        array_push($output,array("لا يوجد نتائج"));;
    }

     $data = array('notification' => $output);

   echo json_encode($data,JSON_UNESCAPED_UNICODE);
}
?>