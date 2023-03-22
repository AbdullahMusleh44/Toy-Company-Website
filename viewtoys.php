<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" />	<!-- for media queries -->
	<title>View Toys</title>
	<link href="styling.css" rel="stylesheet">  <!-- linking css file -->
</head>

<body>
	<div class="gridContainer">  <!-- creating grid layout container -->
	
		<header>
			<img class="logo" src="final_logo.png" alt="Northumbria Toys Company Logo.">			<!-- Adding logo -->
		</header>

		<nav>
			<ul>
				<li><a href="Home.html">Home</a></li> 										<!-- Navigation Bar -->
				<li><a class="current" href="viewtoys.php">View Toys</a></li>
				<li><a href="adminpage.php">Admin</a></li>
				<li><a href="credits.html">Credits</a></li>
			</ul>
		</nav>
		

		<main>
		<h1> View our latest collection of toys! </h1>				<!-- Heading for view toys page -->
		<div class="flexContainer">									<!-- Creating class to allow styling -->
		
<?php
include 'database_conn.php';											//Establishing database connection
	  
//SQL select statement with inner joins to output all info of the toys in database
	$sql = "SELECT toyName, description, toyPrice, catDesc, manName		
			FROM NTL_toys
			INNER JOIN NTL_manufacturer
			ON NTL_manufacturer.manID = NTL_toys.manID
			INNER JOIN NTL_category
			ON NTL_category.catID = NTL_toys.catID
			ORDER BY toyName";
	$queryResult = $dbConn->query($sql);								//querying the SQL statement


	if($queryResult === false) {											//checking and handling query failure
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";	//outputting error message
	exit;
	}
	else {
    while($row = $queryResult->fetch_object()){						//while loop to output span classes for each row from database table
	 //Creating toy class to allow styling
	 //span classes to ease styling process
	echo "
	<div class ='toy'> 													
		<span class='ToyName'>{$row->toyName}\r\n </span> <br>
		<span class='ToyDescription'><strong>Description:</strong> {$row->description} \r\n </span><br>
		<span class='CatalogDescription'>{$row->catDesc}</span> <br>										
		<span class='ManufacturerName'><strong> Manufacturer:</strong> {$row->manName}</span> <br>
		<span class='ToyPrice'><strong> Price: £{$row->toyPrice}</strong></span> <br>
	</div>\n";
    }
	}
	$queryResult->close();												
	$dbConn->close();														//Closing database connection
?>
</div>
		</main>

		<footer> 
			<h2> Contact Us! </h2>
			<p> Newcastle Store Location: NE1 7DF </p>
			<p> Working Hours: 9AM - 5PM (Monday-Saturday) </p>
			<p> Email: info@ntc.com </p>							<!-- Contact information for footer -->
			<p> Telephone: 447470303303 </p>
			<p> © Copyright 2022 Northumbria University. </p>
		</footer>

		</div>
</body>
</html>
