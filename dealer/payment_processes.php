<?php
include "db.php";
$output = array();
$dir = "../vouchers_img/";
$target_file = $dir . basename($_FILES["up_img"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$query = "SELECT payments.dealer_id,payments.amount,payments.Date,payments.type,payments.Bill_id,bills.Bill_id,payments.voucher_img,company.name FROM payments,bills,company WHERE bills.Bill_id = payments.Bill_id AND company.company_id = bills.company_id AND payments.dealer_id = '$_SESSION[id]' ";
$output = search($conn,$query);
$dealers_ids = manager_search($conn,"SELECT Bill_id FROM bills WHERE  dealer_id = ".$_SESSION['id']);

if($dealers_ids){
    for($i = 0; $i < count($dealers_ids);$i++){
        $q = "SELECT Bill_id FROM bills WHERE Bill_id = ".$dealers_ids[$i];
        mysqli_query($conn, $q) or die('Error querying database 2');
        $result = mysqli_query($conn, $q);
        $r1 = mysqli_fetch_assoc($result);
        $dealers[0][$i] = $dealers_ids[$i];
        $dealers[1][$i] = $r1['Bill_id'];
    }
}
function manager_search($conn,$query1){
    $out = array();
    mysqli_query($conn, $query1) or die('Error querying database 1');

    $result = mysqli_query($conn, $query1);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $out[$i] = $row['Bill_id'];
        $i++;
    }
    return $out;
}
function search ($conn,$query){
    $output = array();
    mysqli_query($conn, $query) or die("Error in query 1");
    $result = mysqli_query($conn, $query);

    for($i = 0;$row = mysqli_fetch_assoc($result);$i++){
        $output[0][$i] = $row['Bill_id'];
        $output[2][$i] = $row['amount'];
        $output[3][$i] = $row['Date'];
        $output[5][$i] = $row['voucher_img'];

        $output[6][$i] = $row['name'];
        if($row['type'] == '0')
            $output[4][$i] = "كـاش";
        elseif ($row['type'] == '1')
            $output[4][$i] = "شـيـك";
        elseif ($row['type'] == '2')
            $output[4][$i] = "تـقـسـيـط";
    }
    return $output;
}

if(isset($_POST['search'])){
    $payment_type = "";
    $sort = "";
    $search_word = "";

    if($_POST['word'] != "")
        $search_word = " AND company.name LIKE '%$_POST[word]%' ";

    if($_POST['payment_type'] != ""){
        if($_POST['payment_type'] == "0"){
            $_SESSION['type_0'] = "selected";
        }
        elseif ($_POST['payment_type'] == "1"){
            $_SESSION['type_1'] = "selected";
        }
        else{
            $_SESSION['type_2'] = "selected";
        }
        $payment_type = " AND payments.type = '$_POST[payment_type]'";
    }

    if($_POST['sort'] == "2"){
        $_SESSION['payment_amount'] = "selected";
        $sort = " ORDER BY payments.amount DESC";
    }
    else{
        $_SESSION['payment_date'] = "selected";
        $sort = " ORDER BY payments.Date DESC";
    }

    $search_query = "SELECT payments.dealer_id,payments.amount,payments.Date,payments.type,payments.Bill_id,bills.Bill_id,payments.voucher_img,company.name,company.company_id FROM payments,bills,company WHERE bills.Bill_id = payments.Bill_id AND payments.dealer_id = '$_SESSION[id]' AND company.company_id= bills.company_id ".$search_word.$payment_type.$sort;
    $output = search($conn,$search_query);
}
if(isset($_POST['add_new'])){
    $uploadOk = 0;
    $file_size = $_FILES['up_img']['size'];

    $ss = str_replace(".".$imageFileType,"",basename($_FILES["up_img"]["name"]));
    $random = rand(1,1000000)."";
    $target_file = $dir . $random.".".$imageFileType;
    while(file_exists($target_file)) {
        $ss = "";
        $ss = str_replace(".".$imageFileType,"",basename($_FILES["up_img"]["name"]));
        $random = rand(1,1000000)."";
        $target_file = $dir . $random.".".$imageFileType;
    }

    if($file_size > 5242880){
        $_SESSION['payment_feedback'] = 3;
        $uploadOk = 0;
    }
    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "PNG" && $imageFileType != "JPG"){
        $_SESSION['payment_feedback'] = 4;
        $uploadOk = 0;
    }
    else{
        if (move_uploaded_file($_FILES["up_img"]["tmp_name"], $target_file)) {
            $price = $_POST['good'];
            $p = $_POST['payment_type'];
            $id = $_POST['type'];
            $ccc= (int) $_SESSION['id'];
            $qq="insert into payments(dealer_id,Date,amount,Bill_id,type,voucher_img) values($ccc,NOW(),$price,$id,$p,'$target_file')";
            mysqli_query($conn,$qq);

            $qqq = "SELECT manager_id FROM bills WHERE Bill_id = '$id'";
            $id_result = mysqli_query($conn,$qqq);
            $id_row = mysqli_fetch_assoc($id_result);
            $message = "لـديـك دفـعـة جـدـيدة مـن ".$_SESSION['f_name']." ".$_SESSION['l_name']." وقـيـمـتـهـا  ".$price."\n"."رقـم الـفـاتـورة ".$id;
            $q = "INSERT INTO notification (sender_id, receiver_id, Message, sent_time, type, status) VALUES ('$_SESSION[id]','$id_row[manager_id]','$message',NOW(),0,0)";
            mysqli_query($conn,$q);
            
            $_SESSION['payment_feedback'] = 1;
        } else {
            $_SESSION['payment_feedback'] = 2;
        }
    }
    header("Location: Payments.php");
    exit();
}