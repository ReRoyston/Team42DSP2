<?php
$con = mysqli_connect('127.0.0.1','root','');
if(!$con)
{
 echo 'Not Connected To Server';
}
if (!mysqli_select_db ($con,'sales'))
{
 echo 'Database Not Selected';
}

//$Name = $_POST['username'];
//$Email = $_POST['email'];
$ProdName = $_POST['prodname'];
$ProdType = $_POST['prodtype'];
$SalePrice = $_POST['saleprice'];
$SupplierPrice = $_POST['supplierprice'];


//$sql = "insert into products (Name,Email) values ('$Name','$Email')";
$sql = "insert into products (prod_name, prod_type, sale_price, supplier_price) 
values ('$ProdName', '$ProdType', '$SalePrice', '$SupplierPrice')";


if (!mysqli_query($con,$sql))
{
 echo 'Not Inserted';
}

else
{
 echo 'New product added to database successfully';
}

header("refresh:4; url=../html/addprod.php");


?>﻿