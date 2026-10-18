<?php
include("../Assets/Connection/Connection.php");
$district ="";
$Edid = 0;
if(isset($_POST['btn_submit']))
{
	$district=$_POST['txt_district'];
	$Edid = $_POST['txt_Edid'];
	if($Edid == 0)
	{
		$insQry="insert into tbl_district(district_name) values(' ".$district." ')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="District.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry = "update  tbl_district set district_name = '".$district."' where district_id = ".$Edid;
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="District.php";
			</script>
			<?php
		}
	}	
}
if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_district where district_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="District.php";
		</script>
        <?php
	}
}

if(isset($_GET['Edid']))
{
	$selEdit = "select * from tbl_district where district_id = ".$_GET['Edid'];
	$resultEdit = $Con -> query($selEdit);
	$rowEdit = $resultEdit -> fetch_assoc();
	$district = $rowEdit['district_name'];
	$Edid = $rowEdit['district_id'];
}

?>
	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="1">
    <tr>
      <td>District Name</td>
      <td><label for="txt_district"></label>
      <input type="text" name="txt_district" id="txt_district" value="<?php echo $district; ?>" placeholder="Enter yor district name"/>
      <input type="hidden" name="txt_Edid" id="txt_Edid" value="<?php echo $Edid; ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_clear" id="btn_clear" value="clear" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<form name="form2" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>S.NO</td>
      <td>district</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_district";
	$result=$Con->query($selQry);
	while($row=$result->fetch_assoc())
	{
		$i++
		?>
    <tr>
      <td><?php echo $i?>
      </td>
      <td><?php echo $row['district_name']?>
       </td>
      <td><a href="District.php?Delid=<?php echo $row['district_id']?>">Delete</a></td>
      <td><a href="District.php?Edid=<?php echo $row['district_id']?>">Edit</a></td>
      
    </tr>
    <?php
	}
	?>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
