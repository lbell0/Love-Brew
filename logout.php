<!-- Lauren Bello, Evan Pomponio
     CSC 370 
     December 2, 2020
     Logout page that unsets the logged in user's session
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
           <a class="nav-link" href="documentation.html">Documentation</a>
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
// logout.php
session_start();
unset($_SESSION['uEmail']);

echo <<<EOD
<body style="text-align:center;">
<br><br><h2>Goodbye! <br>Love, Brew</h2><br>
<img src="img/cup.png" class="logo" alt="Love Brew" width=70 height=70>
<p><br><br>You are now logged off.</p>
<p><a href="login.php">Would you like to sign back in?</a></p>
</body>
EOD;
?>
