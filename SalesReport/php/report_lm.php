<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>View reports</title>
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
