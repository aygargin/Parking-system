<?php
mysql_connect("localhost" ,"root", "");
mysql_select_db("parking_system");
session_start();
$id=$_SESSION['adm_name'];
if($id!="zhcet")
header("location:admin_login.php");

	extract($_GET);
	$f=mysql_fetch_array(mysql_query("select guard_photo from guardulty_db where guard_id='$del'"));
	$old_pic=$f['guard_photo'];
		unlink("guard_uploads/$old_pic") ;
	$q=mysql_query("delete from guard_db where guard_id='$del'");
	
	if($q)
	{
		header("location:admin_manage_guard.php");
	}
?>