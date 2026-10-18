<?php
include("../Assets/Connection/Connection.php");


include("Header.php");




	
	
	?>

<a href="Studentlist.php"></a>























<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Details</title>

<style>
  body {
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  form {
    margin: 40px auto;
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
  }

  th, td {
    padding: 12px 15px;
    text-align: center;
  }

  th {
    background-color: #09334fff;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 14px;
  }

  tr:nth-child(even) {
    background-color: #f8f9fa;
  }

  tr:hover {
    background-color: #f1f7fd;
  }

  td {
    border-bottom: 1px solid #ddd;
    font-size: 14px;
  }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <h2>Payment Details</h2>
  <table>
    <tr>
      <th>S.no</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Photo</th>
      <th>Department</th>
      <th>Course</th>
      <th>Semester</th>
      <th>Academic Year</th>
      <th>Amount</th>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_payment p 
             inner join tbl_student s on p.student_id=s.student_id 
             inner Join tbl_course c on s.course_id = c.course_id 
             inner join tbl_department d on c.department_id=d.department_id 
             inner join tbl_semester m on s.semester_id=m.semester_id 
             inner join tbl_academicyear a on s.academicyear_id=a.academicyear_id ";
	$result=$Con->query($selQry);
	while($studentdata=$result->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $studentdata['student_name']?></td>
      <td><?php echo $studentdata['student_email']?></td>
      <td><?php echo $studentdata['student_contact']?></td>
<td><img src="../Assets/Files/Student/<?php echo $studentdata['student_photo']?>" width="60" height="60" style="border-radius:6px;"/></td>
      <td><?php echo $studentdata['department_name']?></td>
      <td><?php echo $studentdata['department_name']?></td>
      <td><?php echo $studentdata['course_name']?></td>
      <td><?php echo $studentdata['semester_name']?></td>
      <td><?php echo $studentdata['academicyear_name']?></td>
      <td><?php echo $studentdata['payment_amount']?></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>


<?php
include("Footer.php");
?>