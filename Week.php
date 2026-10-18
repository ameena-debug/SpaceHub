<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_POST['btn_Submit']))
{
	$week=$_POST['txt_week'];
	
	$selQry="select * from tbl_week where week_name='".$week."'";
	$rowweek=$Con->query($selQry);
	if($dataweek=$rowweek->fetch_assoc())
	{
		?>
			<script>
			alert("Already exists");
			window.location="Week.php";
			</script>
			<?php
	}
	else
	{
	
	$insQry="insert into  tbl_week (week_name) values('".$week."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="Week.php";
			</script>
			<?php
		}
	}
}
if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_week where week_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Week.php";
		</script>
        <?php
	}
}

?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WEEK</title>
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

  <!-- Day Input Form -->
  <div class="form-container">
    <h3 class="mb-4 text-center">Add / Edit Day</h3>
    <form id="form1" name="form1" method="post" action="">
      <div class="mb-3 row">
        <label for="txt_week" class="col-sm-2 col-form-label">Day</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_week" id="txt_week" placeholder="Enter Day" />
        </div>
      </div>

      <div class="text-center">
        <input type="submit" class="btn btn-primary" name="btn_Submit" id="btn_Submit" value="Submit" />
        <input type="submit" class="btn btn-clear" name="btn_delete" id="btn_delete" value="Delete" />
      </div>
    </form>
  </div>

  <!-- Week / Day Table -->
  <div class="table-container">
    <h3 class="mb-4 text-center">Day Records</h3>
    <form id="form2" name="form2" method="post" action="">
      <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table-dark">
          <tr>
            <th>S.NO</th>
            <th>Day</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          $selQry="select * from tbl_week";
          $result=$Con->query($selQry);
          while($row=$result->fetch_assoc())
          {
            $i++;
          ?>
          <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['week_name']?></td>
            <td>
              <a href="Week.php?Delid=<?php echo $row['week_id']?>" class="btn btn-sm btn-danger">Delete</a>
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
include("Footer.php")
?>