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
			<br>
			<form action="" method="post">
				<p>You can search a product by entering a 
				<u>Product type or name</u>. </p>
				<b>Product type / name:</b> <input type="text" name = "producttype" 
				maxlength = "20" size ="10">
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
