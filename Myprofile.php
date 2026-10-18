<?php

include("../Assets/Connection/Connection.php");

include("Header.php");

$selQry="select * from tbl_warden where warden_id='".$_SESSION['wid']."' ";
	$studentrow = $Con->query($selQry);
	$studentdata = $studentrow->fetch_assoc(); 
	
	
	?>











<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyProfile</title>
<style></style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="390" border="1">
    <tr>
      <td colspan="2"> <img src="../Assets/Files/Warden/<?php echo $studentdata['warden_photo']?>" height="150"/></td>
    </tr>
    <tr>
      <td width="122">Name</td>
      <td width="252"><?php echo $studentdata['warden_name']?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $studentdata['warden_email']?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php echo $studentdata['warden_contact']?></td>
    </tr>
    
    <tr>
      <td>Address</td>
      <td><?php echo $studentdata['warden_address']?></td>
    </tr>
    <tr>
      <td>proof</td>
      <td><?php echo $studentdata['warden_proof']?></td>
    </tr>
    
    <tr>
      <td colspan="2"><a href="Editprofile.php">Editprofile</a>
       <a href="ChangePassword.php">ChangePassword</a></td>
    </tr>
  </table>
 
</form>
</body>
</html> -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyProfile</title>

<style type="text/css">
  body {
   
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  form {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 0;
  }

  table {
    width: 500px;
    background-color: #fff;
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    padding: 20px;
    border-collapse: separate;
    border-spacing: 0 15px;
  }

  td {
    padding: 12px;
    font-size: 15px;
  }

  td[colspan="2"] {
    text-align: center;
  }

  img {
    display: block;
    margin: 20px auto;
    border-radius: 10px;
    border: 3px solid #2980b9;
    max-height: 150px;
  }

  .linkbutton {
    /* display: inline-block; */
    margin: 10px 10px 0 10px;
    padding: 8px 15px;
    background-color: #2980b9;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-weight: 500;
  }

  
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <td colspan="2">
        <img src="../Assets/Files/Warden/<?php echo $studentdata['warden_photo']?>" height="150"/>
      </td>
    </tr>
    <tr>
      <td width="122">Name</td>
      <td width="252"><?php echo $studentdata['warden_name']?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $studentdata['warden_email']?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php echo $studentdata['warden_contact']?></td>
    </tr>
    
    <tr>
      <td>Address</td>
      <td><?php echo $studentdata['warden_address']?></td>
    </tr>
   
    <tr>
      <td colspan="2">
        <a class="linkbutton" href="Editprofile.php">Edit Profile</a>
        <a class="linkbutton" href="ChangePassword.php">Change Password</a>
      </td>
    </tr>
  </table>
</form>
</body>
</html>




<?php
include("Footer.php");
?>