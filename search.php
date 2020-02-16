<?php
  include_once 'products_crud.php';
  session_start();
   if (!isset($_SESSION['name'])) {
       header('Location: index_login.php');
       exit();
     }
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Future Gaming Ordering System : Search</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      body{
        background-color: #CCE5CC ;
      }
    </style>
</head>
<body>
  <?php include_once 'nav_bar.php'; ?>
 
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Search</h2>
      </div>
    <form method="post" class="form-horizontal">
      <div class="form-group">
          <label for="searchfield" class="col-sm-3 control-label">Field</label>
            <div class="col-sm-9">
              <select name="searchfield" class="form-control" id="searchfield">
                <option value="fld_product_name">Product Name</option>
                <option value="fld_product_publisher">Product Publisher</option>
                <option value="fld_product_platform">Product Platform</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="searchterm" class="col-sm-3 control-label">Search Term</label>
            <div class="col-sm-9">
              <input name="searchterm" type="text" class="form-control" id="searchterm">
              <p></p>
              <button class="btn btn-default" type="submit" name="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
            </div>
        </div>
    </form>
  </div>
  </div>
 
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Search Results</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Publisher</th>
          <th>Platform</th>
          <th>Condition</th>
          <th>Quantity</th>
          <th></th>
        </tr>

      <?php
      if (isset($_POST['search'])){

      try {
        $srchfld=$_POST['searchfield'];
        $srch=$_POST['searchterm'];
      
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a159753_pt2 where $srchfld like '%$srch%'");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?> 
      <tr>
        <td><?php echo $readrow['fld_product_num']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_product_publisher']; ?></td>
        <td><?php echo $readrow['fld_product_platform']; ?></td>
        <td><?php echo $readrow['fld_product_genre']; ?></td>
        <td><?php echo $readrow['fld_product_quantity']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          
        </td>
      </tr>
      <?php }} ?>
 
      </table>
    </div>
  </div>
 
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
</body>
</html>