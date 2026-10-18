<?php
include("../Assets/Connection/Connection.php");


include("Header.php");

if(isset($_GET['Aid'])) {
    $upQry="UPDATE tbl_payment SET payment_status=2 WHERE payment_id='".$_GET['Aid']."'";
    if($Con->query($upQry)) {
        ?>
        <script>
            alert("Payment marked as Paid");
            window.location="Studentpayment.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Payment Details</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
body {
    background: #f4f7f8;
    font-family: Arial, sans-serif;
    color: #333;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
}

/* Back button styling */
.btn-back {
    background-color: #3498db;
    color: #fff;
    font-weight: bold;
    border-radius: 6px;
    padding: 8px 16px;
    text-decoration: none;
    transition: background 0.3s;
}

.btn-back:hover {
    background-color: #2980b9;
}

/* Table Styling like timetable */
.table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}

.table th, .table td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: center;
}

.table thead th {
    background-color: #3498db; /* timetable header color */
    color: #fff;
    font-weight: bold;
    font-size: 15px;
}

.table tbody tr:nth-child(even) td {
    background-color: #f9f9f9; /* zebra stripes */
}

.table tbody tr:hover td {
    background-color: #f1f7fd; /* hover effect */
}

/* Student Photo */
.student-photo {
    width: 60px;
    height: 60px;
    border-radius: 5px;
    object-fit: cover;
    border: 1px solid #ccc;
}

/* Action buttons styled like timetable delete button */
.btn-paid, .btn-disabled {
    display: inline-block;
    padding: 6px 12px;
    background-color: #3498db;
    color: #fff;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    margin: 2px;
    transition: background 0.3s;
}

.btn-paid:hover {
    background-color: #2980b9;
}

.btn-disabled {
    background-color: #3498db;
    cursor: not-allowed;
}

/* Form select styling */
form select {
    width: 100%;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
</style>
</head>
<body>

<div class="container mt-4">
  <h2 class="text-center text-dark mb-4">Student Payment Details</h2>

  <div class="text-center mb-3">
    <a href="Studentlist.php" class="btn btn-back">← Back to Student List</a>
  </div>

  <form id="form1" name="form1" method="post" action="">
    <div class="table-responsive shadow">
        <!-- Payment Status Filter -->
  <div class="row mb-3">
    <div class="col-md-6 offset-md-3">
      <select id="statusFilter" class="form-select">
        <option value="all">Show All Payments</option>
        <option value="paid">Paid Only</option>
        <option value="unpaid">Unpaid Only</option>
      </select>
    </div>
  </div>

      <table class="table table-bordered table-hover align-middle">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Photo</th>
            <th>Department</th>
            <th>Course</th>
            <th>Semester</th>
            <th>Academic Year</th>
            <th>Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $i=0;
          $selQry="SELECT * FROM tbl_payment p 
                   INNER JOIN tbl_student s ON p.student_id=s.student_id 
                   INNER JOIN tbl_course c ON s.course_id=c.course_id 
                   INNER JOIN tbl_department d ON c.department_id=d.department_id 
                   INNER JOIN tbl_semester m ON s.semester_id=m.semester_id 
                   INNER JOIN tbl_academicyear a ON s.academicyear_id=a.academicyear_id";
          $result=$Con->query($selQry);
          while($studentdata=$result->fetch_assoc()) {
              $i++;
        ?>
          <tr>
            <td><?php echo $i?></td>
            <td><?php echo $studentdata['student_name']?></td>
            <td><?php echo $studentdata['student_email']?></td>
            <td><?php echo $studentdata['student_contact']?></td>
            <td>
              <img src="../Assets/Files/Student/<?php echo $studentdata['student_photo']?>" 
                   alt="Photo" width="60" height="60" class="student-photo">
            </td>
            <td><?php echo $studentdata['department_name']?></td>
            <td><?php echo $studentdata['course_name']?></td>
            <td><?php echo $studentdata['semester_name']?></td>
            <td><?php echo $studentdata['academicyear_name']?></td>
            <td class="fw-bold text-dark">₹<?php echo $studentdata['payment_amount']?></td>
            <td>
              <?php if($studentdata['payment_status'] != 2) { ?>
                  <a href="Studentpayment.php?Aid=<?php echo $studentdata['payment_id']?>" 
                     class="btn btn-paid btn-sm btn-custom">
                     Mark as Paid
                  </a>
              <?php } else { ?>
                  <button disabled class="btn btn-disabled btn-sm btn-custom">
                      Already Paid
                  </button>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('statusFilter').addEventListener('change', function() {
  const filterValue = this.value.toLowerCase();
  const rows = document.querySelectorAll('table tbody tr');

  rows.forEach(row => {
    const actionCell = row.querySelector('td:last-child');
    if (!actionCell) return;

    const paidButton = actionCell.querySelector('.btn-disabled');
    const unpaidButton = actionCell.querySelector('.btn-paid');

    let isPaid = false;
    if (paidButton && paidButton.textContent.trim().includes('Already Paid')) {
      isPaid = true;
    }

    if (filterValue === 'all') {
      row.style.display = '';
    } else if (filterValue === 'paid' && isPaid) {
      row.style.display = '';
    } else if (filterValue === 'unpaid' && !isPaid) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});
</script>

</body>
</html>

<?php
include("Footer.php");
?>
