<!-- Lauren Bello
     CSC 370 
     December 2, 2020
     File to maintain database connectivity so the 
     files do not require the re-entry of the credentials.
     By using the require_once, it checks this file and 
     verifies the connection. 
-->
<?php
//All connections to the DB use these credentials
define("ORA_CON_UN", "C##ADMIN");
define("ORA_CON_PW", "password!");
define("ORA_CON_DB", "localhost/XE");
?>
