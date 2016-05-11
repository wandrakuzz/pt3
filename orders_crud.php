<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  try {

    $stmt = $conn->prepare("INSERT INTO tbl_orders_a148647(fld_order_ID, fld_staff_ID,
      fld_customer_ID) VALUES(:oid, :sid, :cid)");

    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);

    $oid = uniqid('O', true);
    $sid = $_POST['sid'];
    $cid = $_POST['cid'];

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

    $stmt = $conn->prepare("UPDATE tbl_orders_a148647 SET fld_staff_ID = :sid,
      fld_customer_ID = :cid WHERE fld_order_ID = :oid");

    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);

    $oid = $_POST['oid'];
    $sid = $_POST['sid'];
    $cid = $_POST['cid'];

    $stmt->execute();

    header("Location: orders.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {

    $stmt = $conn->prepare("DELETE FROM tbl_orders_a148647 WHERE fld_order_ID = :oid");

    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);

    $oid = $_GET['delete'];

    $stmt->execute();

    header("Location: orders.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

    try {

    $stmt = $conn->prepare("SELECT * FROM tbl_orders_a148647 WHERE fld_order_ID = :oid");

    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);

    $oid = $_GET['edit'];

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