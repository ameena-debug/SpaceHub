<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Details</title>

<!-- ✅ Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  .container-box {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    margin: 50px auto;
    padding: 30px;
    max-width: 900px;
    transition: transform 0.3s ease;
  }

  .container-box:hover {
    transform: scale(1.01);
  }

  .table {
    margin-top: 15px;
  }

  .table thead {
    background-color: #2980b9;
    color: #fff;
  }

  .badge-pending {
    background-color: #f39c12;
    color: #fff;
  }

  .badge-paid {
    background-color: #27ae60;
    color: #fff;
  }

  .page-title {
    text-align: center;
    color: #2980b9;
    font-weight: bold;
    margin-bottom: 20px;
    font-size: 24px;
  }

</style>
</head>

<body>

<div class="container">
  <div class="container-box">
    <h2 class="page-title">💳 Payment History</h2>

    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead>
          <tr>
            <th style="width: 70px;">S.No</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $selQry = "SELECT * FROM tbl_payment WHERE student_id='" . $_SESSION['sid'] . "'";
          $result = $Con->query($selQry);
          while ($rowdata = $result->fetch_assoc()) {
            $i++;
          ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td>₹<?php echo htmlspecialchars($rowdata['payment_amount']); ?></td>
              <td><?php echo htmlspecialchars($rowdata['payment_date']); ?></td>
              <td>
                <?php
                if ($rowdata['payment_status'] == 0) {
                  echo '<span class="badge badge-pending">Pending</span>';
                } else if ($rowdata['payment_status'] == 2) {
                  echo '<span class="badge badge-paid">Paid</span>';
                }
                ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include("Footer.php");
?>
