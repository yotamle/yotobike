<?php
include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

    //if user is not logged in, they cant access this page
    checkSESSION();

  $msg = "";
  if(isset($_GET['i']))
  $i = $_GET['i'];
  if (isset($_POST['update'])) { // update product
  
    $id=$_POST['id'];
  	$text = mysqli_real_escape_string($con, $_POST['text']);
    $name=$_POST['name'];
    $price=$_POST['price'];

    $sql ="UPDATE products SET text='$text', name='$name', price='$price' WHERE id='$id'";

      if($con->query($sql) === TRUE){ 
        echo '<script>alert("Product Update Successfully")</script>';
        mysqli_close($con);
        header('Refresh:1; url=manage-product.php');
        exit();
      }
        
  }
  else{
    $query = "SELECT * FROM products where id='$i'";
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
    <link rel="stylesheet" test="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
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

            <nav>
                <ul>
                    <li><a href="index.php?logout='1">Logout</a></li>
                    <li><a href="manage-product.php">Back</a></li>

                </ul>
            </nav>
        </div>

        <div id="content">
            <form class="res_form" method="POST" action="product_update.php" enctype="multipart/form-data">
                <h2>Update Product</h2>
                <input type="hidden" name="size" value="1000000">
                <input type="hidden" name="id" value=<?php echo $i; ?>>
                <label>Product ID: <?php echo $i; ?></label>
                <div>
                    <img src="images/<?php echo $row["image"]; ?>" class="card-img-top" alt="..." width="200px">
                </div>
                <div class="input-group">
                    <label>Description:</label>
                    <textarea style="resize:none" name="text" cols="38" rows="4"
                        name="text"><?php echo $row['text']; ?></textarea>
                </div>
                <div class="input-group">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>">
                </div>
                <div class="input-group">
                    <label>Price:</label>
                    <input type="text" name="price" value="<?php echo $row['price']; ?>">
                </div>
                <div>
                    <button type="submit" name="update" class="btn">Update Product</button>
                </div>
            </form>
        </div>

</body>

</html>