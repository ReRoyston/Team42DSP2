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
		  <li><a href="home.html">Home</a></li>
		  <li><a class="active" href="addprod.php">Add product</a></li>
		  <li><a href="addsale.html">New sale</a></li>
		  <li><a href="view.html">View sales</a></li>
		  <li><a href="reports.html">Reports</a></li>
		</nav>
		<div>
			<h2>
				Add a new product to the product list
			</h2>
		<section/>
		<div class = "main">
			<p>
				<form action="../php/add_product.php" method="post">
				Product name: <input type="text" name="prodname" size="40">
				<br/>
				Product type: <input type="text" name="prodtype">
				<br/>
				Sale price: $<input type="text" name="saleprice" maxlength="6" size="3">
				<br/>
				Supplier price: $<input type="text" name="supplierprice" maxlength="6" size="3">
				<br/>
				<input type="submit" value="Add">

				</form>
			</p>
			
			<table border="1">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Sale price</th>
					<th>Supplier price</th>
                </tr>
				
				<?php
				$con = mysqli_connect('127.0.0.1','root','');
				if(!$con)
				{
					echo 'Not Connected To Server';
				}
				if (!mysqli_select_db ($con,'sales'))
				{
					echo 'Database Not Selected';
				}

				$sql = "SELECT * FROM `products`";

				if (!mysqli_query($con, $sql))
				{
				 echo 'Could not retrieve product list';
				}
				else
				{
					$result = mysqli_query($con, $sql);
				}
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
		<div/>
	</body>
</html>