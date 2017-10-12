<!DOCTYPE html>
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
					?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>New employee</title>
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
				New employee
			</h2>
		<section/>
		<div class = "main">
			<p>
			<form action="" method="post">
				<p>Add a new employee to the database</p>
				<b>Employee name:</b> <input type="text" name = "empname" 
				maxlength = "15" size ="10" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122
				 || event.charCode == 32'>
				<p>
				<input type="submit" value="Add Employee">
				</p>
			</form>
			<?php
				if (isset($_POST['empname'])) {
					if ($_POST['empname'] != "") {
						$EmployeeName = $_POST['empname'];
						
						$sql = "INSERT INTO EMPLOYEES(emp_name)
						VALUES('$EmployeeName');";
						//If our query isn't successful then display a message
						if (!mysqli_query($con, $sql))
						{
							echo 'Unable to add employee to the Database. Make sure
							you\'re using a unique name.';
						}
						else
						{
							echo '<p><font color="green">'.$EmployeeName.' has been added to the Database!</font></p>';
						}
					}
					else
					{
						echo '<p><font color="red">You need to enter a name.</font></p>';
					}
				}
			?>
		<div/>
	</body>
</html>
