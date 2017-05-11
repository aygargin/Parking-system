<?php
mysql_connect("localhost" ,"root", "");
mysql_select_db("parking_system");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style1.css" rel="stylesheet" type="text/css">
<title>Manage Space</title>
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
<h1>Manage Space</h1>

<?php 
session_start();
 $id=$_SESSION['adm_name'];

 if($id!="zhcet")
 header("location:admin_login.php");
	$q=mysql_query("select * from space_db order by space_id asc ");
	$num=mysql_num_rows($q);
	if($num>0)
	{
?>
<a href="add_space.php"><input type ="button" class ="btnLogin" name ="go1" value="ADD SPACE"></a>
<a href="admin_profile.php"><input type ="button" class ="btnLogin" name ="go2" value="DASHBOARD"></a>
<a href="logout.php" id="logout">logout</a>
<table id="report" align="center" cellpadding = "5">
        <tr>
            <th>S.No</th>
            <th>Space Id</th>
            <th>Status</th>
            <th>Operations</th>
        </tr>

	<?php 
		$i=1;
		while($f=mysql_fetch_array($q))
		{
	?>
    <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $f['space_id']; ?></td>
            <td><?php echo $f['status']; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr>
            <td colspan="4">
                Operations:
                <ul>
                    <li><a href="deleteparking.php?del=<?php echo $f['space_id']; ?> &ch=1"><input type="button" name="delete" 
                    value="DELETE" /></a></li>
                 </ul>   
            </td>
        </tr>
		<?php
		$i++;
	 	} 
	 ?>
</table>

  <h4 class="td_bottom" style="position:absolute !important"><br>© e-Parking-2016, Developed by : Ayush Garg</h4> 
 </form>
</body>
</html>
<?php } ?>


