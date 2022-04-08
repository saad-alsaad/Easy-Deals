<?php
$user_id = $_SESSION['id'];

include "db.php";

$output = array();

if (isset($_POST['search'])){
    $output = array();
    $search = $_POST['search_word'];
    $output = search($conn,"SELECT * FROM goods WHERE Name LIKE '%$search%'");
}


if (isset($_POST['ord'])) {
    if($_POST['payment_type']!=""){
 if($_SESSION['c'] != 0){
     $flag = 0;
    $pay = (int)$_POST['payment_type'];
    $t = 0;
    while($t < $_SESSION['c']){
        if($_SESSION['company'][$t] != "")
            break;
        $t++;
    }
    $company = $_SESSION['company'][$t];


    for($j = $t;$j < $_SESSION['c'];$j++){
        echo $_SESSION['company'][$j]."<br>";
           if($_SESSION['company'][$j] != $company && $_SESSION['company'][$j] != ""){
               $flag = 1;
               break;
           }
    }
    echo $flag;
    $counter  = 0;
    for($r = 0; $r < $_SESSION['c'] ; $r++){
        if($_SESSION['gid'][$r] != ""){
            $counter++;
        }
    }

    $q = array();
    for($j = 0,$h=0;$j < $_SESSION['c'];$j++){
            if($_POST[$j] != ""){
                $q[$h] = $_POST[$j];
                $h++;
            }
    }

    if(count($q) != $counter){
        $flag = 2;
    }

    if ($flag == 0) {
        $goods = array();
        for($i = 0,$j=0; $i < (int)$_SESSION['c'] ; $i++){
            if($_SESSION['gid'][$i] !=''){
                $goods[0][$j] = $_SESSION['gid'][$i];
                $j++;
            }
        }
        $gg=$company;
        $que11 = "select company_id from company where name= '$gg' ";
        mysqli_query($conn, $que11) or die("error");
        $g = mysqli_query($conn, $que11);
        while ($r9 = mysqli_fetch_assoc($g))
            $cc1 = (int)$r9['company_id'];

        $ccc = (int) $_SESSION['id'];
        $querr = "INSERT INTO orders(Company_id,dealer_id,status,Date_time,payment_type) VALUES ($cc1,$ccc,0,NOW(),$pay)";
        mysqli_query($conn,$querr) or die("erro");
        for($i=0;$i<count($goods[0]); $i++){

            $b=$goods[0][$i];
            $quantity=$q[$i];

            $aa="select order_id from orders WHERE Company_id=$cc1 AND dealer_id=$ccc AND Date_time=NOW()";
            mysqli_query($conn,$aa) or die("ho");
            $bb=mysqli_query($conn,$aa);
            while($aaa = mysqli_fetch_array($bb))
                $bn=$aaa['order_id'];
            $quer2="insert into order_details (order_id, goods_q, good_id) VALUES($bn,$quantity,$b)";

            if(!mysqli_query($conn,$quer2)) {
                header("Location: cart.php");

                $_SESSION['cart_feedback'] = "6";
            $qoo="DELETE FROM orders WHERE Company_id=$cc1 AND dealer_id=$ccc AND Date_time=NOW()";
            mysqli_query($conn,$qoo);
                exit();
            }
        }

        $query2 = "SELECT user_id FROM top_manager WHERE company_id = '$cc1'";
        $result2 = mysqli_query($conn,$query2);
        $row2 = mysqli_fetch_assoc($result2);

        $not_message = "لديك طلب جديد من ".$_SESSION['f_name']." ".$_SESSION['l_name'];
        $not_query = "INSERT INTO notification (sent_time, type, Message, receiver_id, sender_id, status) VALUES (NOW(),1,'$not_message','$row2[user_id]','$_SESSION[id]',0)";
        mysqli_query($conn,$not_query);

        for($j=0;$j < (int)$_SESSION['c']; $j++){
                $_SESSION['gud'][$j]='';
                $_SESSION['price'][$j]='';
                $_SESSION['company'][$j]='';
                $_SESSION['gid'][$j]='';
        }
        $_SESSION['cart_feedback'] = "1";
    }
    else if($flag == 1){
        $_SESSION['cart_feedback'] = "2";
    }
    else if($flag == 2){
        $_SESSION['cart_feedback'] = "3";
    }
 }else{
     $_SESSION['cart_feedback'] = "4";
 }
    header("Location: cart.php");
    exit();
} else{

        $_SESSION['cart_feedback'] = "5";
    } 
}



if (isset($_POST['remove'])){
    $_SESSION['gud'] = '';
    $_SESSION['price'] = '';
    $_SESSION['company'] = '';
    $_SESSION['c'] = 0;
    $_SESSION['cid']='';
    $_SESSION['gid']='';

 }


for($j=0;$j < $_SESSION['c']; $j++){
if (isset($_POST['remove'.$j]))
{
    $_SESSION['gud'][$j] = "";
    $_SESSION['price'][$j] = "";
    $_SESSION['company'][$j] = "";
    $_SESSION['gid'][$j] = '';
} }
?>
