<style>
#profile
{
	position:absolute;
	top:auto;
	font-size:30%;
	float:right;
	color:#CCC;
	top:20%;
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
$id=$_SESSION['guard_user'];
$photo=$_SESSION['guard_photo'];
if($id=="")
header("location:index.php");
else
{
$name=$_SESSION['guard_name'];
?>
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
   <title>Guard Profile</title>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li class='active'><a href="guard_profile.php"><span>Guard Profile</span></a></li>
   <li><a href="manage_parking.php"><span>Manage Parking</span></a></li>
   <li><span></span></li>
   <div id="profile"><?php echo"<li><span>$name &nbsp;</span></li>";?></div>
   
   <script src="lightbox2-master/jquery2.js"> </script>
	<script src="lightbox2-master/dist/js/lightbox.js"></script>
	<link href="lightbox2-master/dist/css/lightbox.css" rel="stylesheet">
   
   <div id="profile_photo"><li><span><a href="guard_uploads/<?php echo $photo; ?>" data-lightbox="profile_pic">
   <img src="guard_uploads/<?php echo $photo ?>" width="50px" height="50px" id="profile_photo"></a></span></li></div>
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
 <td>Guard-ID:</td>
 <td><?php echo $id?></td>
 </tr>
 </table>
 
  <h4 class="td_bottom"><br>© e-Parking-2016, Developed by : Ayush Garg</h4> 
 </form>
</body>
</html>

<?php
}
?>