<?php

$id = $_GET['i'];

$con =  mysqli_connect('localhost', 'root', '', 'yotobikedb');
mysqli_query($con, "delete from products where id='$id'");

header('location: manage-product.php');

?>