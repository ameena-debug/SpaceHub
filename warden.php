<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_POST['btn_submit']))
{
	$warden=$_POST['txt_wname'];
	$wemail=$_POST['txt_email'];
	
	$wpwd=$_POST['txt_password'];
	$wcontact=$_POST['txt_contact'];
	$waddress=$_POST['txt_address'];
	$wcontact=$_POST['txt_contact'];
	
	$wphoto=$_FILES['txt_photo']['name'];
	$path=$_FILES['txt_photo']['tmp_name'];
	move_uploaded_file($path,"../Assets/Files/Warden/".$wphoto);
	
	$wproof=$_FILES['txt_proof']['name'];
	$path1=$_FILES['txt_proof']['tmp_name'];
	move_uploaded_file($path1,"../Assets/Files/Warden/".$wproof);
	$selQry="select * from tbl_warden where warden_email='".$wemail."'";
		$rowadmin=$Con->query($selQry);
		if($datacourse=$rowadmin->fetch_assoc())
		{
			?>
            
			<script>
			alert("Already exists");
			window.location="warden.php";
			</script>
			<?php
	}
	else
	{
	
	$insQry="insert into        tbl_warden(warden_name,warden_email,warden_contact,warden_passwd,warden_address,warden_photo,warden_proof) values('".$warden."','".$wemail."','".$wcontact."','".$wpwd."','".$waddress."','".$wphoto."','".$wproof."')";
	 if($Con->query($insQry))
	    {
			?>
            <script>
		    alert("Record Saved");
		    window.location="warden.php";
		    </script>
            <?php
		}


}
}

?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Warden Registartion</title>
</head>

 <style>
    body {
      background-color: #f8f9fa;
      
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-container {
      background: #fff;
      
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    .form-container h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #2c5364;
      font-weight: 600;
    }
    table {
      width: 100%;
    }
    table td {
      padding: 12px;
      border: none !important; /* remove ugly borders */
      vertical-align: middle;
    }
    input, textarea {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      transition: border 0.3s, box-shadow 0.3s;
    }
    input:focus, textarea:focus {
      border-color: #2c5364;
      box-shadow: 0 0 6px rgba(44, 83, 100, 0.4);
      outline: none;
    }
    input[type="file"] {
      border: none;
    }
    #btn_submit {
      background: #2c5364;
      color: #fff;
      font-weight: bold;
      border: none;
      border-radius: 6px;
     
      transition: background 0.3s;
    }
    #btn_submit:hover {
      background: #203a43;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-container">
    <h3>Warden Registration</h3>
    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
      <table>
        <tr>
          <td width="120">Name</td>
          <td>
            <input type="text" name="txt_wname" id="txt_wname"  
              required title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
              pattern="^[A-Z]+[a-zA-Z ]*$" placeholder="Enter name"/>
          </td>
        </tr>
        <tr>
          <td>Email</td>
          <td>
            <input type="email" name="txt_email" id="txt_email" placeholder="Enter Email" required />
          </td>
        </tr>
        <tr>
          <td>Password</td>
          <td>
            <input type="text" name="txt_password" id="txt_password" 
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter Password"/>
          </td>
        </tr>
        <tr>
          <td>Contact</td>
          <td>
            <input type="text" name="txt_contact" id="txt_contact" 
              pattern="[7-9]{1}[0-9]{9}"  required  placeholder="Enter contact" />
          </td>
        </tr>
        <tr>
          <td>Address</td>
          <td>
            <textarea name="txt_address" id="txt_address3" cols="45" rows="4" required placeholder="Enter address"></textarea>
          </td>
        </tr>
        <tr>
          <td>Photo</td>
          <td>
            <input type="file" name="txt_photo" id="txt_photo" required />
          </td>
        </tr>
        <tr>
          <td>Proof</td>
          <td>
            <input type="file" name="txt_proof" id="txt_proof" required />
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html
<?php
include("Footer.php");
?>