<?/*
CREATE OR REPLACE FUNCTION echo_update
( max_len IN     NUMBER,
 min_supp IN     NUMBER,
  min_conf IN     NUMBER) RETURN VARCHAR2 IS
BEGIN
  dbms_output.put_line(upd_settings(max_len,min_supp,min_supp));
  RETURN 'upd_settings ['||max_len||',0'||min_supp||',0'||min_conf||'] received.';
END;
*/

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

  </body>
</html>
<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	require_once('dbinfo.php');

  // Attempt to connect to your database.
  $c = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
  if (!$c) {
    print "Sorry! The connection to the database failed. Please try again later.";
    die();
  }
  else {
    // Initialize incoming message whether or not parameter sent.
    $msg_in = (isset($_GET['msg'])) ? $_GET['msg'] : "Cat got your keyboard?";

    // Set the call statement, like a SQL statement.
    $sql = "BEGIN :b := echo_update(2,0.2,0.3); END;";

    // Prepare the statement and bind the two strings.
    $stmt = oci_parse($c,$sql);

    // Bind local variables into PHP statement, you MUST size OUT only variables.
    //oci_bind_by_name($stmt, ":a", $msg_in);
    oci_bind_by_name($stmt, ":b", $msg_out, 80, SQLT_CHR);

    // Execute it and print success or failure message.
    if (oci_execute($stmt)) {
      print $msg_out;
    }
    else {
      print "Sorry error";
    }

    // Free resources.
    oci_free_statement($stmt);
    oci_close($c);
  }
?>
