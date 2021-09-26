<?php 
include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

    //if user is not logged in, they cant access this page
    checkSESSION();

$i = $_GET['i'];

    
$query="select * from orders 
inner join products ON orders.product_id = products.id where order_id='$i'";
$result=mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike</title>
</head>

<body>

    <?php
    nav();
    ?>
    <h2>My Account</h2>

    <div class="account_menu">
        <a href="account.php?my_details=1"><i class='fas fa-user-circle'></i>My details</a>
        <a href="account.php?my_order=1"><i class='fas fa-box-open'></i>My orders</a>
    </div>
    <a href="account.php?my_order=1" class="btn">Back</a>
    <table class="table_order">
        <tr>
            <th>Product Image</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Price</th>


        </tr>

        <?php while($rows=mysqli_fetch_array($result)) 
		{ 
		?>
        <tr>
            <td><img src="images/<?php echo $rows["image"]; ?>" width="100px"></td>
            <td><?php echo $rows['product_id']; ?></td>
            <td><?php echo $rows['item_name']; ?></td>
            <td>$<?php echo $rows['price']; ?></td>
        </tr>

        <?php 
        } 
    ?>
    </table>
    <br>









</body>

</html>