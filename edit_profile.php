<?php
 mysql_connect("localhost","root","");
mysql_select_db("parking_system");
 ?>

<?php
session_start();
extract($_REQUEST);
$user=$_SESSION['user'];
$guard_user=$_SESSION['guard_user'];
$photo=$_SESSION['photo'];
$photo1=$_SESSION['guard_photo'];
if($user=="" && $guard_user=="")
header("location:index.php");
$f=mysql_fetch_array(mysql_query("select * from user_db where vehicle_id='$user'"));
$ff=mysql_fetch_array(mysql_query("select * from guard_db where guard_id='$guard_user'"));
?>

<script>
var loadFile=function(event)
{
	var preview=document.getElementById('preview');
	preview.src=URL.createObjectURL(event.target.files[0]);
};
</script>
<script>
function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass');
    var pass2 = document.getElementById('pass1');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}
</script>
<html>
<link href="style1.css" rel="stylesheet" type="text/css">
<body>
<form name="form" method="post" enctype="multipart/form-data" onSubmit="return(validate());">
<h3>EDIT PROFILE</h3>
 <table align="center" cellpadding = "10">
 
 <td>NAME*</td>
 <td><input type="text" name="name" maxlength="30" value="
 <?php if($ch==0) 
 echo $f['name'];
 else if($ch==1)
 echo $ff['guard_name']; ?>" >
 </td>
 </tr>
 
 <tr>
 <td>UPLOAD PHOTO*</td><td>
 <?php
 if($ch==0)
  echo "<img src='v_uploads/$photo' id='preview' width='200px' height='200px'>";
  else if($ch==1)
   echo "<img src='guard_uploads/$photo1' id='preview' width='200px' height='200px'>";
   ?></td>
 <td align="left" colspan="4"><input type="file" script="image" name="img" onChange="loadFile(event)" ></td>
 </tr>
 
 <tr>
 <td>Contact Number*</td>
 <td><input type="text" name="phone_no" maxlength="10" value="
 <?php if($ch==0) 
 echo $f['phone_no'];
 else if($ch==1)
 echo $ff['guard_phone_no']; ?>" ></td>
 </tr>
 
 <tr>
 <td>Address*</td>
 <td><input type="text" name="address" maxlength="100" value="
 <?php if($ch==0) 
 echo $f['address'];
 else if($ch==1)
 echo $ff['guard_address']; ?>" ></td>
 </tr>
  
 <tr><td>Password*</td>
 <td><input type="password" name="pass" maxlength="20" required id="pass" placeholder="min 8 characters">
 
 </td>
 </tr>
 
 <tr><td>Confirm-Password*</td>
 <td><input type="password" name="pass1" maxlength="20" required id="pass1" placeholder="min 8 characters" onKeyUp="checkPass(); return false;">
 <span id="confirmMessage" class="confirmMessage"></span> 
 </td>
 </tr>
 
 <script>
 function validate()
 {
	 var ppass=/^[0-9 a-z A-Z]{8,20}/;
	 var b=document.form.pass.value;
	 
	 var a=document.form.go.value;
	
	 
	 if(!ppass.test(b))
	 {
		 alert("Invlaid Password: Please enter the correct password.");
		 document.form.pass.focus();
		 return false;
	 }
	 
	  if(a!=""||a!=null)
	 {
		 alert("Successfully Registered.");
		 return true;
	 }
	 
	 return true;
	 
 }
 </script>
 
 <tr>
 <td colspan="4" align="center" >
 <input type="submit" class="btnLogin" name="go" value="UPDATE" >

 </td>
 </tr>
 
 <tr><td>*feilds are mandatory.</td></tr>
 </table>
 

  <h4 class="td_bottom"><br>© e-Parking-2016, Developed by : Ayush Garg</h4> 
 </form>
</body>
</html>
 
 
<?php
extract($_POST);
if($ch==0)
{
$user=$_SESSION['user'];
$photo=$_SESSION['photo'];
$phone_no=$_SESSION['phone_no'];
$address=$_SESSION['address'];
$f=mysql_fetch_array(mysql_query("select * from user_db where vehicle_id='$user'"));
$z=MD5($pass);

 if(isset($_POST['go']))
 {	 
	if($pass==$pass1)
	{
		$old_pic=$f['photo'];
		extract($_POST);
		unlink("v_uploads/$old_pic") ;
		
		$p=$_FILES['img']['name'];
		$tempname=time().$p;
		$source=$_FILES['img']['tmp_name'];
		$destination="v_uploads/";
		$target=$destination.$tempname;
		move_uploaded_file($source,$target);
		$qry=mysql_query("update vehicle_db set name='$name',photo='$tempname',password='$z',phone_no='$phone_no',address='$address' where vehicle_id='$user'");
		
	 if($qry)
	 {
		 header("location:index.php");
	 }
 	}	
 }
}
else if($ch==1)
{
	$user=$_SESSION['guard_user'];
   $photo=$_SESSION['guard_photo'];
   $guard_phone_no=$_SESSION['guard_phone_no'];
   $guard_address=$_SESSION['guard_address'];
$ff=mysql_fetch_array(mysql_query("select * from guard_db where guard_id='$user'"));
$w=MD5($pass);

 if(isset($_POST['go']))
 {
	if($pass==$pass1)
	{
		$old_pic=$ff['guard_photo'];
		extract($_POST);
		unlink("guard_uploads/$old_pic") ;
		
		$p=$_FILES['img']['name'];
		$tempname=time().$p;
		$source=$_FILES['img']['tmp_name'];
		$destination="guard_uploads/";
		$target=$destination.$tempname;
		move_uploaded_file($source,$target);
		$qry=mysql_query("update guard_db set guard_name='$name',guard_photo='$tempname',guard_pass='$w',guard_phone_no='$guard_phone_no',guard_address='$guard_address' where guard_id='$user'");
	 	 
	
	 if($qry)
	 {
		 header("location:index.php");
	 }
 	}	
 }
}
 ?>
 