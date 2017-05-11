<?php
mysql_connect("localhost" ,"root", "");
mysql_select_db("parking_system");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style1.css" rel="stylesheet" type="text/css">
<title>Trackrecord</title>
    <style type="text/css">
        body { font-family:Arial, Helvetica, Sans-Serif; font-size:0.8em;}
        #report { border-collapse:collapse; margin-top:10px;}
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
<form method="post" enctype="multipart/form-data" >
<h1>Report Card</h1>

<?php
session_start();
$id=$_SESSION['user'];
if($id=="")
header("location:index.php");

?>

<a href="v_profile.php"><input type ="button" class ="btnLogin" name ="go2" value="DASHBOARD"></a>
<a href="logout.php" id="logout">logout</a>

<?php 
session_start();
 $user=$_SESSION['user'];
 $f=mysql_fetch_array(mysql_query("select vehicle_id from user_db where vehicle_id='$id'"));
	 $v_id=$f['vehicle_id'];
	 
	$q=mysql_query("select * from reservation_db where vehicle_id='$v_id' order by s_no desc ");
	$num=mysql_num_rows($q);
	if($num==0)
	echo"<br><br>You have not parked any car yet.";
	
	elseif($num>0)
	{
?>

<table align="center" cellpadding = "10">
        <tr>
            <th>S.No</th>
            <th>space_id</th>
            <th>entry_time</th>
            <th>exit_time</th>
            <th>fare</th>
        </tr>
	<?php 
		$i=1;
		while($f=mysql_fetch_array($q))
		{		
	
    echo"<tr>";
            echo"<td>".$i."</td>";
			echo" <td>". $f['space_id']."</td>";
            echo"<td>".$f['entry_time']."</td>";
            echo"<td>".$f['exit_time']."</td>";
            echo"<td>".$f['fare']."</td>";           
            
       echo" </tr>";
 ?>
        
  	<?php
			
			
		$i++;

	 	} 
	 ?>
</table>
</form>
<?php } ?>
