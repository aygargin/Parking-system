<?php
 mysql_connect("localhost","root","");
 mysql_select_db("parking_system");
 ?>

<html>
<title>Delete Parking</title>
<link href="style1.css" rel="stylesheet" type="text/css">
<body>
<form name="form" method="post" enctype="multipart/form-data" onSubmit="return(validate());">
<h3>PARKING INFO</h3>
 <table align="center" cellpadding = "10">
  
 <td>Vehicle ID</td>
 <td><input type="text" name="name" maxlength="30" required >
 (max 30 characters)
 </td>
 </tr>
  
  <tr>
 <td>Space ID</td>
  <td>
  <?php
  extract($_REQUEST);
  $q=mysql_query("select space_id from space_db where status='1' && space_id='$del'");
  $r=mysql_num_rows($q);
	  $f=mysql_fetch_array($q);
 		echo $f['space_id'];
?>
  </tr>
  
  <tr>
 <td>Exit Time</td>
  <td><input type="text" name="dur2" maxlength="30" required  placeholder="date and time">
 </tr>
 
  <tr>
 <td>Fare</td>
 <td><input type="number" name="fare" maxlength="10" required  placeholder="amount in rupees"></td>
 </tr>
 
 <script>
 function validate()
 {
	  var a=document.form.go.value;
	 
	  if(a!=""||a!=null)
	 {
		 alert("Vehicle removed successfully.");
		 return true;
	 }	 
 }
 </script>
 
 <tr>
 <td colspan="2" align="center">
 <input type="submit" class="btnLogin" name="go" value="SAVE">
 <input type="reset" class="btnLogin" value="Reset" tabindex="7">
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
 $id=$_SESSION['guard_user'];

 if($id=="")
 header("location:index.php");

 if(isset($_POST['go']))
 {  
	$q1=mysql_query("select MAX(s_no) from reservation_db where vehicle_id='$name'");
    $f1=mysql_fetch_array($q1);
    $sno = $f1['MAX(s_no)']; 
 
	$sub=$f['space_id']; 
	$qq=mysql_query("update reservation_db set exit_time='$dur2', fare='$fare' where space_id='$sub' && vehicle_id='$name' && s_no='$sno'");
	$q=mysql_query("update space_db set status='0' where space_id='$sub'");
	 
	 if($qq && $q)
	 {
		 header("location:manage_parking.php");
	 }
 }
 ?>