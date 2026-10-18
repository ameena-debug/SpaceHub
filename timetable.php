<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$Food=$_POST['txt_food'];
	$week=$_POST['sel_week'];
	$Time=$_POST['txt_time'];
	$insQry="insert into tbl_food(food, week,time) values('".$Food."','".$Week."','".$Time."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("inserted");
		window.location="timetable.php";
		</script>
        <?php
	}
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
      <td>Week</td>
      <td><p>
        <label for="sel_week"></label>
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
        </select>
      </p>
      <p>&nbsp; </p></td>
    </tr>
<tr>
      <td>Food Details</td>
      <td><label for="txt_food"></label>
      <input type="text" name="txt_food" id="txt_food" />
      </td>
    </tr>
    <tr>
      <td>Time
          <label for="txt_time2"></label></td>
      <td><label for="txt_time"></label>
      <input type="text" name="txt_time" id="txt_time" /></td>
</tr>
<tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_Submirt" id="btn_Submirt" value="Submit" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<form id="form2" name="form2" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>S.NO</td>
      <td>FOOD DETAILS</td>
      <td>ACTION</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>