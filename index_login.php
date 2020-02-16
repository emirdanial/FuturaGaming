<?php

session_start();

include("database.php");


if (isset($_POST['login1']))
{
  $uname=$_POST['username1'];
  $pwd=$_POST['pwd1'];
  

  $sqlStatement = "SELECT * FROM tbl_staffs_a159753_pt2 WHERE fld_staff_email='$uname' and fld_staff_password='$pwd'";

  $result=mysqli_query($con,$sqlStatement);

  $count = mysqli_num_rows($result);

    if($count < 1){
    $resulterror="<div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning!</strong> Incorrect username or password </div>" ;
    echo $resulterror;
    }

else{
  
  while ($row = mysqli_fetch_array($result)){
    $_SESSION['name'] = $row['fld_staff_fname'];
  }

  $result1='<div class="col-xs-12 col-sm-12 col-md-12"><div class="row"><div class="col-xs-1 col-sm-1 col-md-1"> </div><div class="col-xs-10 col-sm-10 col-md-10"><div class="alert alert-success alert-dismissable" style="margin-top:10px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Login Success</div></div></div><div class="col-xs-1 col-sm-1 col-md-1"></div></div>';
      echo $result1;
      header("Location:index.php");
      }   
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="css/global.css" type="text/css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <title>Future Gaming Ordering System: Login</title>
  <style>
    
  </style>           
</head>
<body>    
     
  <div class="container-fluid bg">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12"></div>
      <div class="col-md-4 col-sm-4 col-xs-12">
      
        <form method="post" class="form-container">
          <h1 style="font-family: Lucida Console; font-size: 30px;">Future Gaming Login</h1>
            <div class="form-group">
              <label for="us">Email Address:</label>
              <input type="text" class="form-control" id="us" name="username1" placeholder="Enter Email Address" required>
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" id="pwd" name="pwd1" placeholder="Enter Password" required>
            </div>
      
          <input type="submit" class="btn btn-success btn-block" value="Login" name="login1" ">
        </form>
      </div>
    <div class="col-md-4 col-sm-4 col-xs-12"></div>
  </div>
  </div>
</body>
</html>   