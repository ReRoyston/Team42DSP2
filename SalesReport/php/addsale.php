<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>Sales report system</title>
	<header>
		<h1>Sales report system</h1>
	<header/>
	<body>
		<nav>
		  <li><a href="../html/home.html">Home</a></li>
		  <li><a href="addprod.php">Add product</a></li>
		  <li><a class="active" href="addsale.php">New sale</a></li>
		  <li><a href="view.php">View sales</a></li>
		  <li><a href="reports.php">Reports</a></li>
		</nav>
		<div>
			<h2>
				Add a new sale entry
			</h2>
		<section/>
		<div class = "main">
			<p>
				Item ID: <input type="text" id ="itemid" name = "Item ID" 
				maxlength = "5" size ="1">
				<br/>
				<br/>
				Quantity: <input type="text" id ="quantity" name = "Quantity" 
				maxlength = "3" size ="1">
				<p>
				<div class="submitDiv">
					<input type="submit" class="submitBtns" value="Submit">
				</div>
				</p>
			</p>
			<table border = "1">
				<caption><h3>Sales list</h3></caption>
					<tr>
						<th>Sale id</th>
						<th>Product id</th>
						<th>Date of sale</th>
						<th>Amount sold</th>
						<th>Sold by</th>
						
					</tr>
					<?php
					//Creates a connection to the local host (127.0.0.1) and root 
					//which is the default username and password which defaults to nothing
					$con = mysqli_connect('127.0.0.1','root','');
					//If the connection isn't successful display a message
					if(!$con)
					{
						echo 'Not Connected To Server';
					}
					//If the connection to our sales DB isn't successful display a message
					if (!mysqli_select_db ($con,'sales'))
					{
						echo 'Database Not Selected';
					}
					//SQL query to get all product entries from 'products' table
					$sql = "SELECT * FROM `salelist` ORDER BY date_sold DESC";
					//If our query isn't successful then display a message
					if (!mysqli_query($con, $sql))
					{
					 echo 'Could not retrieve product list';
					}
					//If our query is succesful, save the result into a variable called
					//$result.
					else
					{
						$result = mysqli_query($con, $sql);
					}
					//Fetch the array stored in $result and output it to a table
					//using a while loop.
					?>
					<?php while($row = mysqli_fetch_array($result)):?>
					<tr>
						<td><?php echo $row['sale_id'];?></td>
						<td><?php echo $row['prod_id'];?></td>
						<td><?php echo $row['date_sold'];?></td>
						<td><?php echo $row['amount_sold'];?></td>
						<td><?php echo $row['sold_by'];?></td>
					</tr>
					
				<?php endwhile;?>    
				</table>
		<div/>
	</body>
</html>
