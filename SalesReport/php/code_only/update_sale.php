



<!DOCTYPE html>
<html>
	<body>
		<?php
		//sessions variable are global variables that are accessable over multiple
		//pages.
		session_start();
		//Retrieve the sale ID from our session to use in the SQL statement.
		$SaleID = $_SESSION["SaleIdToUpdate"];
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
		//Get the values entered on the web page for the following fields
		$ProdID = $_POST['prodid'];
		$DateSold = $_POST['datesold'];
		$AmountSold = $_POST['amountsold'];
		$SoldBy = $_POST['soldby'];
		//Takes the user input values and changes them in our DB using an UPDATE statement
		$sql = "UPDATE SALELIST 
		SET prod_id = '$ProdID', date_sold = '$DateSold', 
		amount_sold = '$AmountSold', sold_by = '$SoldBy'
		WHERE sale_id = '$SaleID'";
		//If our query isn't successful then display a message
		if (!mysqli_query($con,$sql))
		{
		 echo 'Not updated';
		}
		//If it is successful it will navigate to this php page and show this message
		//then after 10 seconds, it will take the user back to the view sales page.
		else
		{
			 echo 'Sale was successfully updated.
			 <br>You will be redirected to the view sales page again
			 <br>In 10 seconds.';
		}
		?>﻿
		
		<table border = "1">
				<caption><h3>Sales list</h3></caption>
					<tr>
						<th>Sale ID</th>
						<th>Product ID</th>
						<th>Date of sale</th>
						<th>Amount sold</th>
						<th>Sold by</th>
					</tr>
					<?php
					
					//SQL query to get all product entries from 'products' table
					$sql = "SELECT * FROM salelist WHERE sale_id = '$SaleID'";
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
						<td><?php echo $row['prod_id'];?></td>
						<td><?php echo $row['date_sold'];?></td>
						<td><?php echo $row['amount_sold'];?></td>
						<td><?php echo $row['sold_by'];?></td>
					</tr>
					
				<?php endwhile;?>    
				</table>
				<?php
					header("refresh:10; url=../sale_view.php");
				?>
	</body>
</html>