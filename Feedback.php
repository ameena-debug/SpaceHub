<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$content = "";
$Edid = "";

// ---------- Insert / Update ----------
if (isset($_POST['btn_submit'])) {
    $content = $_POST['txt_feedback'];
    $Edid = $_POST['hid_id']; // Retrieve hidden field (for edit mode)

    if (empty($Edid)) {
        // Insert new feedback
        $insQry = "INSERT INTO tbl_feedback (feedback_content, student_id) 
                   VALUES ('" . $content . "', '" . $_SESSION['sid'] . "')";
        if ($Con->query($insQry)) {
            ?>
            <script>
            alert("Feedback inserted successfully");
            window.location = "Feedback.php";
            </script>
            <?php
        }
    } else {
        // Update existing feedback
        $upQry = "UPDATE tbl_feedback 
                  SET feedback_content = '" . $content . "' 
                  WHERE feedback_id = '" . $Edid . "'";
        if ($Con->query($upQry)) {
            ?>
            <script>
            alert("Feedback updated successfully");
            window.location = "Feedback.php";
            </script>
            <?php
        }
    }
}

// ---------- Delete ----------
if (isset($_GET['Delid'])) {
    $delQry = "DELETE FROM tbl_feedback WHERE feedback_id = '" . $_GET['Delid'] . "'";
    if ($Con->query($delQry)) {
        ?>
        <script>
        alert("Feedback deleted successfully");
        window.location = "Feedback.php";
        </script>
        <?php
    }
}

// ---------- Edit ----------
if (isset($_GET['Edid'])) {
    $selEdit = "SELECT * FROM tbl_feedback WHERE feedback_id = " . $_GET['Edid'];
    $resultEdit = $Con->query($selEdit);
    if ($resultEdit->num_rows > 0) {
        $rowEdit = $resultEdit->fetch_assoc();
        $content = $rowEdit['feedback_content'];
        $Edid = $rowEdit['feedback_id'];
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feedback</title>

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
    padding: 40px 0;
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

  textarea {
    width: 95%;
    height: 80px;
    resize: none;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  input[type="submit"] {
    background-color: #2980b9;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #1f618d;
  }

  a {
    color: #2980b9;
    text-decoration: none;
    font-weight: 600;
  }

  a:hover {
    color: #1f618d;
    text-decoration: underline;
  }

  .feedback-table {
    width: 80%;
    margin: 30px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.2);
    padding: 15px;
  }

  .feedback-table th, .feedback-table td {
    text-align: center;
    padding: 12px;
  }

  .feedback-table th {
    background: #2980b9;
    color: white;
  }

</style>
</head>

<body>

<!-- Feedback Form -->
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <td>Content</td>
      <td>
        <textarea name="txt_feedback" id="txt_feedback" required><?php echo $content; ?></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="hidden" name="hid_id" value="<?php echo $Edid; ?>" />
        <input type="submit" name="btn_submit" id="btn_submit" 
               value="<?php echo empty($Edid) ? 'Submit' : 'Update'; ?>" />
      </td>
    </tr>
  </table>
</form>

<!-- Feedback Display Table -->
<form id="form2" name="form2" method="post" action="">
  <table class="feedback-table" border="1">
    <tr>
      <th>S.No</th>
      <th>Content</th>
      <th colspan="2">Action</th>
    </tr>
    <?php
    $i = 0;
    $selQry = "SELECT * FROM tbl_feedback WHERE student_id='" . $_SESSION['sid'] . "'";
    $result = $Con->query($selQry);
    while ($row = $result->fetch_assoc()) {
        $i++;
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo htmlspecialchars($row['feedback_content']); ?></td>
          <td><a href="Feedback.php?Edid=<?php echo $row['feedback_id']; ?>">Edit</a></td>
          <td><a href="Feedback.php?Delid=<?php echo $row['feedback_id']; ?>" 
                 onclick="return confirm('Are you sure you want to delete this feedback?');">Delete</a></td>
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
