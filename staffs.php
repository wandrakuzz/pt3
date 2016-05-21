<?php
  include_once 'staffs_crud.php';
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Projector and Projection Accessories : Staffs</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
  <?php include_once 'nav_bar.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create Staff</h2>
        </div>

      <form action="staffs.php" class="form-horizontal" method="post">
        <div class="form-group">
            <label for="staffid" class="col-sm-3 control-label">ID</label>
            <div class="col-sm-7">
              <input name="sid" class="form-control" type="text" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_ID']; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="staffname" class="col-sm-3 control-label">Name</label>
              <div class="col-sm-7">
                <input name="name" type="text" class="form-control" placeholder="Customer Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>" required>
              </div>
        </div>
        <div class="form-group">
          <label for="customergender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
            <div class="radio-inline">
              <label>
                <input name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Male") echo "checked"; ?>> Male
              </label>
            </div>
          <div class="radio-inline" required>
            <label>
              <input name="gender" type="radio" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Female") echo "checked"; ?>> Female
            </label>
          </div>
          </div>
        </div>





      </div>
    </div>
  </div>







    <hr>
    <form action="staffs.php" method="post">
      Customer ID
      <input name="sid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_ID']; ?>"> <br>
      Name
      <input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>"> <br>
      Gender
      <input name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?>> Male
      <input name="gender" type="radio" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>> Female <br>
      Phone Number
      <input name="phone" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone_num']; ?>"> <br>
      Email Address
      <input name="email" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>"> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_ID']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Staff ID</td>
        <td>Name</td>
        <td>Gender</td>
        <td>Phone Number</td>
        <td>Email Address</td>
        <td></td>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a148647");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_staff_ID']; ?></td>
        <td><?php echo $readrow['fld_staff_name']; ?></td>
        <td><?php echo $readrow['fld_staff_gender']; ?></td>
        <td><?php echo $readrow['fld_staff_phone_num']; ?></td>
        <td><?php echo $readrow['fld_staff_email']; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $readrow['fld_staff_ID']; ?>">Edit</a>
          <a href="staffs.php?delete=<?php echo $readrow['fld_staff_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
</body>
</html>
