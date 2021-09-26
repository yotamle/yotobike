<?php
include('function.php'); 
session_start(); 
// connect to database
$con = ConnectToDB();

   //if user is not logged in, they cant access this page
    checkSESSION();
    $id = $_SESSION['ID'];



    if (isset($_POST['create'])) { // create user profile
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $birthday = mysqli_real_escape_string($con,$_POST['birthday']);
    $gender = mysqli_real_escape_string($con,$_POST['gender']);
    $iduser = mysqli_real_escape_string($con,$_POST['iduser']);
    $phone= mysqli_real_escape_string($con,$_POST['phone']);
    $address = mysqli_real_escape_string($con,$_POST['address']);
    $payment = mysqli_real_escape_string($con,$_POST['payment']);
    
        $sql = "insert into profiles(name,birthday,gender,iduser,phone,address,payment,id) values ('$name','$birthday','$gender','$iduser','$phone','$address','$payment','$id');";
            if($con->query($sql) === TRUE){ 
            echo '<script>alert("User Create Successfully")</script>';
            mysqli_close($con);
            header('Refresh:1; url=index.php');
            exit();
        }
        else
        {
            echo '<script>alert("ID Number Already Exist")</script>';
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
    <form class="res_form" method="post" action="profile.php">
        <h2>Make a Profile</h2>
        <div class="input-group">
            <label>FullName:</label>
            <input type="text" name="name" placeholder="fullname" value="<?php if(isset($name)) echo $name;?>" required>
        </div>
        <div class="input-group">
            <label>Birthday:</label>
            <input type="date" name="birthday" value="<?php if(isset($birthday)) echo $birthday;?>" required>
        </div>
        <div class="input-group">
            <label>Gender:</label>
        </div>
        <div>
            <input type="radio" name="gender" value="male" required> Male
            <input type="radio" name="gender" value="female"> Female
        </div>
        <div class="input-group">
            <label>ID Number:</label>
            <input type="text" name="iduser" placeholder="id number" pattern="[0-9]{9}"
                title="ID must contain 9 characters" required>
        </div>
        <div class="input-group">
            <label>Phone No:</label>
            <input type="text" name="phone" placeholder="phone number" value="<?php if(isset($phone)) echo $phone;?>"
                pattern="[0-9]{10}" title="Phone Number must contain 10 characters" required>
        </div>
        <div class="input-group">
            <label>Address:</label>
            <input type="text" name="address" placeholder="address" value="<?php if(isset($address)) echo $address;?>"
                required>
        </div>
        <div class="input-group">
            <label>Payment info:</label>
        </div>
        <div>
            <input type="radio" name="payment" value="visa" required> Visa

            <input type="radio" name="payment" value="paypal"> Paypal
        </div>
        <div class="input-group">
            <button type="submit" name="create" class="btn">Create Profile</button>
        </div>
    </form>

</body>

</html>