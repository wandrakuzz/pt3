<?php
  include_once 'customers_crud.php';
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projector and Projection Accessories : Customers</title

    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

  <?php include_once 'nav_bar.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create Customer</h2>
        </div>

        <form action="customers.php" class="form-horizontal" method="post">
          <div class="form-group">
              <label for="customerid" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-7">
                <input name="cid" type="text" class="form-control" placeholder="Customer ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_ID']; ?>" required>
              </div>
            </div>
            <div class="form-group">
                <label for="customername" class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-7">
                    <input name="name" type="text" class="form-control" placeholder="Customer Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>" required>
                  </div>
            </div>
            <div class="form-group">
                <label for="customeremail" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-7">
                    <input name="email" type="text" class="form-control" placeholder="Customer Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_email']; ?>" required>
                  </div>
            </div>
            <div class="form-group">
                <label for="customerphone" class="col-sm-3 control-label">Phone No</label>
                  <div class="col-sm-7">
                    <input name="phone" type="text" class="form-control" placeholder="Customer Phone No" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone_num']; ?>" required>
                  </div>
            </div>
            <div class="form-group">
              <label for="customergender" class="col-sm-3 control-label">Gender</label>
              <div class="col-sm-9">
                <div class="radio-inline">
                  <label>
                    <input name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_warrantylength']=="Male") echo "checked"; ?>> Male
                  </label>
                </div>
              <div class="radio-inline" required>
                <label>
                  <input name="gender" type="radio" value="" <?php if(isset($_GET['edit'])) if($editrow['fld_warrantylength']=="Female") echo "checked"; ?>> Female
                </label>
              </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
              <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_ID']; ?>">
              <button class="btn btn-primary" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Update</button>
              <?php } else { ?>
              <button class="btn btn-success" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Create</button>
              <?php } ?>
              <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"> Clear</button>
              </div>
            </div>
          </div>
          </form>
        </div>


<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
      <h2>Customer List</h2>
      <table class="table table-striped table-bordered">
        <tr>
          <td>Customer ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Phone Number</td>
          <td>Gender</td>
          <td></td>
        </tr>
        <?php
        // Read
        $per_page = 5;
        if (isset($_GET["page"]))
          $page = $_GET["page"];
        else
          $page = 1;
        $start_from = ($page-1) * $per_page;
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("select * from tbl_customers_a148647 LIMIT $start_from, $per_page");
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
              echo "Error: " . $e->getMessage();
        }
        foreach($result as $readrow) {
        ?>
        <tr>
          <td><?php echo $readrow['fld_customer_ID']; ?></td>
          <td><?php echo $readrow['fld_customer_name']; ?></td>
          <td><?php echo $readrow['fld_customer_email']; ?></td>
          <td><?php echo $readrow['fld_customer_phone_num']; ?></td>
          <td><?php echo $readrow['fld_customer_gender']; ?></td>
          <td>
            <a href="customers.php?edit=<?php echo $readrow['fld_customer_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit</a>
            <a href="customers.php?delete=<?php echo $readrow['fld_customer_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button"> Delete</a>
          </td>
        </tr>
        <?php } ?>
        </table>
      </div>
    </div>
  </div>

      <div class="row">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <nav>
              <ul class="pagination">
                <?php
                  try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a148647");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    $total_records = count($result);
                  }
                  catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                  }
                  $total_pages = ceil($total_records / $per_page);
                ?>
                <?php if ($page==1) { ?>
                  <li class="disabled"><span aria-hidden="true">«</span></li>
                <?php } else { ?>
                  <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                <?php } ?>
                <?php
                  for ($i=1; $i<=$total_pages; $i++)
                    if ($i == $page)
                      echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
                    else
                      echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
                ?>
                <?php if ($page==$total_pages) { ?>
                  <li class="disabled"><span aria-hidden="true">»</span></li>
                <?php } else { ?>
                  <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
                <?php } ?>
              </ul>
            </nav>
          </div>
        </div>

</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
