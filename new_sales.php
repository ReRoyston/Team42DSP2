<!DOCTYPE html>
<html lang="en-us">
<head>
	 <title>Php sales control system</title>
	 <meta charset="utf-8" />
	 <meta name="New Sales" content="New sales to be added for the Sales Report System" />
	
</head>
<body>
	<form id="enter sale" method="post" action="register.php">
	
	<form id="new_sales.php" method="post" action="register.php">
		<p><label for="ItemID">Item ID: </label>
			<input type="text" name="ItemID" id="ItemID" size="25" maxlength="25" required = "required" /></p>
		<p><input type="submit" value="Check ID"/> </p>
	</form>
	<?php
		require_once ("settings.php"); 
 
		$conn = @mysqli_connect($host, 
		$user,
		$pwd,
		$sql_db
		);

 
		if (!$conn) { 
			echo "<p>Database connection failure</p>"; 
		} else { 
		//check if it was succesful
			$query = "select * FROM Sales;"; 
			$result = mysqli_query($conn, $query); 
			if(!$result) { 
				echo "<p>Something is wrong with ", $query, "</p>";
			} else {
			
			$itemid = $_POST["ItemID"];
			$query = "select ITEM_NAME from ITEMS where ITEM_ID = $itemid";
			$result = mysqli_query($conn, $query); 
			
			if(!$result){
				echo "<p> unable to find Item in database, please try again </p>";
			}else{
			echo "<p><label for='Item Name'>Item Name: </label>
			<input type='text' name='Name' id='Name' size='25' maxlength='25' placeholder = '$result' readonly='readonly' /></p>";
			}
	?>
				
	<p><label for="Price">Price: </label>
			<input type="text" name="Price" id="Price" size="25" maxlength="25" required = "required" /></p>
	
	<p><label for="Amount Sold">Amount Sold: </label>
			<input type="text" name="Amount" id="Amount" size="25" maxlength="25" required = "required" /></p>
			
	<p>Employee:</p>
		<select name="Employee" id="Employee" required="required">
		<option value="">Please Select</option>
		<option value="Emp1">Emp1</option>
		<option value="Emp2">Emp2</option>
		<option value="Emp3">Emp3</option>
		<option value="Emp4">Emp4</option>
		</select>
		
	
	<p>	<input type="submit" value="Add Sale" /></p> 
	</form>
	<?php
		require_once ("settings.php"); 
 
		$conn = @mysqli_connect($host, 
		$user,
		$pwd,
		$sql_db
		);

 
		if (!$conn) { 
			echo "<p>Database connection failure</p>"; 
		} else { 
		//check if it was succesful
			$query = "select * FROM Sales;"; 
			$result = mysqli_query($conn, $query); 
			if(!$result) { 
				echo "<p>Something is wrong with ", $query, "</p>";
			} else {
			
			//TODO - Validaton
			
			$itemid = $_POST["ItemID"];
			$price = $_POST["Price"];
			$amount = $_POST["Amount"];
			$soldby = $_POST["Employee"];
			
			$query = "insert into Sales(ITEM_ID, QTY, PRICE, SOLD_BY) values ($itemid, $amount, $price, $soldby)";
			
	?>
	
</body>