<html>
<body>
<link href="style1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" href="social_menu.js"></script>

<form method="POST" >
<svg viewBox="0 0 600 300" style="position:absolute;top:-250px;">

  <!-- Symbol with text -->
  <symbol id="s-text">
    <text text-anchor="middle"
          x="50%"
          y="50%"
          dy=".35em"
          class="text--line"
          >
      Parking System
    </text>    
  </symbol>

  <!-- Clippath  with text -->
  <clippath id="cp-text">
    <text text-anchor="middle"
          x="50%"
          y="50%"
          dy=".35em"
          class="text--line"
          >
     Parking System
    </text>
  </clippath>

  <!-- Group for shadow -->
  <g clip-path="url(#cp-text)" class="shadow">
    <rect
          width="100%"
          height="100%"         
          class="anim-shape anim-shape--shadow"
          ></rect>
  </g>

  <!-- Group with clippath for text-->
  <g clip-path="url(#cp-text)" class="colortext">
    <!-- Animated shapes inside text -->
    <rect
          width="100%"
          height="100%"         
          class="anim-shape"
          ></rect>
    <rect
          width="80%"
          height="100%"         
          class="anim-shape"
          ></rect>
    <rect
          width="60%"
          height="100%"         
          class="anim-shape"
          ></rect>
    <rect
          width="40%"
          height="100%"         
          class="anim-shape"
          ></rect>
    <rect
          width="20%"
          height="100%"         
          class="anim-shape"
          ></rect>
  </g>

  <!-- Transparent copy of text to keep
         patterned text selectable -->
  <use xlink:href="#s-text"
       class="text--transparent"></use>

</svg>


  
<div id="cen">
<table align="center">

<tr>

<td><image src="img.jpg"></td>

<td><b>Login</b><br>
<br>Enter Id&emsp;
<input type="text" name ="username" required>
<br><br>Password&nbsp;
<input type="password" name="password" required>
<br><br><input type ="submit" class ="btnLogin" name ="login" value="Login">
</td>

<td> &emsp;&emsp;<b>New User? Register Now!</b>
<br>&emsp;&emsp;To take tests, click here<br>&emsp;&emsp;to register first.
<br><br>&emsp;&emsp;<a href="register1.php"><input type ="button" class ="btnLogin" name ="go1" value="Register"></a>
</td>


</tr>

<?php
if (isset($_POST['login']))
{
	extract($_POST);
	mysql_connect("localhost" ,"root", "");
	mysql_select_db("parking_system");
	$a=MD5($password);
	
	$p=mysql_query("select * from user_db where vehicle_id='$username' AND password='$a'");
	$q=mysql_num_rows($p);
	
	$r=mysql_query("select * from guard_db where guard_id='$username' AND guard_pass='$a'");
	$s=mysql_num_rows($r);
	$ff=mysql_fetch_array($r);
	
	if($q>0)
	{
		$f=mysql_fetch_array($p);
		session_start();
		$_SESSION['user']=$f['vehicle_id'];
		$_SESSION['name']=$f['name'];
		$_SESSION['password']=$f['password'];
		$_SESSION['photo']=$f['photo'];
		$_SESSION['phone_no']=$f['phone_no'];
		$_SESSION['address']=$f['address'];
		header("location:v_profile.php");
	}
	
	else if($s>0 && $ff['status']==1 )
	{
		session_start();
		$_SESSION['guard_user']=$ff['guard_id'];
		$_SESSION['guard_name']=$ff['guard_name'];
		$_SESSION['guard_pass']=$ff['guard_pass'];
		$_SESSION['guard_photo']=$ff['guard_photo'];
		$_SESSION['guard_phone_no']=$f['guard_phone_no'];
		$_SESSION['guard_address']=$f['guard_address'];
		header("location:guard_profile.php");
	}
	
	else if($s>0 && $ff['status']==0)
	echo"<h2>deactivated guard.<h2>";
	
	else echo"<h2>invalid username or password.</h2>";	
}
?>
</table>

</div>
<h4 class="td_bottom" style="position: absolute; bottom:0;"  ><br>© e-Parking-2016, Developed by : Ayush Garg</h4>

</form></body></html>