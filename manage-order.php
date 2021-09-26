<?php 
include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

    //if user is not logged in, they cant access this page
    checkSESSION();
    

$query="select * from profiles 
inner join users ON profiles.id = users.id
inner join orders ON profiles.id = orders.user_id group by order_id";
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
        <h2>Orders</h2>
        <table class="table-order">
            <tr>
                <th>Order No.</th>
                <th>User ID</th>
                <th>Username</th>
                <th>FullName</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>




            <?php 
    $total_cash =0;
    $total_order=0;
    $order = 101;

    

    
    while($rows=mysqli_fetch_array($result)) 
		{ 
            $orderid = $rows['order_id'];
            $sql = "SELECT SUM(price) as total FROM orders WHERE order_id = $orderid";
            $res=mysqli_query($con, $sql); 
            $price =mysqli_fetch_array($res);
            $total=$price[0];
            $total_order= $orderid-$order;

            
		?>
            <tr>
                <td><?php echo $rows['order_id']; ?></td>
                <td><?php echo $rows['user_id']; ?></td>
                <td><?php echo $rows['username']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><?php echo $rows['phone']; ?></td>
                <td><?php echo $rows['address']; ?></td>
                <td>$<?php echo number_format($total,2); ?></td>
                <td><a href="view_order.php?i=<?php echo $rows['order_id']; ?>" class="contact-btn">View Order</a></td>
            </tr>
            <?php 
    
    $total_cash += $total;
        } 
    ?>
        </table>
        <br>


        <table class="table">
            <tr>
                <th>Total Orders</th>
                <th>Total Cash Earning</th>
            </tr>
            <td><?php echo $total_order; ?></td>
            <td>$<?php echo number_format($total_cash,2); ?></td>
        </table>
</body>

</html>