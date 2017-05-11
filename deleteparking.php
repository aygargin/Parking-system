<?php
mysql_connect("localhost" ,"root", "");
mysql_select_db("parking_system");
session_start();
$id=$_SESSION['adm_name'];
if($id=="")
header("location:index.php");

	extract($_GET);
	
	if($ch==1)
	{
		if($id!="zhcet")
		header("location:admin_login.php");
	$qq=mysql_fetch_array(mysql_query("select status from space_db where space_id='$del'"));
	$stat=$qq['status'];
	if($stat==0)
	{		
	$q=mysql_query("delete from space_db where space_id='$del'");
	if($q)
	{
		header("location:manage_parking_adm.php");
	}
	}
	else
	{header("location:manage_parking_adm.php");
		}
	}
?>