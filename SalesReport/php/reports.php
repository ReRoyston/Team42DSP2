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
  <title>View reports</title>
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
        View sales reports
      </h2>
    <section/>
    <div class = "main">
      <p>
        <table>
      <form action="" method="post">
        <tr>
        <td class="radiotable"><input type="radio" name="timeframe" value="thismonth"
        checked = "checked"> This month</td>
        <td class="radiotable"><input type="radio" name="timeframe" value="lastmonth"> Last month</td>
        </tr>
        <tr>
        <td class="radiotable"><input type="radio" name="timeframe" value="thisweek"> This week</td>
        <td class="radiotable"><input type="radio" name="timeframe" value="lastweek"> Last week</td>
        </tr>
        <tr>
        <td><p><input type="submit" value="Generate report"></p></td>
        </tr>
      </form>
        <table>
      </p>
          <?php

                    if(isset($_POST['timeframe']))
                    {
            $TimeFrame = $_POST['timeframe'];
            $TodaysDate = date('d/m/Y');
            $ThisMonth = substr($TodaysDate, 3);
            $LastMonth = substr($TodaysDate, 3, 2);
            $LastMonth--;
            if ($LastMonth < 10)
            {
              $LastMonth = "0".$LastMonth.substr($TodaysDate, 5);
            }
            else
            {
              $LastMonth = $LastMonth.substr($TodaysDate, 5);
            }
            $ItemNameForReport = "";
            $TotalProfitForReport = "";
            $UnitsSoldForReport = "";
            $StockRemainingForReport = "";

            // Write code to convert month to string like october instead of 10

            //	COULD MAKE A FUNCTION SO THE CODE ISN'T REPEATED BUT DON'T HAVE TimeFrame

            if ($TimeFrame == "thismonth")
            {
              $sql = "SELECT S.prod_id, P.prod_name, sum(S.amount_sold) AS Total_Items_Sold, 
			  (sum(P.sale_price - P.supplier_price) * S.amount_sold) AS Total_Profit, P.units_in_stock AS Stock_remaining
              FROM salelist S
              RIGHT JOIN products P
              ON S.prod_id = P.prod_id
              WHERE date_sold LIKE '%$ThisMonth'
              GROUP BY S.prod_id, Stock_remaining;";
              //If our query isn't successful then display a message
              if (!mysqli_query($con, $sql))
              {
               echo '<p>Could not retrieve sales for this date</p>';
              }
              //If our query is succesful, save the result into a variable called
              //$result.
              else
              {
                $result = mysqli_query($con, $sql);
              }
              if (mysqli_num_rows($result) == 0) {
                echo "<p><font color='red'>There was no
                results found for this month</font></p>";
              }
              else
              {
                ?>
                <p>
                  <table border = "1" align="center">
                  <caption><h3>Showing results for this month</h3></caption>
                    <tr>
                      <th>Product name</th>
                      <th>Total amount sold</th>
                      <th>Total profit</th>
                      <th>Stock remaining</th>
                    </tr>
                    <?php while($row = mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['Total_Items_Sold'];?></td>
                        <td><?php echo $row['Total_Profit'];?></td>
                        <td><?php echo $row['Stock_remaining'];?></td>
                    </tr>
                    <?php endwhile;?>
                  </table>
                </p>
                <?php
              }
            }

            if ($TimeFrame == "lastmonth")
            {
              $sql = "SELECT S.prod_id, P.prod_name, sum(S.amount_sold) AS Total_Items_Sold, 
			  (sum(P.sale_price - P.supplier_price) * S.amount_sold) AS Total_Profit, P.units_in_stock AS Stock_remaining
              FROM salelist S
              RIGHT JOIN products P
              ON S.prod_id = P.prod_id
              WHERE date_sold LIKE '%$LastMonth'
              GROUP BY S.prod_id, Stock_remaining;";


              //If our query isn't successful then display a message
              if (!mysqli_query($con, $sql))
              {
               echo '<p>Could not retrieve sales for this date</p>';
              }
              //If our query is succesful, save the result into a variable called
              //$result.
              else
              {
                $result = mysqli_query($con, $sql);
              }
              if (mysqli_num_rows($result) == 0) {
                echo "<p><font color='red'>There was no
                results found for this month</font></p>";
              }
              else
              {
                ?>
                <p>
                  <table border = "1" align="center">
                  <caption><h3>Showing results for this month</h3></caption>
                    <tr>
                      <th>Product name</th>
                      <th>Total amount sold</th>
                      <th>Total profit</th>
                      <th>Stock remaining</th>
                    </tr>
                    <?php while($row = mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['Total_Items_Sold'];?></td>
                        <td><?php echo $row['Total_Profit'];?></td>
                        <td><?php echo $row['Stock_remaining'];?></td>
                    </tr>
                    <?php endwhile;?>
                  </table>
                </p>
                <?php
              }
            }

                    }





                      $select = "SELECT * FROM salelist";
                      $result = mysqli_query($con,$select);
                      $fields = mysqli_fetch_assoc ($result);
                      $myfile = fopen("thedatafileSales.CSV", "w");
                      $line = "";
                      $comma = "";
                      foreach($fields as $name =>$value ){
                        $line .= $comma.'"'.str_replace('"','""',$name).'"';
                        $comma =",";
                      }
                      $line .="\n";
                      fputs($myfile,$line);

                      // remove the result pointer back to the start
                      mysqli_data_seek($result, 0);
                      // and loop through the actual data
                      while($row = mysqli_fetch_assoc($result)) {

                        $line = "";
                        $comma = "";
                        foreach($row as $value) {
                          $line .= $comma . '"' . str_replace('"', '""', $value) . '"';
                          $comma = ",";
                        }
                        $line .= "\n";
                        fputs($myfile, $line);
                      }

                      fclose($myfile);
                      echo '<p>CSV file has been created for sales record.</p>';

                      //echo the report table or do anything else
                      $select = "SELECT * FROM employees";
                      $result = mysqli_query($con,$select);
                      $fields = mysqli_fetch_assoc ($result);
                      $myfile2 = fopen("thedatafileEmployee.CSV", "w");
                      $line = "";
                      $comma = "";
                      foreach($fields as $name =>$value ){
                        $line .= $comma.'"'.str_replace('"','""',$name).'"';
                        $comma =",";
                      }
                      $line .="\n";
                      fputs($myfile2,$line);

                      // remove the result pointer back to the start
                      mysqli_data_seek($result, 0);
                      // and loop through the actual data
                      while($row = mysqli_fetch_assoc($result)) {

                        $line = "";
                        $comma = "";
                        foreach($row as $value) {
                          $line .= $comma . '"' . str_replace('"', '""', $value) . '"';
                          $comma = ",";
                        }
                        $line .= "\n";
                        fputs($myfile2, $line);
                      }

                      fclose($myfile2);
                      echo 'CSV file has been created for employee record.';


                      $select = "SELECT * FROM products";
                      $result = mysqli_query($con,$select);
                      $fields = mysqli_fetch_assoc ($result);
                      $myfile3 = fopen("thedatafileProducts.CSV", "w");
                      $line = "";
                      $comma = "";
                      foreach($fields as $name =>$value ){
                        $line .= $comma.'"'.str_replace('"','""',$name).'"';
                        $comma =",";
                      }
                      $line .="\n";
                      fputs($myfile3,$line);

                      // remove the result pointer back to the start
                      mysqli_data_seek($result, 0);
                      // and loop through the actual data
                      while($row = mysqli_fetch_assoc($result)) {

                        $line = "";
                        $comma = "";
                        foreach($row as $value) {
                          $line .= $comma . '"' . str_replace('"', '""', $value) . '"';
                          $comma = ",";
                        }
                        $line .= "\n";
                        fputs($myfile3, $line);
                      }

                      fclose($myfile3);
                      echo '<p>CSV file has been created for product record.</p>';



                    ?>


    <div/>
  </body>
</html>
