<?php
include "../db.php";

if (mysqli_connect_errno($conn)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$response_array = array();
$username = $_POST['username'];
$password = $_POST['password'];
if($username != "" && $password != ""){
	$query = "SELECT ID, First_name, Last_name, User_type, Password, Email FROM users WHERE Username = '$username'";
	$result = mysqli_query($conn,$query);

	if(mysqli_num_rows($result) > 0){
	    $row = mysqli_fetch_assoc($result);
	    if(password_verify($password,$row["Password"])){
	    		array_push($response_array, array("ID"=>$row['ID'],"First_name"=>$row['First_name'],"Last_name"=>$row['Last_name'],"User_type"=>$row['User_type'],"Email"=>$row['Email']));
	    }
	    else{
		array_push($response_array,array("2"));
		}
	}
	else{
		array_push($response_array,array("1"));
	}
	echo json_encode(array(""=>$response_array),JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);
?>