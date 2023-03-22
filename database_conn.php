<?php
   $dbConn = new mysqli('localhost', 'unn_w21006726', 'Abood2365', 'unn_w21006726');	

   if ($dbConn->connect_error) {
      echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n";
      exit;
   }
?>
