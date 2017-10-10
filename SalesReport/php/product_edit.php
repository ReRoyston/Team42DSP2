<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>Edit sale</title>
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
				  <a href="product_edit.php">Edit products</a>
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

					$sql = "SELECT * FROM products";
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
						$nResults = mysqli_num_rows($result);
					}
					if ($nResults > 0) {
						echo 'Showing results for product with ID';
					}
					else
					{
						echo '<font color="red">There was no product found. Return to the
						view product page and check the product list.</font>';
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
        
				<p>
				<form action="" method="post">
					<table>
						<tr>
							<td>Product ID:</td><td class="inputfield"> <input type="text" name="prodid" maxlength="4" size="2"></td>
						</tr>
                        <tr>
							<td>Product Name:</td><td class="inputfield"> <input type="text" name="prodname" maxlength="40" size="30"></td>
						</tr>
						<tr>
							<td>Product Type:</td><td class="inputfield"> <input type="text" name="prodtype" maxlength="30" size="30"></td>
						</tr>
						<tr>
							<td>Sales Price:</td><td class="inputfield"> <input type="text" name="saleprice" maxlength="6" size="6"></td>
						</tr>
						<tr>
							<td>Supply Price:</td><td class="inputfield"> <input type="text" name="supplyprice" maxlength="6" size="6"></td>
						</tr>
					</table>
					<p>
						<input type="submit" value="Update products">
					</p>
				</form>
        
        <?php
			//Get the sale details entered if all fields have been filled.
			if (isset($_POST['prodid']) && isset($_POST['prodname']) && isset($_POST['saleprice'])&& isset($_POST['prodtype'])&& isset($_POST['supplyprice'])) 
			{
				if ($_POST['prodid'] != "" && $_POST['prodname'] != "" && $_POST['saleprice'])
				{
				
				$ProdID = $_POST['prodid'];
				$ProductName = $_POST['prodname'];
				$ProductType = $_POST['prodtype'];
				
				$SalesPrice = $_POST['saleprice'];
                $SupplyPrice = $_POST['supplyprice'];
				//Takes the user input values and adds them to our DB using an INSERT statement
				$sql = "UPDATE products SET prod_name='$ProductName',prod_type='$ProductType', sale_price='$SalesPrice', supplier_price='$SupplyPrice' WHERE prod_id='$ProdID' ";
				//If our query isn't successful then display a message
				if (!mysqli_query($con,$sql))
				{
				 echo '<font color="red">Make sure you\'re using a valid Product ID and not duplicating them.</font>';
				}
				

				else
				{
					 echo '<font color="green">Product update to database successfully</font>';
                    header("refresh:5; product_edit.php");
				}
                }
            }
				?>
				</p>
			
		<div/>
	</body>
</html>