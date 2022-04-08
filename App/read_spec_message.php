<?php
require "../db.php";
$output = array();
$full_name = "";
$ID = $_POST['ID'];
$ID2 = $_POST['ID2'];
if($ID != "" && $ID2 != ""){
    
    $query = "SELECT Message,sender_id FROM notification WHERE ((receiver_id = '$ID' AND sender_id = '$ID2') OR (receiver_id = '$ID2' AND sender_id = '$ID')) AND type = 0 ";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $i = 0;
        while($row = mysqli_fetch_array($result))
        {
            $message = $row['Message'];
            $output[$i] =array("sender_id"=>$row['sender_id'],"message"=>$message);
            $i++;
        }

        $update_query = "UPDATE notification SET status=1 WHERE status=0 AND type = 0 AND receiver_id = '$ID' AND sender_id = '$ID2'";
        mysqli_query($conn, $update_query);
    }
    else
    {
        array_push($output,array("لا يوجد نتائج"));
    }

    $data = array('notification' => $output);

    echo json_encode($data,JSON_UNESCAPED_UNICODE);
}
?>