<?php
$user_id = $_SESSION['id'];
include "db.php";

global $addition_flag;
$addition_flag = 0;

$output = array();

$output = search($conn,"SELECT * FROM goods WHERE available_q > 0");
$types = array();
$q = "SELECT * FROM company_good_type";
mysqli_query($conn, $q) or die('Error querying database.');
$res = mysqli_query($conn, $q);
$k = 0;
while ($r1 = mysqli_fetch_assoc($res)){
    $type_ids[$k] = $r1['type_id'];
    $q1 = "SELECT * FROM goods_types WHERE type_id = ".$r1['type_id'];
    mysqli_query($conn, $q1) or die('Error querying database.');
    $res1 = mysqli_query($conn, $q1);
    $r2 = mysqli_fetch_assoc($res1);
    $types[$k] = $r2['name'];
    $k++;
}

function search($conn,$query){
    $output = array();

    mysqli_query($conn, $query) or die('Error querying database.');

    $result = mysqli_query($conn, $query);

    for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {

        $aa="select name from company WHERE company_id=".$row['company_id'];
        $bc=mysqli_query($conn,$aa);
        while($r=mysqli_fetch_array($bc))
            $output[0][$i] = $r['name'];
        $type_id = $row['good_type_id'];
        $output[1][$i] = $row['price'];
        $output[2][$i] = $row['available_q'];
        $output[3][$i] = $row['Name'];
        $output[4][$i] = $row['good_details'];
        $query2 = "SELECT name FROM goods_types WHERE type_id = ".$type_id;
        mysqli_query($conn, $query2) or die('Error querying database.');
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);

    }
    return $output;
}

if (isset($_POST['search'])){
    $output = array();
    $search = $_POST['search_word'];
    $good_type = "";
    $sort = "";
    if($_POST['good_type'] != ""){
        $good_type = " AND good_type_id = '$_POST[good_type]'";
        $_SESSION[$_POST['good_type']] = "selected";
    }

    if($_POST['sort'] == "2"){
        $sort = " ORDER BY available_q";
        $_SESSION['good_q'] = "selected";
    }
    else{
        $_SESSION['good_date'] = "selected";
    }

    $output = search($conn,"SELECT * FROM goods WHERE  Name LIKE '%$search%'".$good_type.$sort);
}

if (isset($_POST['add1'])){

    $a=$_POST['a'] ;
    $b=$_POST['b'] ;
    $d=$_POST['d'] ;

        $quer = "select good_id from goods where Name= '$a' ";
        mysqli_query($conn, $quer) or die("error");
        $zz = mysqli_query($conn, $quer);
        while ($r1 = mysqli_fetch_assoc($zz))
            $ccc = (int)$r1['good_id'];
        $_SESSION['gid'][$_SESSION['c']] = $ccc;
        $_SESSION['gud'][$_SESSION['c']] = $a;
        $_SESSION['price'][$_SESSION['c']] = $b;
        $_SESSION['company'][$_SESSION['c']] = $d;
        $_SESSION['c']++;
    $_SESSION['good_feedback'] = "1";
}

?>