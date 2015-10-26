<?php
require_once './classes/cart.php';
$obj_cart=new Cart();
if(isset($_SESSION['customer_id']) && !(isset( $_SESSION['shipping_id'])))
{
    $page='shipping_form.php';
    
}
else if(isset($_SESSION['customer_id']) && (isset( $_SESSION['shipping_id'])))
{
    $page='payment_form.php';
}
 else {
    
     $page='cart_page.php';
}

include_once 'index.php';
