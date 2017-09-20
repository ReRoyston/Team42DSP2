<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>Sales report system</title>
	<header>
		<h1>Sales report system</h1>
	<header/>
	<body>
		<nav>
		  <li><a href="../html/home.html">Home</a></li>
		  <li><a href="addprod.php">Add product</a></li>
		  <li><a href="addsale.php">New sale</a></li>
		  <li><a href="view.php">View sales</a></li>
		  <li><a class="active" href="reports.php">Reports</a></li>
		</nav>
		<div>
			<h2>
				View sales reports
			</h2>
		<section/>
		<div class = "main">
			<p>
			<input type="radio" name="gender" value="thisweek" checked = "checked"> This week
				<input type="radio" name="gender" class="secondrow" 
				value="lastweek"> Last week<br>
				
				<input type="radio" name="gender" value="thismonth"> This month
				<input type="radio" name="gender" class="secondrow"
				value="lastmonth"> Last month
			</p>
		
			<table border = "1">
					<tr>
						<th>Profit rank</th>
						<th>Product name</th>
						<th>Units sold</th>
						<th>Sale price</th>
						<th>Supplier cost</th>
						<th>Total profit</th>
					</tr>
					<tr>
						<td>1</td>
						<td>Vitamin C</td>
						<td>122</td>
						<td>$8</td>
						<td>$2.50</td>
						<td>$671</td>
					</tr>
				</table>
				<br>
		<div/>
	</body>
</html>
