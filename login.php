<?php
include_once 'database.php';

$stmt=$conn->prepare("SELECT * FROM tbl_staffs_a159753_pt2 WHERE fld_staff_num=sid AND fld_staff_password");

$stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
$stmt->bindParam(':spassword',$spassword,PDO::PARAM_STR);

$sid=$_POST['sid'];
$spassword=$_POST['spassword'];

$stmt->execute();
$result=$stmt->fecthAll();
$bil_row=$stmt->rowCount();

if($bil_row >0)
{
	session_start();
	$_SESSION['fld_staff_num']=$sid;
	header("location:index.php");
}
else
{
	header("location:index_login.php?login-failed");
}
}
