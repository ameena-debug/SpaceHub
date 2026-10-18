<?php
include("../Assets/Connection/Connection.php");


include("Header.php");
$selqry="select * from tbl_student where student_id='".$_SESSION['sid']."'";
$row=$Con->query($selqry);
$data=$row->fetch_assoc();
$pass=$data['student_password'];
if(isset($_POST['btn_cpassword']))
{
	$old=$_POST['txt_opassword'];
    $new=$_POST['txt_npassword'];
	$rpass=$_POST['txt_rpassword'];
	if($pass==$old)
	{
	    if($new==$rpass)
		{
		   $upQry="update tbl_student set student_password='".$new."' where student_id='".$_SESSION['sid']."'";
		   if($Con->query($upQry))
		   {
			   ?>
                <script>
			     alert("password changed");
			      window.location="../Guest/Login.php";
			       </script>
                  <?php
				  } 
				  }
		 else
			{
			 ?>
				<script>
		         alert("Password Mismatched");
		          </script>
                   <?php
                      }
					  }
else
	{
		?>
		<script>
	    alert("invalid password")
        </script>
	    <?php
             }
		 }
	    ?>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
  body {
    margin: 0;
    padding: 0;
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
   a:hover {
    background-color: #1f618d;
  }
</style>
</head>


<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="242" height="193" border="1">
    <tr>
      <td width="92">Old password</td>
      <td width="112"><label for="txt_opassword"></label>
      <input type="text" name="txt_opassword" id="txt_opassword"  value="<?php echo $data['student_password'] ?>"/></td>
    <tr>
      <td>New Password</td>
      <td><label for="txt_npassword"></label>
      <input type="text" name="txt_npassword" id="txt_npassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/></td>
    </tr>
    <tr>
      <td>Re-Type Password</td>
      <td><label for="txt_rpassword"></label>
      <input type="text" name="txt_rpassword" id="txt_rpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/></td>
    </tr>
    <tr>
      <td colspan="2"> <input type="submit" name="btn_cpassword" id="btn_cpassword"  value="change Password" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

<?php
include("Footer.php");
?>