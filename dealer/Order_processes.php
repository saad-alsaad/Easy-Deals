<?php
include "db.php";
$output = array();
$search_output = array();
$search_flag = 0;

$query1 = "SELECT * FROM orders WHERE dealer_id = '$_SESSION[id]'";
$output = search($conn,$query1);
function search($conn,$query){
    $output = array();
    mysqli_query($conn, $query) or die('Error querying database 1');
    $res = mysqli_query($conn, $query);
$k = 0;
while ($r1 = mysqli_fetch_assoc($res)){
    if($r1['status'] == '0')
        $output[0][$k] = "لـم يـتـم الـرد";
    elseif($r1['status'] == '1')
        $output[0][$k] = "تـم الـمـوافـقـة";
    elseif ($r1['status'] == '2')
        $output[0][$k] = "تـم الـرفـض";

    $output[1][$k] = $r1['Date_time'];
    $output[1][$k] = str_replace(' '," -- ",$output[1][$k]);

    $query66 = "SELECT name FROM company WHERE company_id = ".$r1['Company_id'];
    mysqli_query($conn, $query66) or die('Error querying database 3');
    $res66 = mysqli_query($conn, $query66);
    while ($res67 = mysqli_fetch_assoc($res66))
    $output[2][$k] = $res67['name'];

    if($r1['payment_type'] == '0'){
        $output[12][$k] = "كــاش";
    }
    elseif ($r1['payment_type'] == '1'){
        $output[12][$k] = "شــيــك";
    }
    elseif ($r1['payment_type'] == '2'){
        $output[12][$k] = "تــقــســيــط";
    }

    $query3 = "SELECT * FROM order_details WHERE order_id = ".$r1['order_id'];
    mysqli_query($conn, $query3) or die('Error querying database 3');
    $res2 = mysqli_query($conn, $query3);
    $output[15][$k] = 0;
    $total = 0;
    for($t = 0;$r3 = mysqli_fetch_assoc($res2);$t++){
        $output[3][$k][$t] = $r3['goods_q'];

        $query4 = "SELECT good_id,available_q,Name,good_details, price, Sold_q FROM goods WHERE good_id = ".$r3['good_id'];

        mysqli_query($conn, $query4) or die('Error querying database 4');
        $res3 = mysqli_query($conn, $query4);
        $r4 = mysqli_fetch_assoc($res3);
        $output[14][$k][$t] = 0;
        $output[4][$k][$t] = $r4['Name'];
        $output[7][$k][$t] = $r4['good_details'];
        $output[8][$k][$t] = $r4['price'] * $r3['goods_q'];
        $total += (double)$output[8][$k][$t];
        $output[13][$k][$t] = $r4['good_id'];
        $output[16][$k][$t] = $r4['available_q'];
        $output[17][$k][$t] = $r4['Sold_q'];
        if(((int)$r4['available_q']) < ((int) $output[3][$k][$t])){
            $output[14][$k][$t] = 1;
            $output[15][$k] = 1;
        }
    }
    $output[11][$k] = $total."";

    $k++;}
    return $output;
}

if(isset($_POST['search'])){
    $word = '';

    if($_POST['search_word'] != ""){
        $word = " AND company.name LIKE '$_POST[search_word]'";
    }

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
        $payment_type = " AND orders.payment_type = '$_POST[payment_type]'";
    }
    else
        $payment_type = "";

    $query1 = "SELECT * FROM orders,company WHERE dealer_id = '$_SESSION[id]' AND company.company_id = orders.Company_id".$word.$payment_type;
    $output = search($conn,$query1);
}
if(isset($_POST['add_new'])){
    $good=$_POST['good'];
    $com=$_POST['com'];
    $q=$_POST['q'];
    $pay= (int) $_POST['payment_type'];
  $que="select company_id from company where name='$com'";
    mysqli_query($conn,$que) or die("error");
    $z=mysqli_query($conn,$que);
   while($r=mysqli_fetch_assoc($z))
       $cc= (int) $r['company_id'];
       
    $ccc= (int) $_SESSION['id'];
   $quer="INSERT INTO orders(Company_id,dealer_id,status,Date_time,payment_type) VALUES($cc,$ccc,0,NOW(),0)";
    if(mysqli_query($conn,$quer)){
        echo "done";
    }
    else{
        echo "error";
    }
    $quer1="select good_id from goods where Name='$good'";
    $zzz=mysqli_query($conn,$quer1);
    while($zzzz = mysqli_fetch_assoc($zzz))
    $zed=$zzzz['good_id'];
    $a="select order_id from orders WHERE Company_id=$cc AND dealer_id=$ccc ";
    $b=mysqli_query($conn,$a);
    while($c = mysqli_fetch_array($b)) 
    $bn=$c['order_id'];
    $quer2="insert into order_details VALUES($bn,$q,$zed)";
    mysqli_query($conn,$quer2);
}
?>