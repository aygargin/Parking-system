<?php
mysql_connect("localhost" ,"root", "");
mysql_select_db("parking_system");
session_start();
$id=$_SESSION['adm_name'];
if($id!="zhcet")
header("location:admin_login.php");

	extract($_GET);
	$f=mysql_fetch_array(mysql_query("select photo from user_db where s_no='$del'"));
	$old_pic=$f['photo'];
		unlink("v_uploads/$old_pic") ;
	$q=mysql_query("delete from user_db where s_no='$del'");
	
	if($q)
	{
		header("location:admin_manage_user.php");
	}
?>