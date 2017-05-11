<?php
mysql_connect("localhost" ,"root", "");
mysql_select_db("parking_system");
?>

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
<style>
    tab { padding-left: 2em; }
</style>
<div id="cen">
<table align="center" style="margin-left:60px">

<tr>

<td><image src="img.jpg"></td>

<td><b>Admin Login</b><br>
<br>Admin name
<input type="text" name ="adm_name" required>
<br><br>Password
<span style="padding: 0 15px">&nbsp;<input type="password" name="password" required></span>
<br><br><input type ="submit" class ="btnLogin" name ="login" value="Login">
</td>


</tr>

</table>
</div>
<h4 class="td_bottom" style="position: absolute; bottom:0;"  ><br>© e-Parking, Developed by : Ayush Garg</h4>

</form></body></html>


<?php
if (isset($_POST['login']))
{
	extract($_POST);
	mysql_connect("localhost" ,"root", "");
	mysql_select_db("parking_system");
	
	$r=mysql_query("select * from adminlogin where adm_name='$adm_name' AND adm_pass=MD5('$password')");
	$q=mysql_num_rows($r);
	if($q>0)
	{
		$f=mysql_fetch_array($r);
		session_start();
		$_SESSION['adm_name']=$f['adm_name'];
		
		header("location:admin_profile.php");
	}
	else echo"invalid name or password";	
}
?>
