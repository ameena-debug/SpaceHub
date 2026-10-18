<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

if(isset($_POST['btn_submit']))
{
    $Food = $_POST['txt_food'];
    $Week = $_POST['sel_week'];
    $Time = $_POST['txt_time'];

    // Check duplicate
    $selQry = "select * from tbl_food where week_id='".$Week."' and foodtimetable_time='".$Time."'";
    $rowweek = $Con->query($selQry);

    if($datacourse = $rowweek->fetch_assoc())
    {
        ?>
        <script>
        alert("Already exists");
        window.location="timetable.php";
        </script>
        <?php
    }
    else
    {
        $insQry = "insert into tbl_food(foodtimetable_details, week_id, foodtimetable_time) 
                   values('".$Food."','".$Week."','".$Time."')";
        if($Con->query($insQry))
        {
            ?>
            <script>
            alert("Inserted Successfully");
            window.location="timetable.php";
            </script>
            <?php
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
		window.location="timetable.php";
		</script>
        <?php
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Food Timetable</title>

<style>
/* General Body Styling */
body {
    font-family: Arial, sans-serif;
    background: #f4f7f8;
    padding: 30px;
    color: #333;
}

/* Page Heading */
h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 40px;
}

/* Forms & Tables Styling */
form, table {
    width: 700px;
    margin: 20px auto;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 12px;
    overflow: hidden;
}

/* Table Header */
form table tr:first-child, table tr:first-child {
    background-color: #3498db;
    color: #fff;
    font-weight: bold;
    text-align: center;
    font-size: 16px;
}

/* Table Cells */
form table td, table td {
    padding: 12px;
    border: 1px solid #ccc;
    font-size: 14px;
}

/* Inputs & Selects */
form input[type="text"], form select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Submit Button */
form input[type="submit"] {
    display: inline-block;
    background: #27ae60;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s;
}

form input[type="submit"]:hover {
    background: #1e8449;
}

/* Table Zebra Stripe */
table tr:nth-child(even) td {
    background-color: #f9f9f9;
}

table tr:hover td {
    background-color: #f1f7fd;
}

/* Action Links */
table a {
    display: inline-block;
    padding: 6px 12px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    transition: background 0.3s;
}

table a:hover {
    background-color: #2980b9;
}

/* Center Text */
table td, table th, form td {
    text-align: center;
}

/* Form labels bold */
form td:first-child {
    font-weight: bold;
    text-align: left;
    width: 30%;
    padding-left: 12px;
}
</style>
</head>

<body>

<h2>🍴 Food Timetable Management</h2>

<!-- Form Section -->
<form method="post" action="" enctype="multipart/form-data">
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <td colspan="2">Add Food Timetable</td>
    </tr>
    <tr>
      <td>Week</td>
      <td>
        <select name="sel_week" id="sel_week">
          <option value="">--Select--</option>
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
      </td>
    </tr>
    <tr>
      <td>Food Details</td>
      <td><input type="text" name="txt_food" id="txt_food" /></td>
    </tr>
    <tr>
      <td>Time</td>
      <td>
        <select name="txt_time" id="txt_time">
          <option value="">--Select--</option>
          <option>Breakfast</option>
          <option>Lunch</option>
          <option>Dinner</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>

<!-- Display Food Timetable -->
<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <td>S.NO</td>
    <td>Week</td>
    <td>Food Details</td>
    <td>Time</td>
    <td>Action</td>
  </tr>
  <?php
  $i=0;
  $selFood="select *
            from tbl_food f inner join tbl_week w on f.week_id=w.week_id";
  $foodResult=$Con->query($selFood);
  while($row=$foodResult->fetch_assoc())
  {
      $i++;
      ?>
      <tr>
        <td><?php echo $i?></td>
        <td><?php echo $row['week_name']?></td>
        <td><?php echo $row['foodtimetable_details']?></td>
        <td><?php echo $row['foodtimetable_time']?></td>
        <td>
          <a href="timetable.php?Delid=<?php echo $row['foodtimetable_id']?>">Delete</a>
        </td>
      </tr>
      <?php
  }
  ?>
</table>

</body>
</html>

<?php
include("Footer.php");
?>
