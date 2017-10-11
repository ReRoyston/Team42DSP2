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
				Edit a sale by it's ID.
			</h2>
		<section/>
		<div class = "main">
			<p>
					<?php 
					$SaleIDToEdit = $_POST['saleidtoedit'];
					$ProductIDToEdit = $_POST['prodidtoedit'];
					echo "You are editing the sale with a <font color='1F8FFF'>Sale ID</font> of '".$SaleIDToEdit
					."' and a <font color='1F8FFF'>Product ID</font> of '".$ProductIDToEdit."'</font>";
					
					$sql = "SELECT * FROM salelist WHERE sale_id = '$SaleIDToEdit' AND prod_id = '$ProductIDToEdit'";
					if (!mysqli_query($con,$sql))
					{
						echo "Something went wrong.";
					}
					else
					{
						$result = mysqli_query($con, $sql);
						$row = mysqli_fetch_array($result);
					}
					?>
					
					<!-- This form needs to be reformatted to use drop down lists on the new sale page -->
					<form>
						<p>Date sold: <input type="textbox" name="datesold" value="<?php echo $row['date_sold']; ?>"></p>
						<!-- Include prod name here. need to Join SQL statement above to get it using prod id -->
						Amount sold: <input type="textbox" name="amountsold" value="<?php echo $row['amount_sold']; ?>"
						size="2" maxlength="5">
						<p>Sold by: <input type="textbox" name="soldby" value="<?php echo $row['sold_by']; ?>"></p>
						<p><input type="submit" value="Update"></p>
					</form>
		<div/>
	</body>
</html>