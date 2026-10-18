<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$course="";
$Edid = 0;
if(isset($_POST['btn_submit']))
{
	$course=$_POST['txt_course'];
	$department=$_POST['sel_dept'];
	$Edid = $_POST['txt_Edid'];
	
	echo $selQry="select * from tbl_course where course_name='".$course."' and department_id='".$department."'";
		$rowcourse=$Con->query($selQry);
		if($datacourse=$rowcourse->fetch_assoc())
		{
			?>
            
			<script>
			alert("Already exists");
			window.location="CourseDetails.php";
			</script>
			<?php
	}
	else
	{
	
	if($Edid == 0)
	{
			$insQry="insert into tbl_course(course_name,department_id) values(' ".$course." ','".$department."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="CourseDetails.php";
			</script>
			<?php
		
		}
	}
	

	else
	{
		$upQry = "update  tbl_course set course_name = '".$course."' where course_id = '".$_GET['Edid']."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="CourseDetails.php";
			</script>
			<?php
		}
	}
	
}
}

if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_course where course_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="CourseDetails.php";
		</script>
        <?php
	}
}


if(isset($_GET['Edid']))
{
	$selEdit = "select * from tbl_course where course_id = ".$_GET['Edid'];
	$resultEdit = $Con -> query($selEdit);
	$rowEdit = $resultEdit -> fetch_assoc();
	$course = $rowEdit['course_name'];
	$Edid = $rowEdit['course_id'];
}

?>
	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<style>
  body {
    background-color: #f8f9fa;
    padding: 30px 0;
  }
  .form-container, .table-container {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 30px;
  }
  .table td, .table th {
    vertical-align: middle !important;
  }
  .btn-clear {
    background-color: #dc3545;
    color: #fff;
  }
  .btn-clear:hover {
    background-color: #c82333;
    color: #fff;
  }
</style>
</head>

<body>
<div class="container">

  <!-- Course Input Form -->
  <div class="form-container">
    <h3 class="mb-4">Add / Edit Course</h3>
    <form id="form1" name="form1" method="post" action="">
      <div class="mb-3 row">
        <label for="txt_course" class="col-sm-2 col-form-label">Course Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_course" id="txt_course" value="<?php echo $course; ?>" placeholder="Enter your course name"/>
          <input type="hidden" name="txt_Edid" id="txt_Edid" value="<?php echo $Edid; ?>" />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="sel_dept" class="col-sm-2 col-form-label">Department</label>
        <div class="col-sm-10">
          <select name="sel_dept" id="sel_dept" class="form-select">
            <option>--Select--</option>
            <?php
              $selRoom="select * from tbl_department";
              $selResult=$Con->query($selRoom);
              while($selRow=$selResult->fetch_assoc())
              {
            ?>
            <option value="<?php echo $selRow['department_id']?>"><?php echo $selRow['department_name']?></option>
            <?php
              }
            ?>
          </select>
        </div>
      </div>

      <div class="text-center">
        <input type="submit" class="btn btn-primary me-2" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="submit" class="btn btn-clear" name="btn_clear" id="btn_clear" value="Clear" />
      </div>
    </form>
  </div>

  <!-- Course Table -->
  <div class="table-container">
    <h3 class="mb-4">Course Records</h3>
    <form name="form2" method="post" action="">
      <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
          <tr>
            <th>S.NO</th>
            <th>Department</th>
            <th>Course</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          $selQry="select * from tbl_course c inner join tbl_department d on d.department_id=c.department_id";
          $result=$Con->query($selQry);
          while($row=$result->fetch_assoc())
          {
            $i++;
          ?>
          <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['department_name']?></td>
            <td><?php echo $row['course_name']?></td>
            <td><a href="CourseDetails.php?Delid=<?php echo $row['course_id']?>" class="btn btn-sm btn-danger">Delete</a></td>
            <td><a href="CourseDetails.php?Edid=<?php echo $row['course_id']?>" class="btn btn-sm btn-warning text-white">Edit</a></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </form>
  </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Footer.php");
?>

