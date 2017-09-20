

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
$ProdName = $_POST['prodname'];
$ProdType = $_POST['prodtype'];
$SalePrice = $_POST['saleprice'];
$SupplierPrice = $_POST['supplierprice'];
//Takes the user input values and adds them to our DB using an INSERT statement
$sql = "INSERT INTO PRODUCTS (prod_name, prod_type, sale_price, supplier_price) 
values ('$ProdName', '$ProdType', '$SalePrice', '$SupplierPrice')";
//If our query isn't successful then display a message
if (!mysqli_query($con,$sql))
{
 echo 'Not Inserted';
}
//If it is successful it will navigate to this php page and show this message
//then after 4 seconds, return to the add product web page.
else
{
 echo 'New product added to database successfully';
}
header("refresh:4; url=../addprod.php");

?>﻿