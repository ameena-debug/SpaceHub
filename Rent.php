<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$baseRent = 5250;
$perLeaveDeduction = 85;

// Get leave count and student ID from URL
$sid = isset($_GET['sid']) ? $_GET['sid'] : 0;
$leaveCount = isset($_GET['leaveCount']) ? (int)$_GET['leaveCount'] : 0;

///// ADDED — GET MONTH & YEAR COMING FROM Add Rent BUTTON /////
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

///// ADDED — CREATE PAYMENT DATE BASED ON SELECTED MONTH /////
$selectedPaymentDate = $year . "-" . $month . "-01";


// Calculate total amount
$totalAmount = $baseRent - ($perLeaveDeduction * $leaveCount);

if (isset($_POST['btn_submit'])) {
    $amount = $_POST['txt_amt'];

    ///// CHANGED — REPLACED CURDATE() WITH SELECTED PAYMENT DATE /////
    $insQry = "INSERT INTO tbl_payment (payment_amount, payment_date, student_id) 
               VALUES ('" . $amount . "', '$selectedPaymentDate', '" . $sid . "')";
    if ($Con->query($insQry)) {
        ?>
        <script>
            alert("Payment inserted successfully!");
            window.location = "ViewLeave.php?sid=<?php echo $sid; ?>";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>RENT</title>
<style>
  body {
    background-color: #f8f9fa;
    padding: 40px 0;
  }
  .form-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 500px;
    margin: 0 auto;
  }
  .form-container .btn-submit {
    width: 120px;
  }
</style>
</head>
<body>
<div class="container">
  <div class="form-container">
    <h3 class="mb-4 text-center">Student Rent Details</h3>

    <p><strong>Month:</strong> <?php echo date("F", mktime(0,0,0,$month,1)); ?></p>
    <p><strong>Year:</strong> <?php echo $year; ?></p>

    <p><strong>Total Leaves:</strong> <?php echo $leaveCount; ?></p>
    <p><strong>Base Rent:</strong> ₹<?php echo $baseRent; ?></p>
    <p><strong>Deduction per Leave:</strong> ₹<?php echo $perLeaveDeduction; ?></p>
    <p><strong>Total Payable Rent:</strong> ₹<?php echo $totalAmount; ?></p>

    <form id="form1" name="form1" method="post" action="">
      <div class="mb-3 row">
        <label for="txt_amt" class="col-sm-3 col-form-label">Amount</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_amt" id="txt_amt" 
                 value="<?php echo $totalAmount; ?>" readonly />
        </div>
      </div>

      <div class="text-center">
        <input type="submit" class="btn btn-primary btn-submit" 
               name="btn_submit" id="btn_submit" value="Submit" />
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
