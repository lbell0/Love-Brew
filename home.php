<!-- Lauren Bello, Evan Pomponio
     CSC 370 
     December 2, 2020
     User's profile data, biography and question responses are displayed in 
     two cards where the viewing user is able to react to the content via selecting 
     the Like or Dislike button.
-->

<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$username = "C##admin";
$password = "Thwnd2021!";
$database = "localhost/XE";

$query = "SELECT u.FIRST_NAME, u.LOCATION, u.AGE, b.TEXT_BODY, r.RESPONSE_1, r.RESPONSE_2 FROM USERS u, biography b, prompts r WHERE u.user_id=b.user_id AND u.user_id=r.user_id";

$c = oci_connect($username, $password, $database);
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}

$s = oci_parse($c, $query);
if (!$s) {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r = oci_execute($s);
if (!$r) {
    $m = oci_error($s);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Love Brew</title>
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
   <h2 class = "title">Love Brew: A Smarter Way To Online Date</h2>
	 <?php
	 while (($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
     echo "<div class=row>";
       echo "<div class=col-sm-6>";
         echo "<div class=card>";
          echo "<div class=card-header>Biography</div>";
           echo "<div class=card-body>";
          	 echo "<h5 class=card-title>". $row["FIRST_NAME"] ."</h5>";
          	 echo "<h6 class=card-subtitle mb-2 text-muted>". $row["AGE"] .", ". $row["LOCATION"] ."</h6><br>";
             echo "<p class=card-text><b>About me</b><br>". $row["TEXT_BODY"] ."</p>";
             echo "<button type=button class=btn-dark>Like </button>" . "\t";
             echo "<button type=button class=btn-dark>Disike </button><br>";
           echo "</div>\n";
        echo "</div>\n";
       echo "</div>\n";
       echo "<div class=col-sm-6>";
         echo "<div class=card>";
           echo "<div class=card-header>Question Responses</div>";
           echo "<div class=card-body>";
             echo "<p class=card-text><b>What is your ideal Saturday?</b><br>". $row["RESPONSE_1"] ."</p>";
             echo "<p class=card-text><b>My favorite qualities in a person is…</b><br>". $row["RESPONSE_2"] ."</p>";
             echo "<button type=button class=btn-dark>Like </button>" . "\t";
             echo "<button type=button class=btn-dark>Disike </button><br>";
           echo "</div>\n";
         echo "</div>\n";
        echo "</div>\n";
     echo "</div>\n";
     echo "<hr>\n";
	}
	?>
	</body>
</html>
