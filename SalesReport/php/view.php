<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<header>
		<h1>Sales report system</h1>
	<header/>
	<body>
		<nav>
		  <li><a href="home.php">Home</a></li>
		  <li><a href="add.php">New sale</a></li>
		  <li><a class="active" href="view.php">View sales</a></li>
		  <li><a href="reports.php">Reports</a></li>
		</nav>
		<div>
			<h2>
				View sales
			</h2>
		<section/>
		<div class = "main">
			<form action="">
			<p>
				
				<table border = "1">
					<tr>
						<th>Date of sale</th>
						<th>Product id</th>
						<th>Product name</th>
						<th>Cost per unit</th>
						<th>Amount sold</th>
						<th>Sale id</th>
					</tr>
					<tr>
						<td>1</td>
						<td>Vitamin C</td>
						<td>06/09/2017</td>
						<td>$8</td>
						<td>3</td>
						<td>1</td>
					</tr>
				</table>
				
				<p>This page can also be used to edit sales by their sale id. </p>
				Sale id: <input type="text" id ="quantity" name = "Quantity" 
				maxlength = "7" size ="2">
				<p>
				<button type="button">Edit entry</button>
				</p>
			</p>
			</form>
		<div/>
	</body>
</html>
