<?php 
include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

$valid=false;

    if(isset($_POST['username']) and isset($_POST['password'])){
    $username = mysqli_real_escape_string($con,$_POST['username']); 
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $password = md5($password);
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        $rows = mysqli_num_rows($query);
        $row=mysqli_fetch_array($query);

        if($rows > 0){  //check if account exist
            $_SESSION['ID'] = $row[0];
            $_SESSION['username'] = $username;
            $txt = "Welcome, ".$_SESSION['username'];
            echo "<script>alert('$txt')</script>";
            if(check_admin()) // check if admin
            {
                header("Refresh:1; url=manage-order.php");
                mysqli_close($con);
                exit();
            }
            else{
                header("Refresh:1; url=index.php");
                mysqli_close($con);
                exit();
            }
        }
        else{
                $valid=true;
            }
}
    else{
        
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" test="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike</title>
</head>

<body>

    <?php
    nav();
    ?>

    <form class="res_form" method="post" action="login.php">
        <h2>Login</h2>
        <?php if($valid)echo '<label class="error">username or password is incorrect.</label>';?>
        <div class="input-group">
            <label>Username:</label>
            <input type="text" name="username" placeholder="username" required>
        </div>
        <div class="input-group">
            <label>Password:</label>
            <input type="password" name="password" placeholder="password" required>
        </div>
        <div class="input-group">
            <button type="submit" name="login" class="btn">Login</button>
        </div>
        <p>Not a member? <a href="register.php"><u>Create Account</u></a></p>

    </form>

</body>

</html>