<?php 
include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

    //if user is not logged in, they cant access this page
    checkSESSION();
    
$query="select * from products"; 
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

        <h2>Products</h2>
        <a href="product_add.php" class="addBtn">Add Product</a>

        <table class="product_table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Update</th>
                <th>Remove</th>
            </tr>

            <?php while($rows=mysqli_fetch_array($result)) 
		{ 
		?>
            <tr>
                <td><?php echo $rows['id']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['image']; ?></td>
                <td><?php echo $rows['text']; ?></td>
                <td><?php echo $rows['price']; ?>$</td>
                <td><a href="product_update.php?i=<?php echo $rows['id']; ?>" class="update-btn">Update</a></td>
                <td><a href="product_del.php?i=<?php echo $rows['id']; ?>" class="delete-btn">Delete</a></td>
            </tr>
            <?php 
        } 
    ?>
        </table>
        <br>



</body>

</html>