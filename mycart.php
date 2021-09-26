<?php
include('function.php'); 

session_start(); 
logout();
// connect to database
$con = ConnectToDB();

   //if user is not logged in, they cant access this page
   checkSESSION();



    if (isset($_POST['submit'])) { // Make order
        $sql = "SELECT ID FROM order_number";
    $result=mysqli_query($con,$sql);
    $order_number=mysqli_fetch_array($result);
    $order_number=$order_number[0];
    $id = $_SESSION['ID'];
    if (isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            $sql = "insert into orders(user_id,order_id, product_id,item_name,price) values ('$id', '$order_number', '$value[Item_Id]','$value[Item_Name]', '$value[Price]');";
            if($con->query($sql) === TRUE){ 
            
            unset($_SESSION['cart'][$key]);
            }

        }
        echo '<script>alert("Your order has been successful")</script>';
    }
    $sql = "UPDATE order_number SET ID = '$order_number'+1";
    mysqli_query($con,$sql);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike</title>
</head>

<body>


    <?php
    nav();
    ?>

    <h2>Shopping Cart</h2>
    <div>
        <div class="cart_table">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $total=0;
                    if (isset($_SESSION['cart']))
                    {
                        foreach($_SESSION['cart'] as $key => $value)
                        {
              
                            $total=$total+$value['Price'];
                            echo"
                                <tr>
                                    <td>$value[Item_Id]</td>
                                    <td>$value[Item_Name]</td>
                                    <td>$$value[Price]</td>
                                    <td>
                                        <form class='remove' action='manage_cart.php' method='POST'>
                                            <button name='Remove_Item' class='remove-btn'>REMOVE</button>
                                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                        </form>
                                    </td>
                                </tr>
                            ";       

                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div>
                <form class="checkout" method="post" action="mycart.php">
                    <h2>Total: $<?php echo $total ?></h2>
                    <div>
                        <input type="checkbox" name="rules" required> Confirm your details are correct, and agree to
                        terms and conditions of the site.
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn-checkout">Make Purchase</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>