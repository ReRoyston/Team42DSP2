<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>View reports</title>
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
				View sales reports
			</h2>
		<section/>
		<div class = "main">
			<p>
				<table>
					<tr>
						<td class="radiotable"><input type="radio" name="gender" value="thisweek" checked = "checked"> This week</td>
						<td class="radiotable"><input type="radio" class="radiotable" name="gender" value="lastweek"> Last week</td>
					</tr>
					
					<tr>
						<td class="radiotable"><input type="radio" name="gender" value="thismonth"> This month</td>
						<td class="radiotable"><input type="radio" name="gender" value="lastmonth"> Last month</td>
					</tr>
				<table>
			</p>
		
			
		<div/>
	</body>
</html>
