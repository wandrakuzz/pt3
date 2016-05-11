<?php
  include_once 'orders_details_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Projector and Projection Accessories : Order Details</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_orders_a148647, tbl_staffs_a148647,
          tbl_customers_a148647 WHERE
          tbl_orders_a148647.fld_staff_ID = tbl_staffs_a148647.fld_staff_ID AND
          tbl_orders_a148647.fld_customer_ID = tbl_customers_a148647.fld_customer_ID AND
          fld_order_ID = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
        $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    Order ID: <?php echo $readrow['fld_order_ID'] ?> <br>
    Order Date: <?php echo $readrow['fld_date'] ?> <br>
    Staff: <?php echo $readrow['fld_staff_name'];?> <br>
    Customer: <?php echo $readrow['fld_customer_name'];?> <br>
    <hr>
    <form action="orders_details.php" method="post">
      Product
      <select name="pid">
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a148647");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $productrow) {
      ?>
        <option value="<?php echo $productrow['fld_product_ID']; ?>"><?php echo $productrow['fld_brand']." ".$productrow['fld_product_name']; ?></option>
      <?php
      }
      $conn = null;
      ?>
      </select>
      Quantity
      <input name="quantity" type="text">
      <input name="oid" type="hidden" value="<?php echo $readrow['fld_order_ID'] ?>">
      <button type="submit" name="addproduct">Add Product</button>
      <button type="reset">Clear</button>

    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order Detail ID</td>
        <td>Product</td>
        <td>Quantity</td>
        <td></td>
      </tr>
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a148647,
            tbl_products_a148647 WHERE
            tbl_orders_details_a148647.fld_product_ID = tbl_products_a148647.fld_product_ID AND
          fld_order_ID = :oid");
          $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $detailrow['fld_orderprocess_ID']; ?></td>
        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_process_quantity']; ?></td>
        <td>
          <a href="orders_details.php?delete=<?php echo $detailrow['fld_orderprocess_ID']; ?>&oid=<?php echo $_GET['oid']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
    <hr>
    <a href="invoice.php?oid=<?php echo $_GET['oid']; ?>" target="_blank">Generate Invoice</a>

  </center>
</body>
</html>
