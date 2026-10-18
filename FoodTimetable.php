<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$Edid="";

if(isset($_POST['btn_submit']))
{
	$week=$_POST['sel_week'];
	$time=$_POST['txt_time'];
	$food=$_POST['txt_fdetails'];
	$Edid = $_POST['txt_Edid'];
	echo $selQry="select * from tbl_food where week_id='".$week."' and foodtimetable_time='".$time."'";
		$rowweek=$Con->query($selQry);
		if($datacourse=$rowweek->fetch_assoc())
		{
			?>
            
			<script>
			alert("Already exists");
			window.location="FoodTimetable.php";
			</script>
			<?php
	}
	else
	{
	if($Edid == 0)
	{
		$insQry="insert into tbl_food (week_id,foodtimetable_details,foodtimetable_time) values ('".$week."','".$food."','".$time."')";
	if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="FoodTimetable.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry="update tbl_food set foodtimetable_time,foodtimetable_details='".$time."','".$food."' where food_id = '".$_GET['Edid']."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("updated");
			window.location="FoodTimetable.php";
			</script>
			<?php
		}
	}
}
}
if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_food where foodtimetable_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="FoodTimetable.php";
		</script>
        <?php
	}
}


if(isset($_GET['Edid']))
{
	$selEdit = "select * from tbl_food where foodtimetable_id = ".$_GET['Edid'];
	$resultEdit = $Con -> query($selEdit);
	$rowEdit = $resultEdit -> fetch_assoc();
	$food= $rowEdit['txt_fdetails'];

	$Edid = $rowEdit['foodtimetable_id'];
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
  <table width="200" border="1">
    <tr>
      <td width="105">Week</td>
      <td width="79"><label for="sel_week"></label>
        <select name="sel_week" id="sel_week">
      
            <option>--Select--</option>
            <?php
			$selWeek="select * from tbl_week";
			$selResult=$Con->query($selWeek);
			while($selRow=$selResult->fetch_assoc())
			{
			?>
             <option value="<?php echo $selRow['week_id']?>"><?php echo $selRow['week_name']?></option>
             <?php
			}
			?>
          </select></td>
      </select></td>
    </tr>
    <tr>
      <td>Time</td>
      <td><label for="txt_time"></label>
      <input type="time" name="txt_time" id="txt_time" /></td>
    </tr>
    <tr>
      <td>FoodDetails</td>
      <td><label for="txt_fdetails"></label>
      <textarea name="txt_fdetails" id="txt_fdetails" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<form id="form2" name="form2" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>S.No</td>
      <td>Week</td>
      <td>Time</td>
      <td>Food_details</td>
      <td>Action</td>
    </tr>
    <tr>
      
	  <?php
	$i=0;
	$selQry="select * from tbl_food f inner join tbl_week w on f.week_id=w.week_id";
	$result=$Con->query($selQry);
	while($row=$result->fetch_assoc())
	{
		$i++
		?>
     
      <td><?php echo $i?></td>
     <td><?php echo $row['week_id']?></td>

      <td><?php echo $row['foodtimetable_time']?></td>
      <td><?php echo $row['foodtimetable_details']?></td>
      <td><a href="FoodTimetable.php?Delid=<?php echo $row['foodtimetable_id']?>">Delete</a></td>
      <td width="29"><a href="FoodTimetable.php?Edid=<?php echo $row['foodtimetable_id']?>">Edit</a></td>
      
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