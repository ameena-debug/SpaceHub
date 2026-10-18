<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>




















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FEEDBACK</title>
</head>

<style>
  body {
    background-color: #f8f9fa;
    padding: 40px 0;
  }

  .table-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 900px;
    margin: 0 auto;
  }

  .table-container table {
    width: 100%;
  }

  .table-container th, .table-container td {
    text-align: center;
    vertical-align: middle;
  }

  .table-hover tbody tr:hover {
    background-color: #f1f1f1;
  }
</style>
</head>
<body>

<div class="container">

  <!-- Feedback Table -->
  <div class="table-container">
    <h3 class="mb-4 text-center">Student Feedback</h3>
    <form id="form2" name="form2" method="post" action="">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>S.NO</th>
            <th>Content</th>
            <th>User Details</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $selQry = "SELECT * FROM tbl_feedback f INNER JOIN tbl_student s ON f.student_id = s.student_id";
          $result = $Con->query($selQry);
          while($row = $result->fetch_assoc()) {
              $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['feedback_content']; ?></td>
            <td>
              <p><?php echo $row['student_name']; ?></p>
              <p><?php echo $row['student_email']; ?></p>
            </td>
          </tr>
          <?php } ?>
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