<!DOCTYPE html>
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
          <tr>
            <td class="radiotable"><input type="radio" name="gender" value="thisweek" checked = "checked"> This week</td>
            <td class="radiotable"><input type="radio" class="radiotable" name="gender" value="lastweek"> Last week</td>
          </tr>

          <tr>
            <td class="radiotable"><input type="radio" name="gender" value="thismonth"> This month</td>
            <td class="radiotable"><input type="radio" name="gender" value="lastmonth"> Last month</td>
          </tr>
        <table>
      </p>
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

                    if(isset($_POST['gender']))
                    {
                        //doing some code to match if it is week or month, and then generate CSV file

                      $select = "SELECT * FROM salelist";
                      $result = mysqli_query($con,$select);
                      $fields = mysqli_fetch_assoc ($result);
                      $myfile = fopen("thedatafile.CSV", "w");
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
                      echo 'CSV file has been created.';

                      //echo the report table or do anything else





                    }

                    ?>


    <div/>
  </body>
</html>
