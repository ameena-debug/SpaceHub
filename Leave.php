<?php
include("../Assets/Connection/Connection.php");


include("Header.php");
if(isset($_GET['Aid']))
{
    $upQry="update tbl_leave set leave_status=1 where leave_id='".$_GET['Aid']."'";
    if($Con->query($upQry))
    {
        ?>
        <script>
        alert("Accepted");
        window.location="Leave.php?sid=<?php echo $_GET['sid']?>";
        </script>
        <?php
    }
}
if(isset($_GET['Rid']))
{
    $upQry="update tbl_leave set leave_status=2 where leave_id='".$_GET['Rid']."'";
    if($Con->query($upQry))
    {
        ?>
        <script>
        alert("Rejected");
        window.location="Leave.php?sid=<?php echo $_GET['sid']?>";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Leave Requests</title>
</head>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f9f9f9;
      font-family: Arial, sans-serif;
    }
    .table thead {
      background: #f2f2f2;
      font-weight: bold;
      text-align: center;
    }
    .table tr td {
      vertical-align: middle;
      text-align: center;
    }
    .status-pending {
      color: orange;
      font-weight: bold;
    }
    .status-approved {
      color: green;
      font-weight: bold;
    }
    .status-declined {
      color: red;
      font-weight: bold;
    }
    .btn-action {
      padding: 4px 10px;
      border-radius: 4px;
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2 class="text-center text-dark mb-4">Student Leave Requests</h2>

  <div class="table-responsive shadow">
    <table class="table table-bordered table-hover align-middle">
      <tr>
        <th>S.No</th>
        <th>Leave Date</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>

      <?php
      $i=0;
      $selQry="select * from tbl_leave where student_id='".$_GET['sid']."'";
      $result=$Con->query($selQry);
      while($studentdata=$result->fetch_assoc())
      {
          $i++;
      ?>
      <tr class="<?php echo ($i%2==0)?'table-light':'table-white'; ?>">
        <td><?php echo $i?></td>
        <td><?php echo $studentdata['leave_date']?></td>
        <td><?php echo $studentdata['leave_fromdate']?></td>
        <td><?php echo $studentdata['leave_todate']?></td>
        <td>
          <?php 
            if($studentdata['leave_status']==0) {
                echo "<span class='status-pending'>Pending</span>";
            } else if($studentdata['leave_status']==1) {
                echo "<span class='status-approved'>Approved</span>";
            } else if($studentdata['leave_status']==2) {
                echo "<span class='status-declined'>Declined</span>";
            }
          ?>
        </td>
        <td>
          <?php 
            if($studentdata['leave_status']==0) {
          ?>
              <a href="Leave.php?Aid=<?php echo $studentdata['leave_id']?>&sid=<?php echo $_GET['sid']?>" 
                 class="btn btn-success btn-sm btn-action me-2">Accept</a>
              <a href="Leave.php?Rid=<?php echo $studentdata['leave_id']?>&sid=<?php echo $_GET['sid']?>" 
                 class="btn btn-danger btn-sm btn-action">Reject</a>
          <?php 
            } else if($studentdata['leave_status']==1) {
          ?>
              <a href="Leave.php?Rid=<?php echo $studentdata['leave_id']?>&sid=<?php echo $_GET['sid']?>" 
                 class="btn btn-danger btn-sm btn-action">Reject</a>
          <?php 
            } else if($studentdata['leave_status']==2) {
          ?>
              <a href="Leave.php?Aid=<?php echo $studentdata['leave_id']?>&sid=<?php echo $_GET['sid']?>" 
                 class="btn btn-success btn-sm btn-action">Accept</a>
          <?php 
            }
          ?>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include("Footer.php");
?>
