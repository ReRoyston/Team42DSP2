<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>View reports</title>
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
