<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>View all sales</title>
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
				View sales
			</h2>
		<section/>
		<div class = "main">
			<p>
			<form action="" method="post">
				<p>You can search a sale by entering part of all of a  
				<u>Sale date</u>. </p>
				<b>Sale date:</b> <input type="text" name = "saledate" 
				maxlength = "10" size ="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 47'>
				
				<p>
				<input type="submit" value="Search">
				</p>
			</form>
			<?php
				if (isset($_POST['saledate'])) {
					if ($_POST['saledate'] != "") {
						echo "Showing results for search of: '".$_POST['saledate']."'";
					}
				}
				
			?>
			
			</p>
				<table border = "1" align="center">
				<caption><h3>Sales list</h3></caption>
				<p>
					<tr>
						<th>Date of sale</th>
						<th><font color="1F8FFF">Sale ID</font></th>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Sold by</th>
						<th>Amount sold</th>
						<th>Profit</th>
						<th> </th>
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
					
					
					//SQL query to get all relevant sales and product details to show to 
					//the user
					if (isset($_POST['saledate'])) {
						$searchdate = $_POST['saledate'];
						$sql = "SELECT salelist.date_sold, salelist.sale_id, products.prod_id, products.prod_name,  salelist.sold_by, salelist.amount_sold, 
						(salelist.amount_sold * (products.sale_price - products.supplier_price)) AS profit
						FROM salelist
						RIGHT JOIN products
						ON salelist.prod_id = products.prod_id
						WHERE salelist.sale_id IS NOT NULL AND salelist.date_sold LIKE '%$searchdate%'
						ORDER BY salelist.sale_id DESC;";
					}
					else {
						$sql = "SELECT salelist.date_sold, salelist.sale_id, products.prod_id, products.prod_name,  salelist.sold_by, salelist.amount_sold, 
						(salelist.amount_sold * (products.sale_price - products.supplier_price)) AS profit
						FROM salelist
						RIGHT JOIN products
						ON salelist.prod_id = products.prod_id
						WHERE salelist.sale_id IS NOT NULL
						ORDER BY salelist.sale_id DESC
						LIMIT 20;";
					}
					//If our query isn't successful then display a message
					if (!mysqli_query($con, $sql))
					{
					 echo 'Could not retrieve sales list';
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
						<form method="POST" action="sale_edit.php">
							<td><?php echo $row['date_sold'];?></td>
							<td><font color="1F8FFF"><b><?php echo $row['sale_id'];?></b></font></td>
							<td><?php echo $row['prod_id'];?></td>
							<td><?php echo $row['prod_name'];?></td>
							<td><?php echo $row['sold_by'];?></td>
							<td><?php echo $row['amount_sold'];?></td>
							<td><?php echo '$'.$row['profit'];?></td>
							<input type="hidden" name="saleidtoedit" value="<?php echo $row['sale_id']; ?>" />
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
