<?php
 mysql_connect("localhost","root","");
	 mysql_select_db("parking_system");
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
<h3>MEMBER REGISTRATION</h3>
 <table align="center" cellpadding = "10">
 
 <td>NAME*</td>
 <td><input type="text" name="name" maxlength="30" required placeholder="max 30 characters">
 
 </td>
 </tr>
 
 <tr>
 <td>UPLOAD PHOTO*</td>
 <td><image src="v_uploads/default.png" id="preview" width="200px" height="200px"></td>
 <td align="left" ><input type="file" script="image" name="img" onChange="loadFile(event)" required></td>
 </tr>

 <tr>
 <td>Vehicle ID*</td>
 <td><input type="text" name="user" maxlength="100" required></td>
 </tr>
 
 <tr>
 <td>Contact Number*</td>
 <td><input type="text" name="phone_no" maxlength="10" required></td>
 </tr>
 
 <tr>
 <td>Address*</td>
 <td><input type="text" name="address" maxlength="100" required></td>
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
 <td colspan="3" align="center">
 <input type="submit" class="btnLogin" name="go" value="Register" >
 <input type="reset" class="btnLogin" value="Reset" >
 </td>
 </tr>
 
 <tr>
 <td>Already a User?Click here to <a href="index.php">Login</a></td></tr>
 
 <tr><td>*feilds are mandatory.</td></tr>
 </table>
 
 <h4 class="td_bottom"><br>© e-Parking-2016, Developed by : Ayush Garg</h4> 
 </form> 
 </body>
 </html>
 
 <?php
 extract($_POST);
 session_start();
 $id=$_SESSION['adm_name'];
 $z=MD5($pass);

 if(isset($_POST['go']))
 {
	 	$qry=mysql_query("select vehicle_id from user_db where '$user'=vehicle_id");
 		$num=mysql_num_rows($qry);
		
		$qry1=mysql_query("select guard_id from faculty_db where '$user'=guard_id");
 		$num1=mysql_num_rows($qry1);

	    if($pass==$pass1 && $num==0 && $num1==0){
		extract($_POST); 
		$p=$_FILES['img']['name'];
		$tempname=time().$p;
		$source=$_FILES['img']['tmp_name'];
		$destination="v_uploads/";
		$target=$destination.$tempname;
		move_uploaded_file($source,$target);
	 	 
	$q=mysql_query("insert into user_db (name,vehicle_id,password,phone_no,photo,address) values ('$name','$user','$z','$phone_no','$tempname','$address')");
	 if($q)
	 {		 
		 echo"value entered successfully";

		 if($id=="")
		 header("location:index.php");
		 else if($id=="zhcet")
		 header("location:admin_manage_user.php");
	 }
 	}	
 }
 
 ?>
 