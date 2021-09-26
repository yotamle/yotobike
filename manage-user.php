<?php
include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

    //if user is not logged in, they cant access this page
    checkSESSION();

$query="select * from users"; 
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
            <?php endif ?>
            <?php
            admin_nav();
             ?>
        </div>

        <h2>Users</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>

            <?php while($rows=mysqli_fetch_array($result)) 
		{ 
        if ($rows['id']!= 1) {
		?>
            <tr>
                <td><?php echo $rows['id']; ?></td>
                <td><?php echo $rows['username']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><a href="manage-user.php?i=<?php echo $rows['email']; ?>" class="contact-btn"
                        onclick="alert('Message has been send to <?php echo $rows['email']; ?>')">Contact</a>
                </td>
            </tr>

            <?php 
                }
        } 
          ?>

        </table>

</body>

</html>