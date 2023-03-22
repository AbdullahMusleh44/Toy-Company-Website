<?php

	include 'database_conn.php'; //Establishing database connection
	
	//checking and sanitising variables, if no value entered then null will be entered to prevent undefined index error notice messages 
	$name = isset($_REQUEST['ToyName'])? $_REQUEST['ToyName']: null;
	$description = isset($_REQUEST['ToyDesc'])? $_REQUEST['ToyDesc']: null; 
	$category = isset($_REQUEST['Category'])? $_REQUEST['Category']: null;
	$manufacturer = isset($_REQUEST['Manufacturer'])? $_REQUEST['Manufacturer']: null;
	$price = isset($_REQUEST['ToyPrice'])? $_REQUEST['ToyPrice']: null;
	
	//Using real_escape_string() to escape any special characters that may have been entered into the form
	$name = $dbConn->real_escape_string($name);
	$description = $dbConn->real_escape_string($description);
	$category = $dbConn->real_escape_string($category);  		
	$manufacturer = $dbConn->real_escape_string($manufacturer);
	$price = $dbConn->real_escape_string($price);
	
	//Prompting the user to enter data / make a choice if they haven’t for a given field
	if (empty($name) or empty($description) or empty ($category) or empty ($manufacturer) or empty ($price)){
		echo "<p> Make sure all heading are filled in! </p> \n";
		echo "<a href='adminpage.php'> Try filling the form again </a> </p>\n";
	}
	else
	{
		//SQL insert statement that will be used to insert a new toy into the database
	$sql = "INSERT into NTL_toys(toyName, description, manID, catID, toyPrice)
		   values ('".$name."','".$description."','".$manufacturer."','".$category."','".$price."')";
		   
		//SQL select statement used to output the details of the newly added toy
	$output = "SELECT toyName, description, catDesc, manName, toyPrice FROM NTL_toys
			INNER JOIN NTL_category on NTL_category.catID = NTL_toys.catID
			INNER JOIN NTL_manufacturer on NTL_manufacturer.manID = NTL_toys.manID
			WHERE toyID = (SELECT max(toyID) from NTL_toys)";
			
	$queryResult = $dbConn->query($sql); //querying the SQL statement
	
		if($queryResult === false) //checking and handling query failure
		{
			echo "<p> Query Failed: ".$dbConn->error." </p>\n";			//checking and handling query failure
			echo "<a href='adminpage.php'> Try Again </a> </p> \n"; //outputting a link to redirect user to admin page to try again
		}
		else 
		{
			$queryResult = $dbConn->query($output); //Query the select statement to output the details of most recent toy
			
			//outputting the details of newly added toy
			while ($row = $queryResult->fetch_object()){
			echo "<p> Toy successfully added.</p>\n";
			echo "<p>Toy Name: ".$row->toyName." </p>\n";
			echo "<p>Description: ".$row->description." </p>\n";
			echo "<p>Category: ".$row->catDesc." </p>\n";
			echo "<p>Manufacturer: ".$row->manName." </p>\n";
			echo "<p>Price: ".$row->toyPrice." </p>\n";
			}
		}
		
		echo "<a href='adminpage.php'> Add Another Toy </a> </p>\n"; //outputting a link to redirect user to admin page to add new toy
		echo "<a href='viewtoys.php'> View All Toys </a> </p>\n";    //outputting a link to redirect user to view all toys
		
		$dbConn -> close(); //Closing database connection
	}
?>
