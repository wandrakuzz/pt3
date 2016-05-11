<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  try {

    $stmt = $conn->prepare("INSERT INTO tbl_customers_a148647(fld_customer_ID,
      fld_customer_name,fld_customer_email, fld_customer_phone_num, fld_customer_gender)
      VALUES(:cid, :name,:email,:phone, :gender)");

      $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);


    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];


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

    $stmt = $conn->prepare("UPDATE tbl_customers_a148647 SET fld_customer_ID = :cid,
      fld_customer_name = :name,fld_customer_email = :email, fld_customer_phone_num = :phone,fld_customer_gender = :gender
      WHERE fld_customer_ID = :oldcid");

    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);

    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $email =  $_POST['email'];
    $phone = $_POST['phone'];
    $gender =  $_POST['gender'];
    $oldcid = $_POST['oldcid'];

    $stmt->execute();

    header("Location: customers.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {

    $stmt = $conn->prepare("DELETE FROM tbl_customers_a148647 WHERE fld_customer_ID = :cid");

    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);

    $cid = $_GET['delete'];

    $stmt->execute();

    header("Location: customers.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a148647 WHERE fld_customer_ID = :cid");

    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);

    $cid = $_GET['edit'];

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
