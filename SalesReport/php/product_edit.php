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
	<title>Edit sale</title>
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
				Edit a product by it's ID.
			</h2>
		</div>
		<div class = "main">
			<p>
				<table border = "1">
				<caption><h3>Products list</h3></caption>
					<tr>
						<th>Product ID</th>
						<th>Product Name</th>
                        <th>Product Type</th>
						<th>Sale Price</th>
						<th>Supply Price</th>
						<th>Stock Remaining</th>
					</tr>
					<?php
					$ProductIDToEdit = $_POST['prodidtoedit'];
					$sql = "SELECT * FROM products
					WHERE prod_id = $ProductIDToEdit";
					if (!mysqli_query($con,$sql))
					{
						echo 'Could not find record';
					}
					//If our query is succesful, save the result into a variable called
					//$result. The amount of rows stored in the result is then stored as well.
					//this is to check whether there were no sales with that ID, In which case
					//a message will be displayed to inform the user.
					else
					{
						$result = mysqli_query($con, $sql);
					}
					?>
					<?php while($row = mysqli_fetch_array($result)):?>
					<?php
					$ProdIDToEdit = $row['prod_id'];
					$ProdNameToEdit = $row['prod_name'];
					$ProdTypeToEdit = $row['prod_type'];
					$SalePriceToEdit = $row['sale_price'];
					$SupplierPriceToEdit = $row['supplier_price'];
					$StockRemainingToEdit = $row['units_in_stock'];
					?>
					<tr>
						<td><?php echo $ProdIDToEdit;?></td>
						<td><?php echo $ProdNameToEdit;?></td>
						<td><?php echo $ProdTypeToEdit;?></td>
						<td><?php echo $SalePriceToEdit;?></td>
                        <td><?php echo $SupplierPriceToEdit;?></td>
						<td><?php echo $StockRemainingToEdit;?></td>
					</tr>
				<?php endwhile;?>    
				</table>
				</p>
        
				<p>
				<form action="" method="post">
					<table>
						<tr>
							<td class="inputname">Product ID:</td><td class="inputfield"><?php echo $ProdIDToEdit; ?></td>
						</tr>
                        <tr>
							<td class="inputname">Product Name:</td><td class="inputfield"> 
							<input type="text" name="prodname" value = "<?php echo $ProdNameToEdit;?>" maxlength="40" size="30"></td>
						</tr>
						<tr>
							<td class="inputname">Product Type:</td><td class="inputfield"> 
							<input type="text" name="prodtype" value = "<?php echo $ProdTypeToEdit;?>" maxlength="30" size="30"></td>
						</tr>
						<tr>
							<td class="inputname">Sales Price:</td><td class="inputfield"> 
							<input type="text" name="saleprice" value = "<?php echo $SalePriceToEdit;?>" maxlength="6" size="4"></td>
						</tr>
						<tr>
							<td class="inputname">Supply Price:</td><td class="inputfield"> <input type="text" name="supplyprice" value = "<?php echo $SupplierPriceToEdit;?>" maxlength="6" size="4"></td>
						</tr>
						<tr>
							<td class="inputname">Stock Remaining:</td><td class="inputfield"> <input type="text" name="stockremaining" value = "<?php echo $StockRemainingToEdit;?>" maxlength="6" size="4"></td>
						</tr>
					</table>
					<p>
						<input type="submit" value="Update Product">
					</p>
				</form>
        
        <?php
			//Get the sale details entered if all fields have been filled.
			if (isset($_POST['prodname']) && isset($_POST['prodtype']) && isset($_POST['saleprice']) && isset($_POST['supplyprice']) && isset($_POST['stockremaining'])) 
			{
				if ($_POST['prodname'] != "" && $_POST['prodtype'] != "" && $_POST['saleprice'] != "" && $_POST['supplyprice'] != "" && $_POST['stockremaining'] != "")
				{
					$ProdID = $ProdIDToEdit;
					$ProductName = $_POST['prodname'];
					$ProductType = $_POST['prodtype'];
					$SalePrice = $_POST['saleprice'];
					$SupplyPrice = $_POST['supplyprice'];
					$StockRemaining = $_POST['stockremaining'];
					
					$SalesPrice = $_POST['saleprice'];
					$SupplyPrice = $_POST['supplyprice'];
					//Takes the user input values and adds them to our DB using an INSERT statement
					$sql = "UPDATE products SET prod_name='$ProductName',prod_type='$ProductType', 
					sale_price='$SalesPrice', supplier_price='$SupplyPrice', units_in_stock = '$StockRemaining'
					WHERE prod_id='$ProdID' ";
					//If our query isn't successful then display a message
					if (!mysqli_query($con,$sql))
					{
					 echo '<font color="red">Make sure you\'re using a valid Product ID and not duplicating them.</font>';
					}
					else
					{
						 echo '<p><font color="green">Product update to database successfully</font><p>';
					}
                }
            }
				?>
				</p>
			
		<div/>
	</body>
</html>