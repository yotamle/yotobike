<script src="https://use.fontawesome.com/0a6f028271.js"></script>


<?php

function ConnectToDB() // connect to DB;
{

    $con = mysqli_connect("eu-cdbr-west-01.cleardb.com", "b6655255f2a1bf", "fb494638", "heroku_8533435ff881e33");
mysqli_set_charset($con,"utf8");

return $con;


}

function pro_count() // product count
{
$count=0;
if(isset($_SESSION['cart']))
{
$count=count($_SESSION['cart']);
}
return $count;
}




function nav() // web navbar
{
?>
<div class="container">
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.png" width="150px">
        </div>
        <?php if (isset($_SESSION["username"])): ?>
        <p><ins>Hello</ins>, <strong> <?php echo $_SESSION['username']; ?></strong></p>
        <?php endif ?>
        <nav>
            <ul>
                <?php
            if(!check_user() AND $_SERVER['PHP_SELF'] != "/www/yotobike/login.php" AND $_SERVER['PHP_SELF'] != "/www/yotobike/register.php")
            {
            ?>
                <li><a href="login.php">Login</a></li>
                <?php
            }
            ?>
                <?php
            if(check_user() AND $_SERVER['PHP_SELF'] != "/www/yotobike/profile.php")
            {
            ?>
                <li><a href="index.php?logout='1'">Logout</a></li>
                <?php
            }
            ?>
                <?php
            if(!check_user())
            {
            ?>
                <li><a href="web.php">Home</a></li>
                <?php
            }
            ?>
                <?php
            if(check_user())
            {
            ?>
                <li><a href="index.php">Home</a></li>
                <?php
            }
            ?>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
            if($_SERVER['PHP_SELF'] != "/www/yotobike/products.php" AND $_SERVER['PHP_SELF'] != "/www/yotobike/search.php")
            {
            ?>
                <li><a href="search.php"><i class='fas fa-search'></i></a></li>
                <?php
            }
            ?>
                <?php
            if($_SERVER['PHP_SELF'] == "/www/yotobike/products.php")
            {
            ?>
                <li><a href="mycart.php"><i class='fa fa-shopping-cart'></i>(<?php echo pro_count(); ?>)</a></li>
                <?php
            }
            if(check_user() AND $_SERVER['PHP_SELF'] != "/www/yotobike/account.php" AND $_SERVER['PHP_SELF'] != "/www/yotobike/show_order.php" AND $_SERVER['PHP_SELF'] != "/www/yotobike/details_user.php" AND $_SERVER['PHP_SELF'] != "/www/yotobike/details_order.php")
            {
                $con = ConnectToDB();
                if(check_user())
                {
                $id = $_SESSION['ID'];
                $query_id = mysqli_query($con, "SELECT * FROM profiles WHERE id='$id'");
                $rows_id = mysqli_num_rows($query_id);
                if($rows_id == 1) {
                    ?>
                <li><a href="account.php"><i class='far fa-user-circle'></i></a></li>
                <?php
                } else {
                    ?>
                <li><a href="profile.php"><i class='far fa-user-circle'></i></a></li>
                <?php
                    }
                }
                    
                
            }
            ?>



            </ul>
        </nav>
    </div>
</div>
<?php

    }
    

function admin_nav() // admin navbar
    {
    ?>
<nav>
    <ul>
        <li><a href="index.php?logout='1'">Logout</a></li>
        <li><a href="manage-order.php">Orders</a></li>
        <li><a href="manage-product.php">Products</a></li>
        <li><a href="manage-user.php">Users</a></li>


    </ul>
</nav>
<?php
    }

function check_user() // check if has user session
    {
    if(isset($_SESSION['username']))
        return true;
    else
        return false;
    }

function check_admin() // check if admin log in
    {
    if($_SESSION['ID'] == 1)
        return true;
    else
        return false;
    }


function logout() // logout method
    {
    if (isset($_GET['logout'])) {
    unset($_SESSION['username']);
    unset($_SESSION['ID']);
    session_destroy();
    header('location: index.php');
    }

    }

function checkSESSION() // check if have session
    {
    if(!(isset($_SESSION['username']))) {
        header('location: login.php');
    }
    }


function footer() {
    ?>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-col">
                <h4>company</h4>
                <ul>
                    <li><a href="about.php">about us</a></li>
                    <li><a href="contact.php">contact us</a></li>
                    <li><a href="#">our services</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">shipping</a></li>
                    <li><a href="#">returns</a></li>
                    <li><a href="#">order status</a></li>
                    <li><a href="#">payment options</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <span id="copy">&copy Yotobike 2021</span>



</footer>


<?php
}


?>