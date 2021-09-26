<?php

session_start();



if ($_SERVER["REQUEST_METHOD"]=="POST")

{
    if(isset($_POST['Add_To_Cart'])) // add item to cart
    {
        if(isset($_SESSION['cart'])) // if already in cart
        {
            $my_items=array_column($_SESSION['cart'],'Item_Name');
            if(in_array($_POST['Item_Name'],$my_items))
            {
                echo"<script>
                  alert('Item Already Added');
                  window.location.href='products.php';
                  </script>";
                
            }
            else
            {
                $count=count($_SESSION['cart']);
                $_SESSION['cart'][$count]=array('Item_Id'=>$_POST['product_id'],'Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price']);
                echo"<script>
                    alert('Item Added');
                    window.location.href='products.php';
                </script>";
            }
        }
        else
        {
          $_SESSION['cart'][0]=array('Item_Id'=>$_POST['product_id'],'Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price']);
          echo"<script>
                  alert('Item Added');
                  window.location.href='products.php';
                </script>";
        }
    }
    if(isset($_POST['Remove_Item'])) // remove item form cart
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['Item_Name']== $_POST['Item_Name'])
            {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart']=array_values($_SESSION['cart']);
                echo"<script>
                alert('Item Remove');
                window.location.href='mycart.php';
                </script>";
            }
        }
    }
}
?>