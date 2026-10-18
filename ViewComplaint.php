<?php 
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Complaints</title>

<style>
body {
    background: #f4f7f8;
    font-family: Arial, sans-serif;
    color: #333;
    padding: 20px;
}

/* Table Styling like timetable */
form table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}

form th, form td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: center;
}

form th {
    background-color: #3498db; /* timetable header color */
    color: #fff;
    font-weight: bold;
    font-size: 15px;
}

/* Zebra stripes only for tbody rows */
form tbody tr:nth-child(even) td {
    background-color: #f9f9f9; /* zebra stripes */
}

/* Hover effect only for tbody rows */
form tbody tr:hover td {
    background-color: #e1f0ff; /* lighter blue hover */
}

/* Remove hover effect from header */
form thead tr:hover {
    background-color: transparent !important;
}

/* Student info column styling */
td.student-info {
    text-align: left;
    white-space: pre-line;
    padding-left: 10px;
}

/* Action button styled like timetable buttons */
a {
    display: inline-block;
    padding: 6px 12px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    transition: background 0.3s;
}

a:hover {
    background-color: #2980b9;
}

/* Responsive table container */
.table-responsive {
    overflow-x: auto;
}
</style>

</head>

<body>

<h2 style="text-align:center; margin-bottom: 30px;">Student Complaints</h2>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <div class="table-responsive">
    <table>
      <thead>
        <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Student Info</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $i=0;
      $selQry="SELECT * FROM tbl_complaint c INNER JOIN tbl_student s ON c.student_id=s.student_id";
      $result=$Con->query($selQry);
      while($rowdata=$result->fetch_assoc())
      {
          $i++;
      ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo htmlspecialchars($rowdata['complain_title']); ?></td>
            <td><?php echo htmlspecialchars($rowdata['complain_content']); ?></td>
            <td class="student-info">
                <?php echo htmlspecialchars($rowdata['student_name']); ?><br>
                <?php echo htmlspecialchars($rowdata['student_email']); ?><br>
                <?php echo htmlspecialchars($rowdata['student_contact']); ?>
            </td>
            <td>
                <a href="Reply.php?cid=<?php echo $rowdata['complaint_id']?>">Reply</a>
            </td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
  </div>
</form>

</body>
</html>

<?php include("Footer.php"); ?>
