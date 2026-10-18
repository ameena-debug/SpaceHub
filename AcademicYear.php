<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$academicyear="";
$Edid = 0;
if(isset($_POST['btn_submit']))
{
	$academicyear=$_POST['txt_academicyear'];
	$Edid = $_POST['txt_Edid'];
	if($Edid == 0)
	{
		$insQry="insert into tbl_academicyear(academicyear_name) values(' ".$academicyear." ')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="AcademicYear.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry = "update  tbl_academicyear set academicyear_name = '".$academicyear."' where academicyear_id = ".$Edid;
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="AcademicYear.php";
			</script>
			<?php
		}
	}
	
		
	
}
if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_academicyear where academicyear_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="AcademicYear.php";
		</script>
        <?php
	}
}


if(isset($_GET['Edid']))
{
	$selEdit = "select * from tbl_academicyear where academicyear_id = ".$_GET['Edid'];
	$resultEdit = $Con -> query($selEdit);
	$rowEdit = $resultEdit -> fetch_assoc();
	$academicyear = $rowEdit['academicyear_name'];
	$Edid = $rowEdit['academicyear_id'];
}

?>
	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Academic Year</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="1">
    <tr>
      <td>Academic Year</td>
      <td><label for="txt_academicyear"></label>
      <input type="text" name="txt_academicyear" id="txt_academicyear" value="<?php echo $academicyear; ?>" placeholder="Enter your Academic Year"/>
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
      <td>Academicyear</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_academicyear";
	$result=$Con->query($selQry);
	while($row=$result->fetch_assoc())
	{
		$i++
		?>
    <tr>
      <td><?php echo $i?>
      </td>
      <td><?php echo $row['academicyear_name']?>
       </td>
      <td><a href="AcademicYear.php?Delid=<?php echo $row['academicyear_id']?>">Delete</a></td>
      <td><a href="AcademicYear.php?Edid=<?php echo $row['academicyear_id']?>">Edit</a></td>
      
    </tr>
    <?php
	}
	?>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
include("Footer.php");
?>