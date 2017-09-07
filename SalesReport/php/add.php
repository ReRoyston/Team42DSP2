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
		  <li><a class="active" href="add.php">New sale</a></li>
		  <li><a href="view.php">View sales</a></li>
		  <li><a href="reports.php">Reports</a></li>
		</nav>
		<div>
			<h2>
				Add a new sale entry
			</h2>
		<section/>
		<div class = "main">
			<p>
				Item ID: <input type="text" id ="itemid" name = "Item ID" 
				maxlength = "5" size ="1">
				<br/>
				<br/>
				Quantity: <input type="text" id ="quantity" name = "Quantity" 
				maxlength = "3" size ="1">
				<p>
				<div class="submitDiv">
					<input type="submit" class="submitBtns" value="Submit">
				</div>
				</p>
			</p>
		<div/>
	</body>
</html>
