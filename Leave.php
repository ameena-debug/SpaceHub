<?php
include("../Assets/Connection/Connection.php");
include("Header.php");


// -------------------------
// Handle leave apply (student)
// -------------------------
if (isset($_POST["btn_submit"])) {
    $fdate = $_POST['txt_fdate'];
    $tdate = $_POST['txt_tdate'];

    $insQry = "INSERT INTO tbl_leave (leave_date, leave_fromdate, leave_todate, student_id) 
               VALUES (CURDATE(), '$fdate', '$tdate', '" . $_SESSION['sid'] . "')";
    if ($Con->query($insQry)) {
        echo "<script>alert('Leave Applied'); window.location='Leave.php';</script>";
    }
}

// -------------------------
// Handle delete leave (student)
// -------------------------
if (isset($_GET['Delid'])) {
    $delQry = "DELETE FROM tbl_leave WHERE leave_id='" . $_GET['Delid'] . "'";
    if ($Con->query($delQry)) {
        echo "<script>alert('Leave Deleted'); window.location='Leave.php';</script>";
    }
}

// -------------------------
// Handle admin actions
// -------------------------
if (isset($_GET['Aid'])) {
    $upQry = "UPDATE tbl_leave SET leave_status=1 WHERE leave_id='" . $_GET['Aid'] . "'";
    if ($Con->query($upQry)) {
        echo "<script>alert('Leave Approved'); window.location='Leave.php?sid=" . $_GET['sid'] . "';</script>";
    }
}

if (isset($_GET['Rid'])) {
    $upQry = "UPDATE tbl_leave SET leave_status=2 WHERE leave_id='" . $_GET['Rid'] . "'";
    if ($Con->query($upQry)) {
        echo "<script>alert('Leave Rejected'); window.location='Leave.php?sid=" . $_GET['sid'] . "';</script>";
    }
}

// -------------------------
// Determine which student’s leaves to show
// -------------------------
if (isset($_GET['sid'])) {
    // Admin view
    $student_id = $_GET['sid'];
    $is_admin_view = true;
} else {
    // Student view
    $student_id = $_SESSION['sid'];
    $is_admin_view = false;
}

// Fetch leaves
$selQry = "SELECT * FROM tbl_leave WHERE student_id='$student_id' ORDER BY leave_id DESC";
$result = $Con->query($selQry);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Leave Page</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4ff;
    color: #333;
    margin: 0;
    padding: 0;
}
.container {
    width: 90%;
    margin: 20px auto;
}
form.leave-form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    margin: 0 auto 30px auto;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
form.leave-form h2 {
    text-align: center;
    margin-bottom: 15px;
}
form.leave-form label {
    display: block;
    margin: 10px 0 5px;
}
form.leave-form input[type=date],
form.leave-form input[type=submit] {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
form.leave-form input[type=submit] {
    background: #2980b9;
    color: #fff;
    border: none;
    margin-top: 15px;
    cursor: pointer;
}
form.leave-form input[type=submit]:hover {
    background: #1f618d;
}

table.leave-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}
table.leave-table th,
table.leave-table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}
table.leave-table th {
    background: #2980b9;
    color: #fff;
}
table.leave-table tr:nth-child(even) {
    background: #f9f9f9;
}
a.action-link {
    color: #2980b9;
    text-decoration: none;
}
a.action-link:hover {
    text-decoration: underline;
}
.status-pending { color: orange; font-weight: bold; }
.status-approved { color: green; font-weight: bold; }
.status-declined { color: red; font-weight: bold; }
</style>
</head>
<body>
<div class="container">
<?php if (!$is_admin_view): ?>
<!-- Student Leave Apply Form -->
<form method="post" class="leave-form">
    <h2>Apply Leave</h2>
    <label>From Date</label>
    <input type="date" name="txt_fdate" required>
    <label>To Date</label>
    <input type="date" name="txt_tdate" required>
    <input type="submit" name="btn_submit" value="Apply Leave">
</form>
<?php endif; ?>

<!-- Leave History Table -->
<table class="leave-table">
    <tr>
        <th>S.No</th>
        <th>Leave Date</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Status</th>
        <?php if ($is_admin_view || !$is_admin_view) echo "<th>Action</th>"; ?>
    </tr>
    <?php
    $i = 0;
    while ($row = $result->fetch_assoc()):
        $i++;
    ?>
    <tr>
        <td><?= $i ?></td>
        <td><?= $row['leave_date'] ?></td>
        <td><?= $row['leave_fromdate'] ?></td>
        <td><?= $row['leave_todate'] ?></td>
        <td>
            <?php 
            if ($row['leave_status']==0) echo "<span class='status-pending'>Pending</span>";
            elseif ($row['leave_status']==1) echo "<span class='status-approved'>Approved</span>";
            else echo "<span class='status-declined'>Declined</span>";
            ?>
        </td>
        <td>
        <?php if (!$is_admin_view && $row['leave_status']==0): ?>
            <a href="Leave.php?Delid=<?= $row['leave_id'] ?>" class="action-link" onclick="return confirm('Delete leave?')">Delete</a>
        <?php elseif ($is_admin_view): ?>
            <?php if ($row['leave_status']==0): ?>
                <a href="Leave.php?Aid=<?= $row['leave_id'] ?>&sid=<?= $student_id ?>" class="action-link">Accept</a> | 
                <a href="Leave.php?Rid=<?= $row['leave_id'] ?>&sid=<?= $student_id ?>" class="action-link">Reject</a>
            <?php elseif ($row['leave_status']==1): ?>
                <a href="Leave.php?Rid=<?= $row['leave_id'] ?>&sid=<?= $student_id ?>" class="action-link">Reject</a>
            <?php elseif ($row['leave_status']==2): ?>
                <a href="Leave.php?Aid=<?= $row['leave_id'] ?>&sid=<?= $student_id ?>" class="action-link">Accept</a>
            <?php endif; ?>
        <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>
</body>
</html>
<?php include("Footer.php"); ?>
