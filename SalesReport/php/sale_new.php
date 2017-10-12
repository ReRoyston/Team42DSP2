<!DOCTYPE html>
 <?php
			session_start();
			$HighestID = "0";
			$date = new DateTime();
			$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
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
	<title>New sale</title>
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
			<h1>
				New sale
			</h1>
		<section/>
		<div class = "main">
			
			<?php
			//Gets the highest id then adds + 1 for our new sale entry
			$sql = "SELECT sale_id FROM salelist";
			{
				$result = mysqli_query($con, $sql);
			}
			while($row = mysqli_fetch_array($result)):
			if ($row['sale_id'] > $HighestID)
			{
				$HighestID = $row['sale_id'];
			}
			endwhile;
			?>	
				<form action="" method="post">
				<?php
				echo '<p>For a new sale for the same employee, make sure you tick
				this box.<br>
				<font  color="1F8FFF">New sale? <input type="checkbox" name="whichsale"></font></p>';
				?>
					<table>
						<tr>
							<td class="inputname">Product Name:</td><td>
							<?php   
							$select_query= "SELECT prod_id, prod_name FROM PRODUCTS ORDER BY prod_name ASC";
							$select_query_run= mysqli_query($con, $select_query);
							echo "<select name='prodid'>";
							while($row = mysqli_fetch_array($select_query_run)){
							 echo "<option value='".$row['prod_id']."' >".$row['prod_name']."</option>";
							}
							 echo "</select>";
							?>
							</td>
						</tr>
						<tr>
							<td class="inputname">Date sold:</td>
							<td class="inputfield">
								<select name="msold">
									<?php foreach($months as $key => $month) { ?>
										<?php $default_month = ($key == $date->format('m'))?'selected':''; ?>
										<option <?php echo $default_month; ?> value="<?php echo $key; ?>">
											<?php echo $month; ?>
										</option>
									<?php } ?>
								</select>


								<select name="dsold">
									<?php for($day = 1; $day <= 31; $day++) { ?>
										<?php $default_day = ($day == $date->format('d'))?'selected':''; ?>
										<option <?php echo $default_day; ?> value="<?php echo $day; ?>">
											<?php echo $day; ?>
										</option>
									<?php } ?>
								</select>


								<select name="ysold">
									<?php for($year = $date->format('Y'); $year <= 2020; $year++) { ?>
										<option value="<?php echo $year; ?>">
											<?php echo $year; ?>
										</option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="inputname">Amount sold:</td><td class="inputfield">
							<input type="text" name="amountsold" size="2" maxlength="3"
							onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
							</input>
						</tr>
						<tr>
							<td class="inputname">Sold by:</td>
							<td class="inputfield">
								<?php   
								
								$sql1= "SELECT emp_id, emp_name FROM EMPLOYEES 
								ORDER BY emp_name ASC";
								$result1 = mysqli_query($con, $sql1);
								
								$sql2 = "SELECT sold_by from SALELIST ORDER BY sale_id DESC LIMIT 1";
								$result2 = mysqli_query($con, $sql2);
								$row2 = mysqli_fetch_array($result2);
								
								echo "<select name='soldby'>";
								while($row = mysqli_fetch_array($result1)){
									if ($row2['sold_by'] == $row['emp_name'])
									{
										echo "<option value='".$row['emp_name']."' selected>".$row['emp_name']."</option>";
									}
									else
									{	
										echo "<option value='".$row['emp_name']."' >".$row['emp_name']."</option>";
									}
								}
								 echo "</select>";
								?>
							</td>
						</tr>
						
					</table>
					<p>
						<input type="submit" value="Add sale">
					</p>
					</form>
				
				
				
			<?php
			//Get the sale details entered if all fields have been filled.
			if (isset($_POST['prodid']) && isset($_POST['amountsold']) && isset($_POST['soldby'])) 
			{
				if ($_POST['prodid'] != "" && $_POST['amountsold'] != "" && $_POST['soldby'] != "")
				{
					
					$ProdID = $_POST['prodid'];
					$sql1 = ("SELECT * FROM PRODUCTS
					WHERE prod_id = '$ProdID';");
					$result = mysqli_query($con, $sql1);
					$row = mysqli_fetch_array($result);
					$ProdName = $row['prod_name'];
					$SoldBy = $_POST['soldby'];
					
					$DaySold = $_POST['dsold'];
					if ($DaySold < 10)
					{
						$DaySold = "0".$_POST['dsold'];
					}
					$MonthSold = $_POST['msold'];
					if ($MonthSold < 10)
					{
						$MonthSold = "0".$_POST['msold'];
					}
					$YearSold = $_POST['ysold'];
					
					$DateSold = $DaySold."/".$MonthSold."/".$YearSold;
					$sql_prev_date = "SELECT date_sold FROM salelist
					WHERE sale_id = $HighestID";
					$sql_prev_seller = "SELECT sold_by FROM salelist
					WHERE sale_id = $HighestID";
					$DateOnThisSale = mysqli_query($con, $sql_prev_date);
					$SellerOnCurrentSale = mysqli_query($con, $sql_prev_seller);
					$DateRow = mysqli_fetch_array($DateOnThisSale);
					$EmployeeRow = mysqli_fetch_array($SellerOnCurrentSale);
					// This code checks if the user has ticked the new sale check,
					// if they're a different person or if the date is different.
					// if any of these conditions are met then a new sale is started.
					if (($DateSold != $DateRow['date_sold']) || ($SoldBy != $EmployeeRow['sold_by'])
					|| (isset($_POST['whichsale'])))
					{
						$HighestID++;
					}
					$AmountSold = $_POST['amountsold']; 
					//Takes the user input values and adds them to our DB using an INSERT statement
					$sql3 = "INSERT INTO SALELIST (sale_id, prod_id, date_sold, amount_sold, sold_by) 
					values ('$HighestID', '$ProdID', '$DateSold', '$AmountSold', '$SoldBy');";
					
					//If our query isn't successful then display a message
					if (!mysqli_query($con,$sql3))
					{
						echo '<font color="red">You\'ve already added this product ('.$ProdName.') to the sale.<br><br>
						If this is a new sale, tick the box above.</font>';
					}
					//If it is successful it will navigate back to the add sale page
					//in 8 seconds.
					else
					{
						$sql4 = "UPDATE PRODUCTS
						SET units_in_stock = units_in_stock - '$AmountSold'
						WHERE prod_id = '$ProdID';";
						
						if (!mysqli_query($con,$sql4))
						{
							echo 'Can\'t subtract the remaining stock, you may
							have an incorrect stock count and be trying to subtract from 0';
						}
						else 
						{
						?>
							<!--This refreshes the page so that it shows the most recent employee name in the drop list-->
							<meta http-equiv="refresh" content="0">
						<?php
						}
					}
				}
					else
					{
						echo "<font color=\"red\">All fields must be filled to add a new sale to the Database.</font>";
					}
					}
				?>﻿
				
				<table border = "1">
						<caption><h3>On this sale if you haven't ticked new sale</h3></caption>
							<tr>
								<th>Sale ID</th>
								<th>Date of sale</th>
								<th>Product name</th>
								<th>Amount sold</th>
								<th>Sold by</th>
								<th>Stock remaining</th>
							</tr>
							<?php
							
							//SQL query to get all product entries from 'products' table
							$sql = "SELECT S.sale_id, S.date_sold, P.prod_name,
							S.amount_sold, S.sold_by, P.units_in_stock 
							FROM salelist S
							RIGHT JOIN products P
							ON S.prod_id = P.prod_id
							WHERE S.sale_id = $HighestID";
							//If our query isn't successful then display a message
							if (!mysqli_query($con, $sql))
							{
							 echo 'Could not retrieve product list';
							}
							//If our query is succesful, save the result into a variable called
							//$result.
							else
							{
								$result = mysqli_query($con, $sql);
							}
							//Fetch the array stored in $result and output it to a table
							//using a while loop.
							?>
							<?php while($row = mysqli_fetch_array($result)):?>
							<tr>
								<td><?php echo $row['sale_id'];?></td>
								<td><?php echo $row['date_sold'];?></td>
								<td><?php echo $row['prod_name'];?></td>
								<td><?php echo $row['amount_sold'];?></td>
								<td><?php echo $row['sold_by'];?></td>
								<td><?php echo $row['units_in_stock'];?></td>
							</tr>
							
						<?php endwhile;?>    
						</table>
					
					<p>
				
			</p>
		<div/>
	</body>
</html>
