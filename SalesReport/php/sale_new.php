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
				echo '<p>All items will be added to the same sale unless you tick this box<br>
				<font  color="1F8FFF">New sale? <input type="checkbox" name="whichsale"></font></p>';
				?>
					<table>
						<tr>
							<td>Product Name:</td><td>
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
							<td>Date sold:</td>
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
							<td>Amount sold:</td><td class="inputfield"> <input type="text" name="amountsold" maxlength="6" size="3"></td>
						</tr>
						<tr>
							<td>Sold by:</td>
							<td class="inputfield">
								<?php   
								$select_query= "SELECT emp_id, emp_name FROM EMPLOYEES ORDER BY emp_name ASC";
								$select_query_run= mysqli_query($con, $select_query);
								echo "<select name='soldby'>";
								while($row = mysqli_fetch_array($select_query_run)){
								
								/* $$$$$$$$$$$$$$$$$$$$$$$$$						Write code here to pre-select the name of the previous entrant*/
									/*if (isset($_SESSION['Sold_By']))
									{
										if ($row['emp_name'] = $_SESSION['Sold_By'])
										{
										echo "<option value='".$row['emp_name']."' selected>".$row['emp_name']."</option>";
										}
										else
										{*/
											echo "<option value='".$row['emp_name']."' >".$row['emp_name']."</option>";
										//}
									//}
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
				if ($_POST['prodid'] != "" && $_POST['amountsold'] != "" && $_POST['soldby'])
				{
					if (isset($_POST['whichsale']))
					{
						$HighestID = $HighestID + 1;
					}
					$ProdID = $_POST['prodid'];
					$sql1 = ("SELECT * FROM PRODUCTS
					WHERE prod_id = '$ProdID';");
					$result = mysqli_query($con, $sql1);
					$row = mysqli_fetch_array($result);
					$ProdName = $row['prod_name'];
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
					$AmountSold = $_POST['amountsold'];
					$SoldBy = $_POST['soldby'];
					
					$UpdatedStock = 
					//Takes the user input values and adds them to our DB using an INSERT statement
					$sql2 = "INSERT INTO SALELIST (sale_id, prod_id, date_sold, amount_sold, sold_by) 
					values ('$HighestID', '$ProdID', '$DateSold', '$AmountSold', '$SoldBy');";
					
					//If our query isn't successful then display a message
					if (!mysqli_query($con,$sql2))
					{
						echo '<font color="red">You\'ve already added this product ('.$ProdName.') to the sale.<br><br>
						If this is a new sale, tick the box above.</font>';
					}
					//If it is successful it will navigate back to the add sale page
					//in 8 seconds.
					else
					{
						echo '<font color="green">New sale added to database successfully</font>';
						 
						$sql3 = "UPDATE PRODUCTS
						SET units_in_stock = units_in_stock - '$AmountSold'
						WHERE prod_id = '$ProdID';";
						
						if (!mysqli_query($con,$sql3))
						{
							echo 'Can\'t subtract the remaining stock, you may
							have an incorrect stock count and be trying to subtract from 0';
						}
					}
					}
					else
					{
						echo "<font color=\"red\">All fields must be filled to add a new sale to the DB.</font>";
					}
					}
					
					 
					
				?>﻿
				
				<table border = "1">
						<caption><h3>On this sale so far</h3></caption>
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
