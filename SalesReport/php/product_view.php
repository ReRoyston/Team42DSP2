<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>View all sales</title>
	<header>
		<h1>Sales report system</h1>
	<header/>
	<body>
		<nav>
		  <ul>
			  <li><a href="../html/home.html">Home</a></li>
			  <li class="dropdown">
				<a href="sale_view.php" class="dropbtn">Sales</a>
				<div class="dropdown-content">
				  <a href="sale_view.php">View sales</a>
				  <a href="sale_new.php">New sale</a>
				  <a href="#">Edit sales</a>
				  <a href="#">Remove sales</a>
				</div>
			  </li>
			  <li class="dropdown">
				<a href="product_view.php" class="dropbtn">Products</a>
				<div class="dropdown-content">
				  <a href="product_view.php">View products</a>
				  <a href="product_new.php">New product</a>
				  <a href="#">Edit products</a>
				  <a href="#">Remove products</a>
				</div>
			  </li>
			  <li class="dropdown">
				<a href="report_tw.php" class="dropbtn">Reports</a>
				<div class="dropdown-content">
				  <a href="report_tw.php">This week</a>
				  <a href="#">Last week</a>
				  <a href="#">This month</a>
				  <a href="#">Last month</a>
				</div>
			  </li>
			</ul>
		</nav>
		<div>
			<h2>
				View products
			</h2>
		<section/>
		<div class = "main">
			<br>
			Showing the first 20 most recently added products.
			<!--<form action="filter products method name" method="post">
				<b>Filter results</b>: <input type="text" name = "filtervalue" 
				maxlength = "20" size ="10">
				<p>
				<input type="submit" value="Search">
				</p>
			</form>-->
				
			<table border="1" align="center">
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
				$sql = "SELECT * FROM `products`
				ORDER BY prod_id DESC";
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