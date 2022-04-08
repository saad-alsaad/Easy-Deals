<?php
$server = "localhost";
$password = "615807a76fe4+5=f_543%47!1c@#ddc123043361*29de1962c6b16a{c0d25a3f";
$username = "admin_easydeals";
$db = "admin_foreasydeals";

$conn = mysqli_connect($server,$username,$password,$db) or die('database error');
$sSQL= 'SET CHARACTER SET utf8';
mysqli_query($conn, $sSQL);
?>
