<?php
include ("database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Future Gaming Ordering System: Catalogue</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      body{
        background-color: #CCE5CC ;
      }
    </style>
</head>
<body>

<?php include_once 'nav_bar.php'; ?>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="page-header">
        <h1>Catalogue</h1>
      </div>
      <div class="col-md-3">
        <p class="lead">Sort:</p>
      <div class="list-group">
        <a href="catalogue.php" class="list-group-item">All categories</a>
        <a href="cataloguelowtohigh.php" class="list-group-item">Price Low to High</a>
        <a href="cataloguehightolow.php" class="list-group-item">Price High to Low</a>
       </div>
      </div>
      <div class="col-md-9">
        <div class="row">
      <?php
      // Read
      $per_page = 3;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a159753_pt2  ORDER BY fld_product_price ASC LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?> 
      <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
          <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive">
              <div class="caption">
                <h4 class="pull-right">RM <?php echo $readrow['fld_product_price']; ?></h4>
                <h4><a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>"><?php echo $readrow['fld_product_name']; ?></a></h4>
                <p>Platform : <?php echo $readrow['fld_product_platform']; ?></p>
                <p>Publisher : <?php echo $readrow['fld_product_publisher']; ?></p>
              </div>
        </div>
      </div>
  <?php } ?>
  </div>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
        <ul class="pagination">
        <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a159753_pt2 ORDER BY fld_product_price ASC");
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
            <li><a href="cataloguelowtohigh.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"cataloguelowtohigh.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"cataloguelowtohigh.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="cataloguelowtohigh.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
  </div>
  </div>
  </div>
  <!-- /.container -->
 
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jQuery -->
</body>
</html>