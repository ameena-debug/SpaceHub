<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$course="";
$Edid = 0;
$semester="";
if(isset($_POST['btn_submit']))
{
	$semester=$_POST['txt_semester'];
	$Edid = $_POST['txt_Edid'];
	if($Edid == 0)
	{
		$insQry="insert into tbl_semester(semester_name) values(' ".$semester." ')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="Semester.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry = "update  tbl_semester set semester_name = '".$semester."' where semester_id = ".$Edid;
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="Semester.php";
			</script>
			<?php
		}
	}
	
		
	
}
if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_semester where semester_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Semester.php";
		</script>
        <?php
	}
}


if(isset($_GET['Edid']))
{
	$selEdit = "select * from tbl_semester where semester_id = ".$_GET['Edid'];
	$resultEdit = $Con -> query($selEdit);
	$rowEdit = $resultEdit -> fetch_assoc();
	$semester = $rowEdit['semester_name'];
	$Edid = $rowEdit['semester_id'];
}

?>
	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SEMESTER</title>
</head>

<style>
  body {
    background-color: #f8f9fa;
    padding: 40px 0;
  }

  .form-container, .table-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 30px;
  }

  .table td, .table th {
    vertical-align: middle !important;
  }

  .table-hover tbody tr:hover {
    background-color: #f1f1f1;
  }

  .btn-clear {
    background-color: #dc3545;
    color: #fff;
    margin-left: 10px;
  }

  .btn-clear:hover {
    background-color: #c82333;
    color: #fff;
  }
</style>
</head>

<body>
<div class="container">

  <!-- Semester Input Form -->
  <div class="form-container">
    <h3 class="mb-4 text-center">Add / Edit Semester</h3>
    <form id="form1" name="form1" method="post" action="">
      <div class="mb-3 row">
        <label for="txt_semester" class="col-sm-2 col-form-label">Semester</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_semester" id="txt_semester" value="<?php echo $semester; ?>" placeholder="Enter your Semester" />
          <input type="hidden" name="txt_Edid" id="txt_Edid" value="<?php echo $Edid; ?>" />
        </div>
      </div>

      <div class="text-center">
        <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="submit" class="btn btn-clear" name="btn_clear" id="btn_clear" value="Clear" />
      </div>
    </form>
  </div>

  <!-- Semester Table -->
  <div class="table-container">
    <h3 class="mb-4 text-center">Semester Records</h3>
    <form name="form2" method="post" action="">
      <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table-dark">
          <tr>
            <th>S.NO</th>
            <th>Semester</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          $selQry="select * from tbl_semester";
          $result=$Con->query($selQry);
          while($row=$result->fetch_assoc())
          {
            $i++;
          ?>
          <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['semester_name']?></td>
            <td>
              <a href="Semester.php?Delid=<?php echo $row['semester_id']?>" class="btn btn-sm btn-danger me-2">Delete</a>
              <a href="Semester.php?Edid=<?php echo $row['semester_id']?>" class="btn btn-sm btn-warning text-white">Edit</a>
            </td>
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