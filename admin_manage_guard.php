<?php 
	mysql_connect("localhost" ,"root", "");
	mysql_select_db("parking_system");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style1.css" rel="stylesheet" type="text/css">
<title>Manage Guard</title>
    <style type="text/css">
        body { font-family:Arial, Helvetica, Sans-Serif; font-size:0.8em;}
        #report { border-collapse:collapse;		}
        #report h4 { margin:0px; padding:0px;}
        #report img { float:right;}
        #report ul { margin:10px 0 10px 40px; padding:0px;}
        #report th { background:#7CB8E2 url(header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
        #report td { background:#C7DDEE none repeat-x scroll center left; color:#000; padding:7px 15px; }
        #report tr.odd td { background:#fff url(row_bkg.png) repeat-x scroll center left; cursor:pointer; }
        #report div.arrow { background:transparent url(arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
    </style>
    <script src="table_jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">  
        $(document).ready(function(){
            $("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();
            
            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });
    </script>        
</head>
<body>
<div id="header">
<h1>Manage Guards</h1>
<a href="register_guard.php"><input type ="button" class ="btnLogin" name ="go1" value="ADD GUARDS"></a>
<a href="admin_profile.php"><input type ="button" class ="btnLogin" name ="go2" value="DASHBOARD"></a>
<a href="logout.php" id="logout">logout</a>
</div>
<?php
session_start();
$adm_name=$_SESSION['adm_name'];
if($adm_name=="")
header("location:admin_login.php"); 
	$q=mysql_query("select * from guard_db where status='1' order by guard_id desc ");
	$num=mysql_num_rows($q);
	if($num>0)
	{
?>
<div id="middlepart">

<div id="table_heading"><strong>ACTIVATED GUARD MEMBERS</strong></div>
<div id="tableleft">
<table  style="margin-top:5%; margin-left:150px"  id="report" align="center" cellpadding = "5">
		
        
            <th>S.No</th>
            <th>User Name</th>
            <th>Guard-id</th>
            <th>Operation</th>
        
	<?php 
		$i=1;
		while($f=mysql_fetch_array($q))
		{
	?>
   		 <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $f['guard_name']; ?></td>
            <td><?php echo $f['guard_id']; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
     
        <tr>
            <td colspan="4">
                <img src='guard_uploads/<?php $photo=$f['guard_photo']; echo $photo?>' width='50px' height='50px'>
                Phone no: <?php echo $f['guard_phone_no']; ?>
                <br />Address: <?php echo $f['guard_address']; ?><br />
                <br />Operations:
                <ul>
                    <li><a href="deleteguard.php?del=<?php echo $f['guard_id']; ?>"><input type="button" name="delete" value="DELETE" /></a></li>
                 	<li><a href="deactivate_guard.php?stat=<?php echo $f['guard_id']; ?>&&check=0"><input type="button" name="deactivate" value="DEACTIVATE" /></a></li>
                </ul>   
            </td>
        </tr>
	<?php
		$i++;
	 	} 
	 ?>


<?php 
}
?>
</table>
</div>

<?php 
	$q=mysql_query("select * from guard_db where status='0' order by guard_id desc ");
	$num=mysql_num_rows($q);
	if($num>0)
	{
?>

<div id="table_heading1"><strong>DEACTIVATED GUARD MEMBERS</strong></div>

<div id="tableright">
<table style="margin-top:auto; margin-right:135px" id="report" align="center" cellpadding = "5">
		
        
        <tr>
            <th>S.No</th>
            <th>User Name</th>
            <th>Guard-id</th>
            <th>Operation</th>
            </tr>
        <tr>
        </tr>
	<?php 
		$i=1;
		while($f=mysql_fetch_array($q))
		{
	?>
   		 <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $f['guard_name']; ?></td>
            <td><?php echo $f['guard_id']; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
  
        <tr>
            <td colspan="4">
                <img src='guard_uploads/<?php $photo=$f['guard_photo']; echo $photo?>' width='50px' height='50px'>
                Phone no: <?php echo $f['guard_phone_no']; ?>
                <br />Address: <?php echo $f['guard_address']; ?><br />
                <br />Operations:
                <ul>
                    <li><a href="deleteguard.php?del=<?php echo $f['guard_id']; ?>"><input type="button" name="delete" value="DELETE" /></a></li>
                 	<li><a href="deactivate_guard.php?stat=<?php echo $f['guard_id']; ?>&&check=1"><input type="button" name="activate" value="ACTIVATE" /></a></li>
                </ul>   
            </td>
        </tr>
	<?php
		$i++;
	 	} 
	 ?>

<?php 
}
?>
</table>
</div>
</div>

<h4 class="td_bottom"><br>© e-Parking-2016, Developed by : Ayush Garg</h4> 
</form>
</body>
</html>

