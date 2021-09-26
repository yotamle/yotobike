<?php
include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

   //if user is not logged in, they cant access this page
    checkSESSION();

    $id = $_SESSION['ID'];
    if (isset($_POST['update'])) { 
        $id=$_POST['id'];
      $name = mysqli_real_escape_string($con,$_POST['name']);
      $birthday = mysqli_real_escape_string($con,$_POST['birthday']);
      $gender = mysqli_real_escape_string($con,$_POST['gender']);
      $phone= mysqli_real_escape_string($con,$_POST['phone']);
      $address = mysqli_real_escape_string($con,$_POST['address']);
      $payment = mysqli_real_escape_string($con,$_POST['payment']);
      
            
       
        $sql ="update profiles set name='$name',phone='$phone', address='$address', birthday='$birthday', gender='$gender', payment='$payment' where id='$id'";
            if($con->query($sql) === TRUE){ 
            echo '<script>alert("Profile Successfully Update")</script>';
            mysqli_close($con);
            header('Refresh:1; url=account.php');
            exit();
            }
             else
            {
              echo '<script>alert("Error, please try again")</script>';
             }
         }

        else{
        $query ="select * from profiles inner join users ON profiles.id = users.id where profiles.id='$id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
         }
    
    

  
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
    <?php 
    if(isset($_GET['my_details'])){
        $id = $_SESSION['ID'];
        ?>
    <form class="res_form" method="POST" action="account.php" enctype="multipart/form-data">
        <h2>Profile</h2>
        <input type="hidden" name="size" value="1000000">
        <input type="hidden" name="id" value=<?php echo $id; ?>>
        <div class="input-group">
            <label>FullName:</label>
            <input type="text" name="name" required value="<?php echo $row['name']; ?>">
        </div>
        <div class="input-group">
            <label>Email Address:</label>
            <input type="text" name="email" disabled value="<?php echo $row['email']; ?>">
        </div>
        <div class="input-group">
            <label>ID Number:</label>
            <input type="text" name="iduser" disabled value="<?php echo $row['iduser']; ?>">
        </div>
        <div class="input-group">
            <label>Phone Number:</label>
            <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
        </div>
        <div class="input-group">
            <label>Address:</label>
            <input type="text" name="address" required value="<?php echo $row['address']; ?>">
        </div>
        <div class="input-group">
            <label>Gender:</label>
        </div>
        <div>
            <input type="radio" name="gender" required value="male" <?php
        if($row['gender']=='male')
        {
            echo "checked";
        }
        ?>> Male
            <input type="radio" name="gender" value="female" <?php
        if($row['gender']=='female')
        {
            echo 'checked';
        }
        ?>> Female
        </div>
        <div class="input-group">
            <label>Birthday:</label>
            <input type="date" name="birthday" required value="<?php echo $row['birthday']; ?>">
        </div>

        <div class="input-group">
            <label>Payment Method:</label>
        </div>


        <input type="radio" name="payment" required value="visa" <?php
        if($row['payment']=='visa')
        {
            echo "checked";
        }
        ?>> Visa
        <input type="radio" name="payment" value="paypal" <?php
        if($row['payment']=='paypal')
        {
            echo 'checked';
        }
        ?>>Paypal
        <div>
            <button type="submit" name="update" class="btn-update">Update Profile</button>
        </div>
    </form>
    <?php
    }

   
    if(isset($_GET['my_order'])){ 
        $query="SELECT * FROM orders where user_id='$id' group by order_id order by order_id DESC"; 
        $result=mysqli_query($con, $query);
        ?>
    <table class="table_order">
        <tr>
            <th>Order No.</th>
            <th>Order Details</th>
        </tr>

        <?php while($rows=mysqli_fetch_array($result)) 
		{ 
		?>
        <tr>
            <td>Order Number <?php echo $rows['order_id']; ?></td>
            <td><a href="show_order.php?i=<?php echo $rows['order_id']; ?>" class="view_order_btn"></i>View Order</a>
            </td>
        </tr>
        <?php 
        } 
        ?>
    </table>
    <?php
      
    } 
    ?>
    <br>

</body>

</html>