<!DOCTYPE html>
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

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>Add new product</title>
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
				New product
			</h2>
		<section/>
		<div class = "main">
			<p>
			
			<p>
			<p>
				<form action="" method="post">
				<table>
				
				<tr><td class="inputname">Product name:</td><td class="inputfield"> <input type="text" name="prodname" size="40"></td></tr>
				
				<tr><td class="inputname">Product type:</td><td class="inputfield">  <input type="text" name="prodtype" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 47
				 || event.charCode == 32'></td></tr>
				
				<tr><td class="inputname">Sale price: $</td><td class="inputfield"><input type="text" name="saleprice" maxlength="6" size="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46'></td></tr>
				
				<tr><td class="inputname">Supplier price: $</td><td class="inputfield"><input type="text" name="supplierprice" maxlength="6" size="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46'></td></tr>
				
				<tr><td class="inputname">Current stock:</td><td class="inputfield"><input type="text" name="stockleft" maxlength="6" size="3" onkeypress='return (event.charCode >= 48 && event.charCode <= 57)'></td></tr>
				</table>
				<p>
				<input type="submit" value="Add product">
				</p>
				</form>
			</p>
			<br>
			
			<?php
				if (isset($_POST['producttype'])) {
					if ($_POST['producttype'] != "") {
						echo "Showing results for search of: '".$_POST['producttype']."'";
					}
					else
					{
						echo "<font color=\"red\">Nothing entered to search for</font>";
					}
				}
				
			?>
			
			
				<!-- This code php segment is for adding a new product to the product list    -->
				<?php
				if (isset($_POST['prodname']) && isset($_POST['prodtype']) 
				&& isset($_POST['saleprice']) && isset($_POST['supplierprice']) 
				&& isset($_POST['stockleft']) )
				{
					if ($_POST['prodname'] != "" && $_POST['prodtype'] != "" 
					&& $_POST['saleprice'] != "" && $_POST['supplierprice'] != ""
					&& $_POST['stockleft'] != "")
					{
						//Get the values entered on the web page for the following fields
						$ProdName = $_POST['prodname'];
						$ProdType = $_POST['prodtype'];
						$SalePrice = $_POST['saleprice'];
						$SupplierPrice = $_POST['supplierprice'];
						$StockLeft = $_POST['stockleft'];
						//Takes user's inputs and adds them to the products table in
						//our DB using an INSERT statement
						$sql = "INSERT INTO PRODUCTS (prod_name, prod_type, sale_price, supplier_price, units_in_stock) 
						values ('$ProdName', '$ProdType', '$SalePrice', '$SupplierPrice',
						'$StockLeft')";
						//If our query isn't successful then display a message
						if (!mysqli_query($con,$sql))
						{
						 echo 'Not Inserted';
						}
						//If it is successful it will navigate to this php page and show this message
						//then after 7 seconds, return to the add product web page.
						else
						{
						 echo 'New product added to database successfully';
						}
						?>
						
						<table border="1" align="center" >
						<caption><h3>New product added!</h3></caption>
						<tr>
							<th>Product ID</th>
							<th>Product Name</th>
							<th>Product Type</th>
							<th>Sale price</th>
							<th>Supplier price</th>
							<th>Stock remaining</th>
						</tr>
						
						<?php
						
						$sql = "SELECT * FROM products 
						WHERE prod_name = '$ProdName'";
						
						//If our query isn't successful then display a message
						if (!mysqli_query($con, $sql))
						{
						 echo 'Could not retrieve new product';
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
								<td><font color="green"><?php echo $row['prod_id'];?></font></td>
								<td><font color="green"><?php echo $row['prod_name'];?></font></td>
								<td><font color="green"><?php echo $row['prod_type'];?></font></td>
								<td><font color="green"><?php echo '$'.$row['sale_price'];?></font></td>
								<td><font color="green"><?php echo '$'.$row['supplier_price'];?></font></td>
								<td><font color="green"><?php echo $row['units_in_stock'];?></font></td>
							</tr>
							
						<?php endwhile;?>
					
					</table>
					<br>
					<br>
					
				<?php
					}
					else
					{
						echo "<font color=\"red\">All fields must be filled to add a product to the Database.</font><br><br>";
					}
				}
				?>
				
				<form action="" method="post">
					<p>To check if a product already exists, search by 
					<font color="1F8FFF"><b>Product type</b></font>. </p>
					<b>Product type</b>: <input type="text" name = "producttypesearch" 
					maxlength = "20" size ="10" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 47
					|| event.charCode == 32'>
					<p>
					<input type="submit" value="Search">
					</p>
				</form>
				
				<table border="1" align="center">
				<caption><h3>Product list</h3></caption>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th><font color="1F8FFF"><b>Product Type</b></font></th>
                    <th>Sale price</th>
					<th>Supplier price</th>
					<th>Stock remaining</th>
                </tr>
				<!-- This code php segment is for searching for products by the product type -->
				<?php
				
				if (isset($_POST['producttypesearch'])) {
					$prodsearch = $_POST['producttypesearch'];
					$sql = "SELECT * FROM products 
					WHERE prod_type LIKE '%$prodsearch%';";
				}
				//SQL query to get all product entries from 'products' table
				else {
					$sql = "SELECT * FROM products
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
					if (isset($_POST['producttypesearch']) && $_POST['producttypesearch'] != "")
					{
						echo "Showing results for: '".$_POST['producttypesearch']."'.";
					}
				}
				//Fetch the array stored in $result and output it to a table
				//using a while loop.
				?>
				<?php while($row = mysqli_fetch_array($result)):?>
					<tr>
						<td><?php echo $row['prod_id'];?></td>
						<td><?php echo $row['prod_name'];?></td>
						<td><font color="1F8FFF"><b><?php echo $row['prod_type'];?></font></b></td>
						<td><?php echo '$'.$row['sale_price'];?></td>
						<td><?php echo '$'.$row['supplier_price'];?></td>
						<td><?php echo $row['units_in_stock'];?></td>
					</tr>
					
				<?php endwhile;?> 
            </table>
			<br>
		<div/>
	</body>
</html>