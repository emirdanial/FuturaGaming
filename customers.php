<?php
  include_once 'customers_crud.php';
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
  <title>Future Gaming Ordering System : Customers</title>
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
        <h2>Add New Customer</h2>
      </div>

    <form action="customers.php" method="post" class="form-horizontal">

      <div class="form-group">
          <label for="customerid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="cid" type="text" class="form-control" id="customertid" placeholder="Customer ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_num']; ?>" required>
      </div>
        </div>

      <div class="form-group">
          <label for="fname" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
        <input name="fname" type="text" class="form-control" id="fname" placeholder="First Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_fname']; ?>"required>
      </div>
        </div>

      <div class="form-group">
          <label for="lname" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
      <input name="lname" type="text" class="form-control" id="lname" placeholder="Last Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_lname']; ?>"required>
      </div>
        </div>

      <div class="form-group">
          <label for="gender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
      <input name="gender" type="radio" id="gender" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Male") echo "checked"; ?>> Male
       </label>
          </div>
          <div class="radio">
            <label>
      <input name="gender" type="radio" id="gender" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Female") echo "checked"; ?>> Female
      </label>
            </div>
          </div>
      </div>

      <div class="form-group">
          <label for="address" class="col-sm-3 control-label">Address</label>
          <div class="col-sm-9">
      <input name="address" type="text" class="form-control" id="address" placeholder="Address" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_address']; ?>"required>
      </div>
        </div>

      <div class="form-group">
          <label for="phone" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
      <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>"required>
      </div>
        </div>

      <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">

      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_num']; ?>">
      
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>

      <?php } else { ?>
      
      <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>

      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
        </div>
      </div>
    </form>
    </div>
  </div>

    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Customers List</h2>
      </div>
      <table class="table table-striped table-bordered">
      <tr>
        <th>Customer ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th></th>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a159753_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_customer_num']; ?></td>
        <td><?php echo $readrow['fld_customer_fname']; ?></td>
        <td><?php echo $readrow['fld_customer_lname']; ?></td>
        <td><?php echo $readrow['fld_customer_gender']; ?></td>
        <td><?php echo $readrow['fld_customer_address']; ?></td>
        <td><?php echo $readrow['fld_customer_phone']; ?></td>
        <td>
          <a href="customers.php?edit=<?php echo $readrow['fld_customer_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          
          <a href="customers.php?delete=<?php echo $readrow['fld_customer_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
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