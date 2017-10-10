<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css">
	</head>
	<title>View reports</title>
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
				View sales reports
			</h2>
		<section/>
		<div class = "main">
            <form action="" method="post">
			<p>
				<table>
					<tr>
						<td class="radiotable"><input type="radio" name="gender" value="thisweek" checked = "checked"> This week</td>
						<td class="radiotable"><input type="radio" class="radiotable" name="gender" value="lastweek"> Last week</td>
					</tr>
					
					<tr>
						<td class="radiotable"><input type="radio" name="gender" value="thismonth"> This month</td>
						<td class="radiotable"><input type="radio" name="gender" value=""> Last month</td>
					</tr>
                </table>
			</p>
            <p>
						<input type="submit" value="Generate report">
					</p>
                </form>
                  
                    
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
                    
                    /*if(isset($_POST['gender']))
                    {
                        //doing some code to match if it is week or month, and then generate CSV file
                        if ($_POST['gender']=="thisweek")
                        {
                            $myfile = fopen("thisweek.CSV", "w")
                        }
                        if ($_POST['gender']=="lastweek")
                        {
                            $myfile = fopen("lastweek.CSV", "w")
                        }
                        if ($_POST['gender']=="thismonth")
                        {
                            $myfile = fopen("thismonth.CSV", "w")
                        }
                        if ($_POST['gender']=="lastmonth")
                        {
                            $myfile = fopen("lastmonth.CSV", "w")
                        }
                        
                    }*/
            
                    ?>
		
			
		<div/>
	</body>
</html>
