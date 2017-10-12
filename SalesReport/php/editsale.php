<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>Edit sale</title>
	<header>
		<h1>Sales report system</h1>
	<header/>
	<body>
		<nav>
		  <li><a href="../html/home.html">Home</a></li>
		  <li><a href="addprod.php">Add product</a></li>
		  <li><a href="addsale.php">New sale</a></li>
		  <li><a href="view.php">View sales</a></li>
		  <li><a href="reports.php">Reports</a></li>
		</nav>
		<div>
			<h2>
				Edit a sale by it's ID.
			</h2>
		<section/>
		<div class = "main">
			<p>
				<table border = "1">
				<caption><h3>Sales list</h3></caption>
					<tr>
						<th>Sale ID</th>
						<th>Product ID</th>
						<th>Date of sale</th>
						<th>Amount sold</th>
						<th>Sold by</th>
					</tr>
					<?php
					//sessions variable are global variables that are accessable over multiple
					//pages.
					session_start();
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
					//Saves the Sale ID so we can use it when we're updating it's values
					$_SESSION["SaleIdToUpdate"] = $_POST['saleid'];
					//Get the values entered on the web page for the following field
					$SaleID = $_POST['saleid'];
					//Get the sale entry with this Sale ID
					$sql = "SELECT * FROM salelist WHERE sale_id = '$SaleID'";
					if (!mysqli_query($con,$sql))
					{
						echo 'Could not find record for Sale ID: '.$_SESSION["SaleIdToUpdate"];
					}
					//If our query is succesful, save the result into a variable called
					//$result. The amount of rows stored in the result is then stored as well.
					//this is to check whether there were no sales with that ID, In which case
					//a message will be displayed to inform the user.
					else
					{
						$result = mysqli_query($con, $sql);
						$nResults = mysqli_num_rows($result);
					}
					if ($nResults > 0) {
						echo 'Showing results for sale with ID No.: '.$_SESSION["SaleIdToUpdate"];
					}
					else
					{
						echo '<font color="red">There was no sale found with that Sale ID. Return to the
						view sales page and use the salelist table to find a valid Sale ID.</font>';
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
				</p>
				<p>
				<form action="code_only/update_sale.php" method="post">
					<table>
						<tr>
							<td>Product ID:</td><td class="inputfield"> <input type="text" name="prodid" maxlength="4" size="2"></td>
						</tr>
						<tr>
							<td>Date sold:</td><td class="inputfield"> <input type="text" name="datesold" maxlength="10" size="6"></td>
						</tr>
						<tr>
							<td>Amount sold:</td><td class="inputfield"> <input type="text" name="amountsold" maxlength="6" size="3"></td>
						</tr>
						<tr>
							<td>Sold by:</td><td class="inputfield"> <input type="text" name="soldby" maxlength="15" size="12"></td>
						</tr>
					</table>
					<p>
						<input type="submit" value="Update sale">
					</p>
				</form>
				</p>
			
		<div/>
	</body>
</html>