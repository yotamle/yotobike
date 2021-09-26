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
    <link rel="stylesheet" test="text/css" href="style.css">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike Admin</title>

</head>

<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="images/logo.png" width="150px">
            </div>
            <?php if (isset($_SESSION["username"])): ?>
            <p><ins>Hello</ins>, <strong> <?php echo $_SESSION['username']; ?></strong></p>
            <?php endif  ?>
            <?php
            admin_nav();
             ?>

        </div>
        <h2>Order Details</h2>
        <a href="manage-order.php" class="btn">Back</a>
        <table class="table">
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
                <td><?php echo $rows['price']; ?>$</td>
            </tr>

            <?php 
        } 
    ?>



        </table>




</body>

</html>