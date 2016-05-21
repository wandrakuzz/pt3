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
        <div class="form-group">
            <label for="staffphone" class="col-sm-3 control-label">Phone No.</label>
              <div class="col-sm-7">
                <input name="phone" type="text" class="form-control" placeholder="Customer Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone_num']; ?>" required>
              </div>
        </div>
        <div class="form-group">
            <label for="staffemail" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-7">
                <input name="email" type="text" class="form-control" placeholder="Customer Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_email']; ?>" required>
              </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
        <?php if (isset($_GET['edit'])) { ?>
        <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_ID']; ?>">
        <button class="btn btn-primary" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Update</button>
        <?php } else { ?>
        <button class="btn btn-success" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Create</button>
        <?php } ?>
        <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"> Clear</button>
        </div>
      </div>
      </form>
    </div>
    </div>

<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
      <h2>Staff Lists</h2>

      <table class="table table-striped table-bordered">
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
            <a href="staffs.php?edit=<?php echo $readrow['fld_staff_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
            <a href="staffs.php?delete=<?php echo $readrow['fld_staff_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          </td>
        </tr>
        <?php
        }
        $conn = null;
        ?>
      </table>
    </div>
  </div>
</div>
</div>
</body>
</html>
