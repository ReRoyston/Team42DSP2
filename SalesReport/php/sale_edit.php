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
					
					$sql = "SELECT S.date_sold, S.sale_id, P.prod_id, 
						P.prod_name,  S.sold_by, S.amount_sold
						FROM salelist S
						RIGHT JOIN products P
						ON S.prod_id = P.prod_id
						WHERE S.sale_id = '$SaleIDToEdit' AND S.prod_id = '$ProductIDToEdit'";
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
					<form>
						<table>
							<!-- using this $date variable with sub string to
							break up all the dates -->
							<?php $date = $row['date_sold'] ?>
							</tr>
								<td class="inputname">Date sold:</td>
								<td class="inputfield">
									<select name="dsold">
										<option value="<?php echo substr("$date",0,2);?>">
											<?php echo substr("$date",0,2);?>
										</option>
									</select>
									<select name="msold">
										<option value="<?php echo substr("$date",3,2);?>">
											<?php echo substr("$date",3,2);?>
										</option>
									</select>
									<select name="ysold">
										<option value="<?php echo substr("$date",6);?>">
											<?php echo substr("$date",6);?>
										</option>
									</select>
								<td>
							</tr>
							<tr>
								<td class="inputname">Amount sold:</td>
								<td class="inputfield"><input type="textbox" name="amountsold" value="<?php echo $row['amount_sold']; ?>" size="2" maxlength="5"></td>
							</tr>
							<tr>
								<td class="inputname">Sold by:</td>
								<td class="inputfield">
									<?php   
									$sql= "SELECT emp_id, emp_name FROM EMPLOYEES ORDER BY emp_name ASC";
									$result= mysqli_query($con, $sql);
									echo "<select name='soldby'>";
									while($row2 = mysqli_fetch_array($result)){
										if ($row['sold_by'] == $row2['emp_name'])
										{
											echo "<option value='".$row2['emp_name']."' selected>".$row2['emp_name']."</option>";
										}
										else
										{	
													echo "<option value='".$row2['emp_name']."' >".$row2['emp_name']."</option>";
										}
									}
									 echo "</select>";
									?>
								</td>
							</tr>
							<tr>
								<td><p><input type="submit" value="Update"><p></td>
							</tr>
						</table>
					</form>
					<p>
					<table border="1" align="center">
						<caption><h3>Current sale details</h3></caption>
						<tr>
							<th>Date of sale</th>
							<th>Sale ID</th>
							<th>Product name</th>
							<th>Sold by</th>
							<th>Amount sold</th>
						</tr>
					
						<tr>
						<?php $date = $row['date_sold'] ?>
							<td><?php echo $date;?></td>
							<td><?php echo $row['sale_id'];?></td>
							<td><?php echo $row['prod_name'];?></td>
							<td><?php echo $row['sold_by'];?></td>
							<td><?php echo $row['amount_sold'];?></td>
						</tr>
					</table>
					</p>
		<div/>
	</body>
</html>