<!DOCTYPE html>

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
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>Remove product</title>
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
				Remove product
			</h2>
		<section/>
		<div class = "main">
			<p>Select the product to remove from the list below.</p>
				<p>
				<form action="code_only/update_sale.php" method="post">
					<table>
						<tr>
							<td class="inputname">Product Name:</td><td>
							<?php   
							$select_query= "SELECT prod_id, prod_name FROM PRODUCTS ORDER BY prod_name ASC";
							$select_query_run= mysqli_query($con, $select_query);
							echo "<select name='prodid'>";
							while($row = mysqli_fetch_array($select_query_run)){
							 echo "<option value='".$row['prod_id']."' >".$row['prod_name']."</option>";
							}
							 echo "</select>";
							?>
							</td>
						</tr>
					</table>
					<p>
						<input type="submit" value="REMOVE">
					</p>
				</form>
				</p>
			
		<div/>
	</body>
</html>