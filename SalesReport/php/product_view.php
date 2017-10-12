<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>View all sales</title>
	<body>
		<nav>
		  <ul>
			  <li><a href="home.php">Home</a></li>
			  <li class="dropdown">
				<a href="sale_view.php" class="dropbtn">Sales</a>
				<div class="dropdown-content">
				  <a href="sale_view.php">View sales</a>
				  <a href="sale_new.php">New sale</a>
				  <a href="sale_remove.php">Remove sales</a>
				</div>
			  </li>
			  <li class="dropdown">
				<a href="product_view.php" class="dropbtn">Products</a>
				<div class="dropdown-content">
				  <a href="product_view.php">View products</a>
				  <a href="product_new.php">New product</a>
				  <a href="#">Remove products</a>
				</div>
			  </li>
			  <li class="dropdown">
				<a href="employee_new.php" class="dropbtn">Employees</a>
				<div class="dropdown-content">
				  <a href="employee_new.php">New employee</a>
				  <a href="employee_remove.php">Remove employee</a>
				</div>
			  </li>
			  <li><a href="reports.php">Reports</a></li>
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
			
			<form action="" method="post">
				<p>You can search a product by entering a 
				<u>Product type or name</u>. </p>
				<b>Product type / name:</b> <input type="text" name = "producttype" 
				 onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 47
				 || event.charCode == 32'>
				<p>
				<input type="submit" value="Search">
				</p>
			</form>
			
			<?php
				if (isset($_POST['producttype'])) {
					if ($_POST['producttype'] != "") {
						echo "Showing results for search of: '".$_POST['producttype']."'";
					}
					else
					{
						echo "Displaying first 20 rows of products";
					}
				}
				
			?>
			<p>
			<table border="1" align="center">
				<caption><h3>Product list</h3></caption>
                <tr>
                    <th><font color="1F8FFF">Product ID<font></th>
                    <th>Product Name</th>
                    <th>Product Type</th>
					<th>Stock remaining</th>
					<th>Sale price</th>
					<th>Supplier price</th>
					<th><font color="1F8FFF">Click to edit</font></th>
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
				if (isset($_POST['producttype'])) {
					$prodsearch = $_POST['producttype'];
					$sql = "SELECT * FROM products 
					WHERE prod_type LIKE '%$prodsearch%' OR prod_name LIKE '%$prodsearch%';";
				}
				//SQL query to get all product entries from 'products' table
				else {
					$sql = "SELECT * FROM products
					ORDER BY prod_type ASC, prod_name ASC
					LIMIT 20;";
				}
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
						<form method="POST" action="product_edit.php">
							<td><font color="1F8FFF"><b><?php echo $row['prod_id'];?></b></font></td>
							<td><?php echo $row['prod_name'];?></td>
							<td><?php echo $row['prod_type'];?></td>
							<td><?php echo $row['units_in_stock'];?></td>
							<td><?php echo $row['sale_price'];?></td>
							<td><?php echo $row['supplier_price'];?></td>
							<input type="hidden" name="prodidtoedit" value="<?php echo $row['prod_id']; ?>" />
							<td><input type="submit" value="Edit" /></td>
						</form>
					</tr>
					
				<?php endwhile;?>      
            </table>
			</p>
		<div/>
	</body>
</html>
