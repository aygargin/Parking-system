<?php
mysql_connect("localhost" ,"root", "");
mysql_select_db("parking_system");
session_start();
$id=$_SESSION['adm_name'];
if($id!="zhcet")
header("location:admin_login.php");

	extract($_GET);
	if($check==0)
	{
	$qry=mysql_query("update guard_db set status='0' where '$stat'=guard_id");
	 if($qry)
	 header("location:admin_manage_guard.php");
	}
	else if($check==1)
	{
	$qry=mysql_query("update guard_db set status='1' where '$stat'=guard_id");
	 if($qry)
	 header("location:admin_manage_guard.php");
	}
	
	 
?>
	


