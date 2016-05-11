<?php
  include_once 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Projector and Projection Accessories : Products Detail</title>
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
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a148647 WHERE fld_product_ID = :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $pid = $_GET['pid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    Product ID: <?php echo $readrow['fld_product_ID'] ?> <br>
    Name: <?php echo $readrow['fld_product_name'] ?> <br>
    Price: RM <?php echo $readrow['fld_product_price'] ?> <br>
    Brand: <?php echo $readrow['fld_brand'] ?> <br>
    Type: <?php echo $readrow['fld_type'] ?> <br>
    Warranty: <?php echo $readrow['fld_warrantylength'] ?> <br>
    Quantity: <?php echo $readrow['fld_product_quantity'] ?> <br>
    <img src="product/<?php echo $readrow['fld_product_image'] ?>" width="50%" height="50%">
  </center>
</body>
</html>
