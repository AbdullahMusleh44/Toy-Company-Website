<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" />	<!-- for media queries -->
	<title>Admin Page</title>
	<link href="styling.css" rel="stylesheet">  <!-- linking css file -->
</head>

<body>
	<div class="gridContainerAdmin">  <!-- creating grid layout container -->
	
		<header>
			<img class="logo" src="final_logo.png" alt="Northumbria Toys Company Logo.">			<!-- Adding logo -->
		</header>

		<nav>
			<ul>
				<li><a href="Home.html">Home</a></li> 										<!-- Navigation Bar -->
				<li><a href="viewtoys.php">View Toys</a></li>
				<li><a class="current" href="adminpage.php">Admin</a></li>
				<li><a href="credits.html">Credits</a></li>
			</ul>
		</nav>

		<main>

	<form action="AdminProcess.php" method="get"> 		<!-- Setting form action to AdminProcess file, and setting the method to get -->
	<fieldset>										<!-- Opening fieldset -->
	<legend> Enter Toy Information </legend> 		<!-- Setting legend of the form (helps with accessibility as well) -->
	
	<div class="formGrid">							<!-- Creating formGrid class to style -->
	
		<label for="ToyName">Name:</label> 			<!-- Adding Name label to imrpove accessibility -->	
		<input type="text" name="ToyName" id="ToyName" maxlength="25" size="20" placeholder="Enter Toy Name" accesskey="n" required>		<!-- Name Field -->
		
		<label for="ToyDesc">Description:</label> 	<!-- Adding Description label to imrpove accessibility -->
		<input type="text" name="ToyDesc" id="ToyDesc" maxlength="250" size="20" placeholder="Enter Toy Description" accesskey="d" required>		<!-- Description Field -->
		
		<label for="ToyPrice">Price:</label> 		<!-- Adding Price label to imrpove accessibility  -->
		<input type="number" step="any" name="ToyPrice" id="ToyPrice" maxlength="4" size="20" placeholder="Enter Toy Price" accesskey="p" required>		<!-- Price Field -->

		<label for="Category">Toy Category:</label>			<!-- Adding label to imrpove accessibility, Category Field -->
		
		<?php
		include 'database_conn.php';						//Establishing database connection
		$sql = "SELECT catID, catDesc FROM NTL_category";	//Select statement to retrieve category ID and category name 
		$queryResult = $dbConn->query($sql);
		?>
		<select name="Category" id="Category">
		<?php
		include 'database_conn.php';						//Establishing database connection
		while($rowObj = $queryResult->fetch_object()){		//While loop to go over category table
		echo "<option value='{$rowObj->catID}'> {$rowObj->catDesc} </option>";  //outputting category names
		}
		?>
		</select>
		
		<label for="Manufacturer">Toy Manufacturer:</label>		<!-- Adding label to imrpove accessibility, Manufacturer Field -->
		<?php
		include 'database_conn.php';							//Establishing database connection
		$sql = "SELECT manID, manName FROM NTL_manufacturer";	//Select statement to retrieve manufacturer ID and manufacturer name 
		$queryResult = $dbConn->query($sql);
		?>
		<select name="Manufacturer" id="Manufacturer">
		<?php
		include 'database_conn.php';							//Establishing database connection
		while($rowObj = $queryResult->fetch_object()){			//While loop to go over manufacturer table
		echo "<option value='{$rowObj->manID}'> {$rowObj->manName} </option>";		//outputting manufacturer names
		}
		?>
		</select>
		
		<input type="submit" value="Add Toy">				<!-- Submission button -->
		
	</div>
	</fieldset>
	</form>
		</main>
			
		<footer> 
			<h2> Contact Us! </h2>
			<p> Newcastle Store Location: NE1 7DF </p>
			<p> Working Hours: 9AM - 5PM (Monday-Saturday) </p>			<!-- Contact information for footer -->
			<p> Email: info@ntc.com </p>
			<p> Telephone: 447470303303 </p>
			<p> © Copyright 2022 Northumbria University. </p>
		</footer>

		</div>
</body>
</html>

