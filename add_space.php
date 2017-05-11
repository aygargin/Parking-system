<?php
 mysql_connect("localhost","root","");
 mysql_select_db("parking_system");
 ?>


<html>
<link href="style1.css" rel="stylesheet" type="text/css">
<body>
<form method="post" enctype="multipart/form-data">
<h3>SPACE INFO</h3>
 <table align="center" cellpadding = "10">
 
 <td>SPACE ID</td>
 <td><input type="text" name="name" maxlength="30" required >
 (max 30 characters)
 </td>
 </tr>
 
 <tr>
 <td>STATUS</td>
  <td><input type="text" name="code" maxlength="2" required>
  (only 0/1)
 </tr>
 
 </td>
 </tr>
 
 <tr>
 <td colspan="2" align="center">
 <input type="submit" class="btnLogin" name="go" value="SAVE">
 <input type="reset" class="btnLogin" value="Reset">
 </td>
 </tr>

 </table>
 
 <h4 class="td_bottom"><br>© e-Parking-2016, Developed by : Ayush Garg</h4> 
 </form> 
 </body>
 </html>
 
 
 <?php
  extract($_POST);
 session_start();
 $id=$_SESSION['adm_name'];

 if($id!="zhcet")
 header("location:admin_login.php");

 if(isset($_POST['go']))
 {
	 $a=mysql_num_rows(mysql_query("select space_id from space_db where space_id='$name' "));
	 if($a==0)
	 {
	 $q=mysql_query("insert into space_db (space_id,status) values ('$name','$code')");
	 if($q)
	 {
		 header("location:manage_parking_adm.php");
	 }
	 }
	 else
	 echo"space with this code already exists";
 	}	

 
 