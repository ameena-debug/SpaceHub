<?php  
include("../Assets/Connection/Connection.php"); 


include("Header.php");   
$sid = $_GET['sid'];

$i = 0;

// Fetch all approved leaves for the student
$qry = "SELECT * FROM tbl_leave WHERE student_id = '$sid' AND leave_status = '1' ORDER BY leave_fromdate";
$result = mysqli_query($Con, $qry);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Month-Wise Leave Report</title>
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
    margin: 0 auto;
  }

  .table th, .table td {
    vertical-align: middle !important;
    text-align: center;
  }

  .table-hover tbody tr:hover {
    background-color: #f1f1f1;
  }

  a.btn-action {
    display: inline-block;
    padding: 4px 10px;
    font-size: 0.85rem;
    color: #fff;
    background-color: #0d6efd;
    border-radius: 5px;
    text-decoration: none;
  }

  a.btn-action:hover {
    background-color: #0b5ed7;
    color: #fff;
  }
  .table td[rowspan] {
      vertical-align: middle !important;
      text-align: center !important;
  }
</style>
</head>

<body>
<div class="container table-container">
    <h3 class="mb-4 text-center">Student Leave Records</h3>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th>Month</th>
                <th>Year</th>
                <th>Leave Date</th>
                <th>Total Days</th>
                <th>Total Leaves</th>
                <th>Total Presents</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
$prevMonth = "";
$prevYear = "";
$rowspanStarted = false;
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
    $from = strtotime($row['leave_fromdate']);
    $to = strtotime($row['leave_todate']);

    while($from <= $to) {
        $leaveDate = date('Y-m-d', $from);
        $month = date('n', $from);
        $year = date('Y', $from);
        $monthName = date('F', $from);

        // New month block
        if($prevMonth != $month || $prevYear != $year) {
            $leaveCount = 0;

            $recountQry = "SELECT * FROM tbl_leave WHERE student_id = '$sid' AND leave_status = '1'";
            $recountResult = mysqli_query($Con, $recountQry);

            while($inner = mysqli_fetch_assoc($recountResult)) {
                $inFrom = strtotime($inner['leave_fromdate']);
                $inTo = strtotime($inner['leave_todate']);

                while($inFrom <= $inTo) {
                    if(date('n', $inFrom) == $month && date('Y', $inFrom) == $year) {
                        $leaveCount++;
                    }
                    $inFrom = strtotime("+1 day", $inFrom);
                }
            }

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $presentCount = $daysInMonth - $leaveCount;
            $rowspan = $leaveCount;

            $rowspanStarted = false;
            $prevMonth = $month;
            $prevYear = $year;
        }

        $i++;
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $monthName; ?></td>
                <td><?php echo $year; ?></td>
                <td><?php echo date('d-m-Y', $from); ?></td>

                <?php if(!$rowspanStarted) { ?>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo $daysInMonth; ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo $leaveCount; ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo $presentCount; ?></td>
                  <td rowspan="<?php echo $rowspan; ?>">
<?php
    // Check if payment already added for this student in this month/year
    $rentCheck = mysqli_query(
        $Con,
        "SELECT * FROM tbl_payment 
         WHERE student_id = '$sid' 
         AND MONTH(payment_date) = '$month'
         AND YEAR(payment_date) = '$year'"
    );

    if (mysqli_num_rows($rentCheck) > 0) {
        echo '<span class="btn-action" style="background-color:white;">Already Added</span>';
    } else {
?>
        <a href="Rent.php?sid=<?php echo $row['student_id']?>&leaveCount=<?php echo $leaveCount; ?>&month=<?php echo $month; ?>&year=<?php echo $year; ?>" 
           class="btn-action">Add Rent</a>
<?php
    }
?>
</td>


                <?php 
                    $rowspanStarted = true;
                } 
                ?>
            </tr>
<?php
        $from = strtotime("+1 day", $from);
    }
}
?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Footer.php")
?>

