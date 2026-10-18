<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$department="";
$Edid = 0;
if(isset($_POST['btn_submit']))
{
	$department=$_POST['txt_department'];
	$Edid = $_POST['txt_Edid'];
	if($Edid == 0)
	{
		$insQry="insert into tbl_department(department_name) values(' ".$department." ')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="Department.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry = "update  tbl_department set department_name = '".$department."' where department_id = ".$Edid;
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="Department.php";
			</script>
			<?php
		}
	}
	
		
	
}
if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_department where department_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Department.php";
		</script>
        <?php
	}
}


if(isset($_GET['Edid']))
{
	$selEdit = "select * from tbl_department where department_id = ".$_GET['Edid'];
	$resultEdit = $Con -> query($selEdit);
	$rowEdit = $resultEdit -> fetch_assoc();
	$department = $rowEdit['department_name'];
	$Edid = $rowEdit['department_id'];
}

?>
	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DEPARTMENT</title>
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

  <!-- Department Input Form -->
  <div class="form-container">
    <h3 class="mb-4">Add / Edit Department</h3>
    <form id="form1" name="form1" method="post" action="">
      <div class="mb-3 row">
        <label for="txt_department" class="col-sm-2 col-form-label">Department</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_department" id="txt_department" value="<?php echo $department; ?>" placeholder="Enter your Department"/>
          <input type="hidden" name="txt_Edid" id="txt_Edid" value="<?php echo $Edid; ?>" />
        </div>
      </div>

      <div class="text-center">
        <input type="submit" class="btn btn-primary me-2" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="submit" class="btn btn-clear" name="btn_clear" id="btn_clear" value="Clear" />
      </div>
    </form>
  </div>

  <!-- Department Table -->
  <div class="table-container">
    <h3 class="mb-4">Department Records</h3>
    <form name="form2" method="post" action="">
      <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
          <tr>
            <th>S.NO</th>
            <th>Department</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          $selQry="select * from tbl_department";
          $result=$Con->query($selQry);
          while($row=$result->fetch_assoc())
          {
            $i++;
          ?>
          <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['department_name']?></td>
            <td><a href="Department.php?Delid=<?php echo $row['department_id']?>" class="btn btn-sm btn-danger">Delete</a></td>
            <td><a href="Department.php?Edid=<?php echo $row['department_id']?>" class="btn btn-sm btn-warning text-white">Edit</a></td>
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