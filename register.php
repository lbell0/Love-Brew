<!-- Lauren Bello, Evan Pomponio
     CSC 370 
     December 2, 2020
     User registration form to create an account. It checks that all fields are entered,
     that the input types are valid and submits the form. *Disclaimer: not fully functioning 
     with the database - bug. 
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Love Brew</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
  </head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light">
     <img src="img/cup.png" class="logo" alt="Love Brew" width=50 height=50>
     <a class="navbar-brand" href="index.html"><strong>Love Brew</strong></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarNav">
       <ul class="navbar-nav">
         <li class="nav-item active">
           <a class="nav-link" href="home.php">Home</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="ODM_data.php">Data</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="documentation.html" target="_blank">Documentation</a>
         </li>
       </ul>
       <ul class="navbar-nav ml-auto">
         <div class="dropdown">
           <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             My Account
           </button>
           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             <li class="nav-item">
               <a class="nav-link" href="login.php">Login</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="logout.php">Logout</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="admin.php">Admin</a>
             </li>
           </div>
         </div>
       </ul>
     </div><hr>
   </nav>
</body>
</html>

<?php
// login.php
require_once('./dbinfo.php');

session_start();

function register_form($message)
{
  echo <<<EOD
  <body style="font-family: Arial, sans-serif; text-align:center">
  <h2 class = "title">Love Brew: A Smarter Way To Online Date</h2><br>
  <p>$message</p>
  <div class="container h-100 col-sm-4">
     <h3>User Registration</h3>
     <hr>
       <form id="form" action="login.php" method="post" class="needs-validation">
         <div class="form-group">
             <label for="fname">First Name:</label>
             <input type="text" class="form-control" placeholder="Enter first name" name="fName" required>
             <div class="valid-feedback">Valid.</div>
             <div class="invalid-feedback">Please fill out this field.</div>
         </div>
         <div class="form-group">
             <label for="lname">Last Name:</label>
             <input type="text" class="form-control" placeholder="Enter last name" name="lName" required>
             <div class="valid-feedback">Valid.</div>
             <div class="invalid-feedback">Please fill out this field.</div>
         </div>
         <div class="form-group">
             <label for="age">Age:</label>
             <input type="number" class="form-control" placeholder="Enter your age" name="age" required>
             <div class="valid-feedback">Valid.</div>
             <div class="invalid-feedback">Please fill out this field.</div>
         </div>
         <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
         </div>
         <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" placeholder="Enter your location. E.g. Philadelphia" name="location" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
         </div>
         <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" class="form-control" placeholder="Enter email address" name="uEmail" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
         </div>
         <div class="form-group">
           <label for="password">Password:</label>
           <input type="password" class="form-control" placeholder="Enter password" name="uPassword" required>
             <div class="valid-feedback">Valid.</div>
             <div class="invalid-feedback">Please fill out this field.</div>
         </div>
         <div class="row">
           <div class="col-md- mx-auto">
               <button type="submit" value="register" class="btn btn-outline-dark">Register</button>
           </div>
         </div>
      </form>
      <a href="login.php" style="color:black;"><br><br>Already have an account? <b>Sign in here!</b></a>
   </div>
</body>
EOD;
}

$conn = oci_connect('C##ADMIN', 'password', 'localhost/XE');

$sql = "INSERT INTO Users (first_name, last_name, age, gender, location, email, pwd)
        VALUES (:fname, :lname, :age, :gender, :location, :uEmail, :uPassword)";

$stid = oci_parse($conn, $sql);
oci_commit($conn);

 if (empty($_POST['fname']) || empty($_POST['lnane']) || empty($_POST['age']) || empty($_POST['gender']) ||
     empty($_POST['location']) ||  empty($_POST['uEmail']) || empty($_POST['uPassword'])) {
          register_form('Please fill out all fields.');
} else {
  // Check validity of the supplied username & password
  $c = oci_pconnect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
  // Use a "bootstrap" identifier for this administration page
  oci_set_client_identifier($c, 'admin');

  $s = oci_parse($c, $sql);
  oci_execute($s);
  $r = oci_fetch_array($s, OCI_ASSOC);
}
?>
