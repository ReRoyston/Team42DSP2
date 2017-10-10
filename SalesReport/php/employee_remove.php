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
	<title>Remove employee</title>
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
				Remove employee
			</h2>
		<section/>
		<div class = "main">
			<p>
			<form action="" method="post">
				Choose an employee to remove from the database
				<p><font color="1F8FFF">You will not be asked to confirm whether to delete. <br>
				It is easy to re-add an employee if they're deleted by mistake.</font></p>
				<?php   
				$select_query= "SELECT emp_id, emp_name FROM EMPLOYEES ORDER BY emp_name ASC";
				$select_query_run= mysqli_query($con, $select_query);
				echo "<select name='empname'>";
				while($row = mysqli_fetch_array($select_query_run)){
							echo "<option value='".$row['emp_name']."' >".$row['emp_name']."</option>";
				}
				 echo "</select>";
				?>
				
				<p>
				<input type="submit" value="Remove Employee">
				</p>
			</form>
			<?php
				if (isset($_POST['empname'])) 
				{
					if ($_POST['empname'] != "") 
					{
						$EmployeeName = $_POST['empname'];
						
						$sql = "DELETE FROM EMPLOYEES
						WHERE emp_name='$EmployeeName';";
						
						if (!mysqli_query($con, $sql))
						{
							echo 'Unable to add remove employee from the Database.';
						}
						else
						{
							echo '<p><font color="1F8FFF">'.$EmployeeName.' succesfully removed
							from the database</font></p>';
						}
					}
				}
			?>
		<div/>
	</body>
</html>