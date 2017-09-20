<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>Add sale</title>
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
				<form action="code_only/add_sale.php" method="post">
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
						<input type="submit" value="Add sale">
					</p>
				</form>
			</p>
			<p>
				Use the product list below to make sure you have the <font color="1F8FFF"><b>correct ID</b></font> otherwise
				you won't be able to add it to the Database.
			</p>
			<p>
			<table border="1" align="center">
				<caption><h3>Product list</h3></caption>
                <tr>
                    <th><font color="1F8FFF">Product ID<font></th>
                    <th>Product Name</th>
                    <th>Product Type</th>
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
				//SQL query to get relevant product fields from 'products' table
				$sql = "SELECT prod_id, prod_name, prod_type FROM products;";
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
						<td><font color="1F8FFF"><b><?php echo $row['prod_id'];?></b></font></td>
						<td><?php echo $row['prod_name'];?></td>
						<td><?php echo $row['prod_type'];?></td>
					</tr>
					
				<?php endwhile;?>      
            </table>
			</p>
		<div/>
	</body>
</html>
