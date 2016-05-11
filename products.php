<?php
  include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Projector and Projection Accessories : Products</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
  <?php include_once 'nav_bar.php'; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>

    <form action="products.php" class="form-horizontal" method="post">
      <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">Product ID</label>
          <div class="col-sm-9">
            <input name="pid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_ID']; ?>"> <br>
          </div>
        </div>
        <div class="form-group">
            <label for="productname" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
              <input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>"> <br>
            </div>
          </div>
          <div class="form-group">
              <label for="productprice" class="col-sm-3 control-label">Price</label>
              <div class="col-sm-9">
                <input name="price" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>"> <br>
              </div>
          </div>
          <div class="form-group">
              <label for="productyear" class="col-sm-3 control-label">Brand</label>
              <div class="col-sm-9">
                <select name="brand">
                  <option value="Sony" <?php if(isset($_GET['edit'])) if($editrow['fld_brand']=="Sony") echo "selected"; ?>>Sony</option>
                  <option value="Epson" <?php if(isset($_GET['edit'])) if($editrow['fld_brand']=="Epson") echo "selected"; ?>>Epson</option>
                  <option value="BenQ" <?php if(isset($_GET['edit'])) if($editrow['fld_brand']=="BenQ") echo "selected"; ?>>BenQ</option>
                  <option value="Optoma" <?php if(isset($_GET['edit'])) if($editrow['fld_brand']=="Optoma") echo "selected"; ?>>Optoma</option>
                </select>
              </div>
            </div>
          <div class="form-group">
         <label for="productwarranty" class="col-sm-3 control-label">Warranty</label>
         <div class="col-sm-9">
         <div class="radio-inline">
           <label>
             <input name="warranty" type="radio" value="1" <?php if(isset($_GET['edit'])) if($editrow['fld_warrantylength']=="1") echo "checked"; ?>> 1
           </label>
         </div>
         <div class="radio-inline">
           <label>
             <input name="warranty" type="radio" value="1" <?php if(isset($_GET['edit'])) if($editrow['fld_warrantylength']=="1") echo "checked"; ?>> 2
           </label>
          </div>
          <div class="radio-inline">
            <label>
              <input name="warranty" type="radio" value="1" <?php if(isset($_GET['edit'])) if($editrow['fld_warrantylength']=="1") echo "checked"; ?>> 3
            </label>
            </div>
         </div>
     </div>
     <div class="form-group">
         <label for="producttype" class="col-sm-3 control-label">Type</label>
         <div class="col-sm-9">
           <select name="type">
             <option value="full3d" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="full3d") echo "selected"; ?>>Full 3D Projector</option>
             <option value="pc3d" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="pc3d") echo "selected"; ?>>PC 3D Ready Projector</option>
             <option value="digitalmultimedia" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="digitalmultimedia") echo "selected"; ?>>Digital Multimedia</option>
           </select>
         </div>
       </div>
       <div class="form-group">
          <label for="productq" class="col-sm-3 control-label">Quantity</label>
          <div class="col-sm-9">
            <input name="quantity" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_ID']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button class="btn btn-success"type="submit" name="create">Create</button>
      <?php } ?>
      <button class="btn btn-danger"type="reset">Clear</button>
        </div>
      </div>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Product ID</td>
        <td>Name</td>
        <td>Price</td>
        <td>Brand</td>
        <td></td>
      </tr>
      <?php
      // Read
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
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_product_ID']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_brand']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['fld_product_ID']; ?>">Details</a>
          <a href="products.php?edit=<?php echo $readrow['fld_product_ID']; ?>">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>

    </table>
  </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
