



<!DOCTYPE html>
<html>
	<body>
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
		//Get the users values entered on the web page for the following fields
		$ProdID = $_POST['prodid'];
		$DateSold = $_POST['datesold'];
		$AmountSold = $_POST['amountsold'];
		$SoldBy = $_POST['soldby'];
		//Takes the user input values and adds them to our DB using an INSERT statement
		$sql = "INSERT INTO SALELIST (prod_id, date_sold, amount_sold, sold_by) 
		values ('$ProdID', '$DateSold', '$AmountSold', '$SoldBy')";
		//If our query isn't successful then display a message
		if (!mysqli_query($con,$sql))
		{
		 echo 'Not added';
		}
		//If it is successful it will navigate to this php page and show this message
		//then after 4 seconds, return to the add product web page.
		else
		{
			 echo 'New sale added to database successfully
			 \nYou will be redirected to the new sale page again
			 \nIn 10 seconds.';
		}
		header("refresh:8; url=../addsale.php");

		?>﻿
		
		<table border = "1">
				<caption><h3>Sales list</h3></caption>
					<tr>
						<th>Sale ID</th>
						<th>Product ID</th>
						<th>Date of sale</th>
						<th>Sold by</th>
						<th>Amount sold</th>
						
						
					</tr>
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
					//SQL query to get all product entries from 'products' table
					$sql = "SELECT * FROM salelist
					ORDER BY sale_id DESC";
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


	</body>
</html>