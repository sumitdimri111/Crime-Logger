<?php
session_start();
  if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    header('location: home.php');
  }
    $username = "";
    $email    = "";
    $errors = array();

  $db = mysqli_connect('localhost', 'root', '', 'registration');

  if (isset($_POST['signin']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    
    $query = "SELECT *FROM users WHERE username='$username' and password='$password'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    $verify = $row['verify'];
    $username = $row['username'];
    $email = $row['email'];

    if(mysqli_num_rows($result) > 0)
    {
      if($verify == 1) {
        $_SESSION['username'] = $username;
        header('location: home.php');
      }

      else {
          $generate_otp = rand();


          $query = "UPDATE USERS SET otp=$generate_otp WHERE username='$username'";
          $result = mysqli_query($db, $query);

          $message = 
          "
            Confirm your Email
            Click the link below to verify your account...
            https://localhost/crime/conifimation.php?username=$username.code=$generate_otp
          ";
          mail($email, "Confirmation mail", $message, "From: DoNotReply@crimeLogger.com");
      }
    }
    else
    {
      $msg = "incorrect username and password";
      echo "<script type='text/javascript'> alert('$msg') </script>";
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Crime Logger</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
  </head>
  <body>

    <div class="row" style="background-color: lightblue;">
      <div class="col-md-3">  
        <img src="images/911.png" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
      </div>
      <div class="col-md-6">  
        <img src="images/pic4.png" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
      </div>
      <div class="col-md-3">
        <img src="images/crime-stop.jpg" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
      </div>
    </div>
    <div class="row">
      <div class="col-md-2" style="background-color: gray; height: 110vh;"> 
        <a class="btn btn-danger form-control" href="show.php" ">Show crime</a> <br>
        <a class="btn btn-danger form-control" href="contact.php">Contact us</a> <br>
        <a class="btn btn-danger form-control" href="about.php">About</a>
      </div>

    <div class="col-md-10 right_screen">  
      <div class="header">
        <h2>Sign in</h2>
      </div>
      <form method="post" action="login.php">
        <div class="input-group">
          <label>Username</label>1
          <input type="text" name="username">
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password">
        </div>
        <div class="input-group">
          <button type="submit" class="reg_btn" name="signin">Sign in</button>
        </div>
      <p>
        Want to become a member ? <a href="registor.php">Sign up</a>
      </p>
    </form>
    </div>
  </div>
  </body>
</html>