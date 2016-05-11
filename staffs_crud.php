<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  try {

    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a148647(fld_staff_ID, fld_staff_name,
      fld_staff_gender, fld_staff_phone_num, fld_staff_email) VALUES(:sid, :name, :gender,
      :phone, :email)");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $gender =  $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

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

    $stmt = $conn->prepare("UPDATE tbl_staffs_a148647 SET
      fld_staff_ID = :sid, fld_staff_name = :name, fld_staff_gender = :gender,
      fld_staff_phone_num = :phone, fld_staff_email = :email
      WHERE fld_staff_ID = :oldsid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $oldsid = $_POST['oldsid'];

    $stmt->execute();

    header("Location: staffs.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {

    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a148647 where fld_staff_ID = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['delete'];

    $stmt->execute();

    header("Location: staffs.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a148647 where fld_staff_ID = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['edit'];

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
