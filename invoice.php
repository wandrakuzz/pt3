<?php
  include_once 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Projector and Projection Accessories : Invoice</title>
</head>
<body>
  <center>
    GilaProjectorAccessories Sdn. Bhd. <br>
    No2 Jalan Kelapa Laut <br>
    Seksyen 18, Shah Alam <br>
    40200 <br>
    Selangor Darul Ehsan <br>
    <hr>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a148647, tbl_staffs_a148647,
        tbl_customers_a148647, tbl_orders_details_a148647 WHERE
        tbl_orders_a148647.fld_staff_ID = tbl_staffs_a148647.fld_staff_ID AND
        tbl_orders_a148647.fld_customer_ID = tbl_customers_a148647.fld_customer_ID AND
        tbl_orders_a148647.fld_order_ID = tbl_orders_details_a148647.fld_order_ID AND
        tbl_orders_a148647.fld_order_ID = :oid");
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
    <b>Order ID</b>: <?php echo $readrow['fld_order_ID'] ?>
    <b>Order Date</b>: <?php echo $readrow['fld_date'] ?>
    <hr>
    <b>Staff</b>: <?php echo $readrow['fld_staff_name']; ?>&nbsp;&nbsp;
    <b>Customer</b>: <?php echo $readrow['fld_customer_name']; ?>&nbsp;&nbsp;
    <b>Date</b>: <?php echo date("d M Y"); ?>
    <hr>
    <table border="1">
      <tr>
        <td>No</td>
        <td>Product</td>
        <td>Quantity</td>
        <td>Price(RM)/Unit</td>
        <td>Total(RM)</td>
      </tr>
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a148647,
            tbl_products_a148647 where
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
        <td><?php echo $counter; ?></td>
        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_process_quantity']; ?></td>
        <td><?php echo $detailrow['fld_product_price']; ?></td>
        <td><?php echo $detailrow['fld_product_price']*$detailrow['fld_process_quantity']; ?></td>
      </tr>
      <?php
        $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_process_quantity'];
        $counter++;
      } // while
      $conn = null;
      ?>
      <tr>
        <td colspan="4" align="right">Grand Total</td>
        <td><?php echo $grandtotal ?></td>
      </tr>
    </table>
    <hr>
    Computer-generated invoice. No signature is required.

  </center>
</body>
</html>
