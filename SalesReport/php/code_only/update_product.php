



<!DOCTYPE html>
<html>
	<body>
		 <?php
        session_start();
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
			//Get the sale details entered if all fields have been filled.
			
				
				$ProdID = $_POST['prodid'];
				$ProductName = $_POST['prodname'];
				$ProductType = $_POST['prodtype'];
				$SalesPrice = $_POST['saleprice'];
                $SupplyPrice = $_POST['supplyprice'];
				//Takes the user input values and adds them to our DB using an INSERT statement
				$sql = 'UPDATE products SET prod_name="$ProductName",prod_type="$ProductType", sale_price="$SalesPrice", supplier_price="$SupplyPrice" WHERE prod_id="$ProdID" ';
				//If our query isn't successful then display a message
				if (!mysqli_query($con,$sql))
		{
		 echo 'Not updated';
		}
		//If it is successful it will navigate to this php page and show this message
		//then after 10 seconds, it will take the user back to the view sales page.
		else
		{
			 echo 'Products was successfully updated.
			 <br>You will be redirected to the edit product page again
			 <br>In 10 seconds.';
		}
                
            
				?>
		
		<table border = "1">
				<caption><h3>Product list</h3></caption>
					<tr>
						<th>Product ID</th>
						<th>Product Name</th>
                        <th>Product Type</th>
						<th>Sale Price</th>
						<th>Supply Price</th>
					</tr>
					<?php
					
					//SQL query to get all product entries from 'products' table
					$sql = "SELECT * FROM products";
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
						<td><?php echo $row['prod_id'];?></td>
						<td><?php echo $row['prod_name'];?></td>
						<td><?php echo $row['prod_type'];?></td>
						<td><?php echo $row['sale_price'];?></td>
                        <td><?php echo $row['supplier_price'];?></td>
					</tr>
					
				<?php endwhile;?>    
				</table>
				<?php
					header("refresh:10; url=../product_edit.php");
				?>
	</body>
</html>