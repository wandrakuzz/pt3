<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  try {

      $stmt = $conn->prepare("INSERT INTO tbl_products_a148647(fld_product_ID,
        fld_product_name, fld_product_price, fld_brand,fld_type,
        fld_warrantylength, fld_product_quantity) VALUES(:pid, :name, :price, :brand,
        :type,:warranty, :quantity)");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam('warranty', $warranty, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $warranty =$_POST['warranty'];
    $quantity = $_POST['quantity'];

    $stmt->execute();
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Update
if (isset($_POST['update'])) {

  try {

      $stmt = $conn->prepare("UPDATE tbl_products_a148647 SET fld_product_ID = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_brand = :brand,
        fld_type = :type, fld_warrantylength = :warranty, fld_product_quantity = :quantity
        WHERE fld_product_ID = :oldpid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':warranty', $warranty, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

      $pid = $_POST['pid'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $brand =  $_POST['brand'];
      $type = $_POST['type'];
      $warranty = $_POST['warranty'];
      $quantity = $_POST['quantity'];
      $oldpid = $_POST['oldpid'];

      $stmt->execute();


    header("Location: products.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {

      $stmt = $conn->prepare("DELETE FROM tbl_products_a148647 WHERE fld_product_ID = :pid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

    $pid = $_GET['delete'];

    $stmt->execute();

    header("Location: products.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

      $stmt = $conn->prepare("SELECT * FROM tbl_products_a148647 WHERE fld_product_ID = :pid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

    $pid = $_GET['edit'];

    $stmt->execute();

    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

  $conn = null;
?>