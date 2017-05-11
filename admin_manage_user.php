<?php 
	mysql_connect("localhost" ,"root", "");
	mysql_select_db("parking_system");
?>
<?php
session_start();
$adm_name=$_SESSION['adm_name'];
if($adm_name=="")
header("location:admin_login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style1.css" rel="stylesheet" type="text/css">
<title>Manage Users</title>
    <style type="text/css">
        body { font-family:Arial, Helvetica, Sans-Serif; font-size:0.8em;}
        #report { border-collapse:collapse;}
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
<h1>Manage Users</h1>
<a href="register1.php"><input type ="button" class ="btnLogin" name ="go1" value="ADD USER"></a>
<a href="admin_profile.php"><input type ="button" class ="btnLogin" name ="go2" value="DASHBOARD"></a>
<a href="logout.php" id="logout">logout</a>
<?php 

	$q=mysql_query("select * from user_db order by s_no asc");
	$num=mysql_num_rows($q);
	
	if($num>0)
	{
?>

<table id="report" align="center" cellpadding = "5">
        <tr>
            <th>S.No</th>
            <th>User Name</th>
            <th>Vehicle-id</th>
            <th>Space-id</th>
            <th>Entry</th>
            <th>Exit</th>
            <th>Operation</th>
        </tr>
        <?php 
		$i=1;
		while($f=mysql_fetch_array($q))
		{
			$v_id=$f['vehicle_id'];
			$qq=mysql_query("select * from reservation_db where vehicle_id='$v_id' order by s_no desc ");
			while($ff=mysql_fetch_array($qq))
		{
		?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $f['name']; ?></td>
            <td><?php echo $f['vehicle_id']; ?></td>
            <td><?php echo $ff['space_id']; ?></td>
            <td><?php echo $ff['entry_time']; ?></td>
            <td><?php echo $ff['exit_time']; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr>
            <td colspan="7">
                <img src='v_uploads/<?php $photo=$f['photo']; echo $photo?>' width='50px' height='50px'>
                 Phone no: <?php echo $f['phone_no']; ?>
                <br />Address: <?php echo $f['address']; ?><br />
                <br />Operations:
                <ul>
                    <li><a href="deleteuser.php?del=<?php echo $f['s_no']; ?>"><input type="button" name="delete" value="DELETE" /></a></li>
                 </ul>   
            </td>
        </tr>
        <?php
		$i++;
	 	} }
		?>
        
    </table>

  <h4 class="td_bottom"><br>© e-Parking-2016, Developed by : Ayush Garg</h4> 
 </form>
</body>
</html>

<?php

}
?>