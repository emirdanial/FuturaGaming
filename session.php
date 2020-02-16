<?php
include_once 'database.php';
session_start();
$sid=$_SESSION['fld_staff_num'];

$stmt= $conn->prepare("SELECT * FROM tbl_staffs_a159753_pt2 WHERE fld_staff_num=$sid");

$stmt->execute();

$readrow=$stmt->fecth(PDO:FETCH_ASSOC);

$name=$readrow['fld_staff_name'];

if($sid==''){
	header("location:index_login.php?login");
}
else{
	header("");
}

?>


