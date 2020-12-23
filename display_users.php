<!-- Lauren Bello, Evan Pomponio
     CSC 370 
     December 2, 2020
     Displays all of the user's information from the database. 
--> 
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
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$username = "C##admin";
$password = "Thwnd2021!";
$database = "localhost/XE";

$query = "select * from users";

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

echo "<table>\n";
$ncols = oci_num_fields($s);
echo "<tr>\n";
for ($i = 1; $i <= $ncols; ++$i) {
    $colname = oci_field_name($s, $i);
    echo "  <th><b>".htmlspecialchars($colname,ENT_QUOTES|ENT_SUBSTITUTE)."</b></th>\n";
}
echo "</tr>\n";

while (($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
	  echo "<tr>\n";
		echo "<td>". $row["USER_ID"] . "</td>\n";
	  echo "<td>". $row["FIRST_NAME"] . "</td>\n";
		echo "<td>". $row["LAST_NAME"] . "</td>\n";
		echo "<td>". $row["AGE"] . "</td>\n";
		echo "<td>". $row["GENDER"] . "</td>\n";
		echo "<td>". $row["LOCATION"] . "</td>\n";
		echo "<td>". $row["EMAIL"] . "</td>\n";
		echo "<td>". "*****" . "</td>\n";
	  echo "</tr>\n";
}
echo "</table>\n";

?>
</html>
