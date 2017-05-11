<style>
#profile
{
	position:absolute;
	top:auto;
	float:right;
	color:#CCC;
	top:6%;
	right:7%;
}
</style>
<?php
session_start();
$adm_name=$_SESSION['adm_name'];
if($adm_name=="")
header("location:admin_login.php");
else
{
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
   <title>Admin Profile</title>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li class='active'><a href="admin_profile.php"><span>Admin Profile</span></a></li>
   <li><a href="admin_manage_user.php"><span>Manage Users</span></a></li>
   <li><a href="admin_manage_guard.php"><span>Manage Guards</span></a></li>
   <li><a href="manage_parking_adm.php"><span>Manage Space</span></a></li>
   <li class='last'><a href="logout.php" id="logout"><span>Logout</span></a></li>
   <div id="profile"><?php echo"<li><span>$adm_name</span></li>";?></div>
</ul>
</div>
<form name="form" method="post" enctype="multipart/form-data">
<h3>WELCOME</h3>
 <table align="center" cellpadding = "10">
 <tr>
 <td>NAME:</td>
 <td><?php echo $adm_name?></td>
 </tr>
 </table>

  <h4 class="td_bottom"><br>© e-Parking, Developed by : Ayush Garg</h4>
 </form>
</body>
</html>
<?php
}
?>

