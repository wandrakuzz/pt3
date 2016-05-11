<?php
  include_once 'orders_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Projector and Projection Accessories : Orders</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="orders.php" method="post">
      Order ID
      <input name="oid" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_ID']; ?>"> <br>
      Order Date
      <input name="orderdate" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_date']; ?>"> <br>
      Staff
      <select name="sid">
      <?php
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
      foreach($result as $staffrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['fld_staff_ID']==$staffrow['fld_staff_ID'])) { ?>
          <option value="<?php echo $staffrow['fld_staff_ID']; ?>" selected><?php echo $staffrow['fld_staff_name'];?></option>
        <?php } else { ?>
          <option value="<?php echo $staffrow['fld_staff_ID']; ?>"><?php echo $staffrow['fld_staff_name'];?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?>
      </select> <br>
      Customer
      <select name="cid">
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a148647");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $custrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['fld_customer_ID']==$custrow['fld_customer_ID'])) { ?>
          <option value="<?php echo $custrow['fld_customer_ID']; ?>" selected><?php echo $custrow['fld_customer_name'];?></option>
        <?php } else { ?>
          <option value="<?php echo $custrow['fld_customer_ID']; ?>"><?php echo $custrow['fld_customer_name'];?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?>
      </select> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order ID</td>
        <td>Order Date</td>
        <td>Staff</td>
        <td>Customer</td>
        <td></td>
      </tr>
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_orders_a148647, tbl_staffs_a148647, tbl_customers_a148647 WHERE ";
        $sql = $sql."tbl_orders_a148647.fld_staff_ID = tbl_staffs_a148647.fld_staff_ID and ";
        $sql = $sql."tbl_orders_a148647.fld_customer_ID = tbl_customers_a148647.fld_customer_ID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $orderrow) {
      ?>
      <tr>
        <td><?php echo $orderrow['fld_order_ID']; ?></td>
        <td><?php echo $orderrow['fld_date']; ?></td>
        <td><?php echo $orderrow['fld_staff_name']; ?></td>
        <td><?php echo $orderrow['fld_customer_name']; ?></td>
        <td>
          <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_ID']; ?>">Details</a>
          <a href="orders.php?edit=<?php echo $orderrow['fld_order_ID']; ?>">Edit</a>
          <a href="orders.php?delete=<?php echo $orderrow['fld_order_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
  </center>
</body>
</html>
