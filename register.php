<?php
include('function.php'); 
session_start();
// connect to database 
$con = ConnectToDB();

$valid_pass=false;
$valid_name=false;
$valid_email=false;

    if (isset($_POST['register'])) { // create web account
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password_1 = mysqli_real_escape_string($con,$_POST['password_1']);
    $password_2 = mysqli_real_escape_string($con,$_POST['password_2']);
    $query_name = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    $query_email = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
    $rows_name = mysqli_num_rows($query_name);
    $rows_email = mysqli_num_rows($query_email);
        if($rows_email > 0) {// if The email already exist in the DB
            $valid_email=true;
        }
        if($rows_name > 0) {// if The username already exist in the DB
            $valid_name=true;
        }
        if ($password_1 != $password_2) { // if passwords not match
            $valid_pass=true;
        }
        if($valid_email == false and $valid_name == false and $valid_pass == false) {
        $password = md5($password_1);
        $sql = "insert into users(username,email,password) values ('$username', '$email', '$password');";
            if($con->query($sql) === TRUE){ 
            echo '<script>alert("User Create Successfully")</script>';
            $query_id = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
            $rows_id=mysqli_fetch_array($query_id);
            mysqli_close($con);
            $_SESSION['ID'] = $rows_id[0];
            $_SESSION["username"] = $username;
            header('Refresh:1; url=profile.php');
            exit();
        }
        else
        {
            echo '<script>alert("Unsuccessfully")</script>';
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike</title>
</head>

<body>
    <?php
    nav();
    ?>
    <form class="res_form" method="post" action="register.php">
        <h2>Register</h2>
        <div class="input-group">
            <label>Username:</label>
            <input type="text" name="username" placeholder="username"
                value="<?php if(isset($username)) echo $username;?>" required>
        </div>
        <?php if($valid_name)echo '<label class="error">Name Already Exist.</label><br>';?>
        <div class="input-group">
            <label>Email:</label>
            <input type="text" name="email" placeholder="email" value="<?php if(isset($email)) echo $email;?>"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="Email must contain @ in email address, example(user@gmail.com)" required>
        </div>
        <?php if($valid_email)echo '<label class="error">Email Already Exist.</label>';?>
        <div class="input-group">
            <label>Password:</label>
            <input type="password" name="password_1" placeholder="password" pattern=".{6,}"
                title="Six or more characters" required>
        </div>
        <div class="input-group">
            <label>Confirm Password:</label>
            <input type="password" name="password_2" placeholder="confirm password" required>
        </div>
        <?php if($valid_pass)echo '<label class="error">Password not match.</label><br>';?>
        <div class="input-group">
            <button type="submit" name="register" class="btn">Register</button>
        </div>
        <p>Already a member? <a href="login.php"><u>Sign in</u></a></p>

    </form>

</body>

</html>