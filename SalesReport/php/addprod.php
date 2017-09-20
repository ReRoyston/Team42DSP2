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
		  <li><a class="active" href="addprod.php">Add product</a></li>
		  <li><a href="addsale.php">New sale</a></li>
		  <li><a href="view.php">View sales</a></li>
		  <li><a href="reports.php">Reports</a></li>
		</nav>
		<div>
			<h2>
				Add a new product to the product list
			</h2>
		<section/>
		<div class = "main">
			<p>
				<form action="code_only/add_product.php" method="post">
				<p>
				Product name: <input type="text" name="prodname" size="40">
				</p>
				Product type: <input type="text" name="prodtype">
				<p>
				Sale price: $<input type="text" name="saleprice" maxlength="6" size="3">
				</p>
				Supplier price: $<input type="text" name="supplierprice" maxlength="6" size="3">
				<p>
				<input type="submit" value="Add product">
				</p>
				</form>
			</p>
			<p>
			<table border="1">
				<caption><h3>Product list</h3></caption>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Sale price</th>
					<th>Supplier price</th>
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
				$sql = "SELECT * FROM `products`";
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
						<td><?php echo $row['prod_id'];?></td>
						<td><?php echo $row['prod_name'];?></td>
						<td><?php echo $row['prod_type'];?></td>
						<td><?php echo $row['sale_price'];?></td>
						<td><?php echo $row['supplier_price'];?></td>
					</tr>
					
				<?php endwhile;?>      
            </table>
			</p>
		<div/>
	</body>
</html>