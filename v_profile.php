<?php
 mysql_connect("localhost","root","");
 mysql_select_db("parking_system");
 ?>
<style>
#profile
{
	position:absolute;
	top:auto;
	float:right;
	color:#CCC;
	font-size:30%;
	top:14%;
	right:7%;
}
#profile_photo
{	
	position:absolute;
	top:auto;
	float:right;
	top:8%;
	right:3%;
}
</style>


<?php
session_start();
$user=$_SESSION['user'];
$photo=$_SESSION['photo'];
if($user==""){
header("location:index.php");
}
else{
$name=$_SESSION['name'];?>

<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <link href="style1.css" rel="stylesheet" type="text/css">
   <script src="jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>User Profile</title>
</head>
<body>
<form>
<div id='cssmenu'>
<ul>
   <li class='active'><a href="v_profile.php"><span>User Profile</span></a></li>
   <li><a href="find_space.php"><span>Find Parking</span></a></li>
   <li><a href="user_track.php"><span>My Trackrecord</span></a></li>
   
   <div id="profile"><?php echo"<li><span>$name &nbsp;</span></li>";?></div>
  	
    <script src="lightbox2-master/jquery2.js"> </script>
	<script src="lightbox2-master/dist/js/lightbox.js"></script>
	<link href="lightbox2-master/dist/css/lightbox.css" rel="stylesheet">

   <div id="profile_photo"><li><span><a href="v_uploads/<?php echo $photo; ?>" data-lightbox="profile_pic">
   <img src="v_uploads/<?php echo $photo ?>" width="50px" height="50px" id="profile_photo"></a></span></li></div>
  
   <li class='last'><a href="logout.php"><span>Logout</span></a></li>
</ul>
</div>
<form name="form" method="post" enctype="multipart/form-data">
<h3>WELCOME</h3>
 <table align="center" cellpadding = "10">
 <tr>
 <td>NAME:</td>
 <td><?php echo $name?></td>
 </tr>
 
 <tr>
 <td>Vehicle Id:</td>
 <td><?php echo $user?></td>
 </tr>
 
	<?php 
	
	  $p=mysql_query("select * from reservation_db where vehicle_id='$user' order by s_no desc");
	  $q=mysql_num_rows($p);
	  $s=mysql_fetch_array($p);
	  if($q>0)
	  {?>
      <tr><td>Your vehicle parked at:</td>
		<td><?php echo $s['space_id'];?></td></tr>
		<tr><td>Fare: </td>
		<td><?php echo '₹'. $s['fare']; ?></td></tr>
	 <?php }else{?>  
     <tr><td><?php
		  echo 'You have not parked your vehicle';}?></td></tr>
    
	<?php
	  $p=mysql_query("select * from space_db where status='0'");
	  $q=mysql_num_rows($p);
	  if($q>0){?>
      <tr><td><?php
		  echo 'Space Available to park your vehicle!';?></td></tr>
          <?php
	  }else{?>
          <tr><td><?php
		  echo 'No parking space';}?></td></tr>

 </table>  
  <h4 class="td_bottom"><br>© e-Parking-2016, Developed by : Ayush Garg</h4>
 </form>
</body>
</html>

<?php

}
?>
