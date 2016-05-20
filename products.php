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
          <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-7">
            <input name="pid" type="text" class="form-control" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_ID']; ?>" required> <br>
          </div>
        </div>
        <div class="form-group">
            <label for="productname" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-7">
              <input name="name" type="text" class="form-control" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>"required> <br>
            </div>
          </div>
          <div class="form-group">
              <label for="productprice" class="col-sm-3 control-label">Price</label>
              <div class="col-sm-7">
                <input name="price" type="text" class="form-control" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>"required> <br>
              </div>
          </div>
          <div class="form-group">
              <label for="productyear" class="col-sm-3 control-label">Brand</label>
              <div class="col-sm-7">
                <select name="brand" class="form-control" id=product_brand required>
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
             <input name="warranty" type="radio" value="1" <?php if(isset($_GET['edit'])) if($editrow['fld_warrantylength']=="1") echo "checked"; ?>required> 1
           </label>
         </div>
         <div class="radio-inline" required>
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
         <div class="col-sm-7">
           <select name="type" class="form-control" required>
             <option value="full3d" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="full3d") echo "selected"; ?>>Full 3D Projector</option>
             <option value="pc3d" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="pc3d") echo "selected"; ?>>PC 3D Ready Projector</option>
             <option value="digitalmultimedia" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="digitalmultimedia") echo "selected"; ?>>Digital Multimedia</option>
           </select>
         </div>
       </div>
       <div class="form-group">
          <label for="productq" class="col-sm-3 control-label">Quantity</label>
          <div class="col-sm-7">
            <input name="quantity" type="text" class="form-control" placeholder="Product Quantity" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>"required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_ID']; ?>">
      <button class="btn btn-primary"type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
      <button class="btn btn-success"type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Create</button>
      <?php } ?>
      <button class="btn btn-danger"type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"> Clear</button>
        </div>
      </div>
    </form>
  </div>
</div>
    <br>
    <br>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Brand</th>
          <th></th>
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
        $stmt = $conn->prepare("select * from tbl_products_a148647 LIMIT $start_from, $per_page");
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
          <a href="products_details.php?pid=<?php echo $readrow['fld_product_ID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a href="products.php?edit=<?php echo $readrow['fld_product_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php } ?>

      </table>
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
                $stmt = $conn->prepare("SELECT * FROM tbl_products_a148647");
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
              <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            <?php } ?>
            <?php
              for ($i=1; $i<=$total_pages; $i++)
                if ($i == $page)
                  echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
                else
                  echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
            ?>
            <?php if ($page==$total_pages) { ?>
              <li class="disabled"><span aria-hidden="true">»</span></li>
            <?php } else { ?>
              <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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
