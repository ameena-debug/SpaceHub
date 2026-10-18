<?php 
include("../Assets/Connection/Connection.php");


include("Header.php");
?>

<!-- DOCTYPE and HTML structure -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Complaints</title>

<style>
/* Form Table Styling */
form {
    max-width: 800px;
    margin: 50px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    border-radius: 12px;
    overflow: hidden;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 14px;
}

th {
    background-color: #3498db;
    color: #fff;
    font-weight: 600;
}

tr:nth-child(even) td {
    background-color: #f8f9fa;
}

tr:hover td {
    background-color: #f1f7fd;
}

/* Action link styling */
a {
    display: inline-block;
    padding: 6px 12px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #2980b9;
}

/* Student info column styling */
td.student-info {
    text-align: left;
    white-space: pre-line;
    padding-left: 10px;
}
</style>
</head>

<body>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="392" border="1">
    <tr>
        <th>S.No</th>
        <th>week</th>
        <th>Food Details</th>
        
    </tr>
    <?php
    $i=0;
    $selQry="select *
            from tbl_food f inner join tbl_week w on f.week_id=w.week_id";;
    $result=$Con->query($selQry);
    while($rowdata=$result->fetch_assoc())
     {
      $i++;
      ?>
      <tr>
        <td><?php echo $i?></td>
        <td><?php echo $rowdata['week_name']?></td>
        <td><?php echo $rowdata['foodtimetable_details']?></td>
        
      </tr>
      <?php
  }
    ?>
  </table>
</form>

</body>
</html>


<?php include("Footer.php"); ?>
