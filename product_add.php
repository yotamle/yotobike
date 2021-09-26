<?php
include('function.php'); 

// connect to database
  $con = ConnectToDB();

  $msg = "";


  if (isset($_POST['add-product'])) { // add new product
  	$image = $_FILES['image']['name'];

  	$text = mysqli_real_escape_string($con, $_POST['text']);
      
    $name=$_POST['name'];
    $price=$_POST['price'];


  	$target = "images/".basename($image);

  	$sql = "INSERT INTO products (image,text,name,price) VALUES ('$image', '$text','$name','$price')";

  	mysqli_query($con, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Product Add Successfully";
  	}else{
  		$msg = "Failed to Add Product";
  	}
      {
        echo"<script>
          alert('$msg');
          window.location.href='manage-product.php';
          </script>";
        
    }
  }
  $result = mysqli_query($con, "SELECT * FROM products");
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
            <form class="res_form" method="POST" action="product_add.php" enctype="multipart/form-data">
                <h2>Add New Product</h2>
                <input type="hidden" name="size" value="1000000">
                <div>
                    <input type="file" name="image">
                </div>
                <div class="input-group">
                    <label>Description:</label>
                    <textarea style="resize:none" id="text" cols="38" rows="4" name="text"
                        placeholder="Write a few words about the product"></textarea>
                </div>
                <div class="input-group">
                    <label>Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="input-group">
                    <label>Price:</label>
                    <input type="text" name="price" required>
                </div>
                <div>
                    <button type="submit" name="add-product" class="btn">Add Product</button>
                </div>
            </form>
        </div>



</body>

</html>