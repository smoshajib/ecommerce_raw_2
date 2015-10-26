<?php
session_start();
require_once 'database.php';
class Cart {
    //put your code here
    public function __construct() {
        $obj_db=new Database();
    }
    public function add_to_cart($data)
    {
        $product_id=$data['product_id'];
        $product_sales_quantity=$data['qty'];
        $sql="SELECT * FROM tbl_product WHERE product_id='$product_id'";
        $query_result=mysql_query($sql);
        $product_info=mysql_fetch_assoc($query_result);
        $session_id=  session_id();
        
        $sql="SELECT * FROM tbl_cart_temp WHERE  session_id='$session_id' AND product_id='$product_id'";
        $result=mysql_query($sql);
        $product_info_id=mysql_fetch_assoc($result);
        if ($product_info_id)
        {
                  $quantity=$product_info_id['product_sales_quantity']+$data['qty'];  
                  $sql="UPDATE tbl_cart_temp SET product_sales_quantity='$quantity' WHERE session_id='$session_id' AND product_id='$product_id' ";
                  mysql_query($sql);
                  header('Location:cart.php');
        }
        else{
        $sql="INSERT INTO tbl_cart_temp(session_id,product_id,product_name,product_price,product_image,product_sales_quantity)"
                ."VALUES('$session_id','$data[product_id]','$product_info[product_name]','$product_info[product_price]','$product_info[product_image]','$product_sales_quantity')";
       
                if(mysql_query($sql))
                {
                 header('Location:cart.php');   
                }  else {
                      die('Query Problem'.  mysql_error() );
                }
        }

    }
    public function select_cart_by_session_id($session_id)
    {
        $sql="SELECT * FROM tbl_cart_temp WHERE session_id='$session_id'";
        $query_result=mysql_query($sql);
        return $query_result;
    }
    public function update_product_by_id($data)
    {
          $sql="UPDATE tbl_cart_temp SET product_sales_quantity='$data[qty]' WHERE product_id='$data[product_id]' ";
                  if(mysql_query($sql))
                {
                 header('Location:cart.php');   
                }  else {
                      die('Query Problem'.  mysql_error() );
                }
    }
    public function remove_product_by_id($product_id)
    {
        $sql="DELETE FROM tbl_cart_temp WHERE product_id='$product_id'";
         if(mysql_query($sql))
                {
                 header('Location:cart.php');   
                }  else {
                      die('Query Problem'.  mysql_error() );
                }
        
    }
    
    
    public function save_customer_info($data)
    {
        $sql="SELECT * FROM tbl_customer WHERE email_address='$data[email_address]'";
        $query_result=mysql_query($sql);
        $customer_info=mysql_fetch_assoc($query_result);
        if($customer_info)
        {
            $message='Your Email Address Alredy Exist';
            return $message;
            header('Location:cart.php');
        }
        else {
        
            $password=md5($data['password']);
       $sql="INSERT INTO  tbl_customer(customer_name,email_address,password,cell_number,address,city,country,zip_code) VALUES('$data[customer_name]','$data[email_address]','$password','$data[cell_number]','$data[address]','$data[city]','$data[country]','$data[zip_code]') ";
           
       if(mysql_query($sql))
       {
        $customer_id=  mysql_insert_id();
        $_SESSION['customer_id']=$customer_id;
        $_SESSION['customer_name']=$data['customer_name'];
//        echo $_SESSION['customer_id'];
//        echo $_SESSION['customer_name'];
       header('Location:shipping.php');    
       }
 else {
           die('Sql Error:'.mysql_error());    
       }
        }

    }
    
    public function check_customer_info($data)
    {
         $password=md5($data['password']);
        $sql="SELECT * FROM tbl_customer WHERE email_address='$data[email_address]' AND password='$password' ";
        $result=mysql_query($sql);
        $customer_check=mysql_fetch_assoc($result);
        if($customer_check)
        {
         $customer_id=  mysql_insert_id();
        $_SESSION['customer_id']=$customer_check['customer_id'];
        $_SESSION['customer_name']=$customer_check['customer_name'];
//        echo $_SESSION['customer_id'];
//        echo $_SESSION['customer_name'];
         header('Location:index.php');
        }
    else {
             $message='Your Email Address/Password Invalid';
            return $message;
            header('Location:cart.php');
 }
        
    }
    
   public function customer_logout()
    {
        $session_id=  session_id();
        $sql="DELETE FROM tbl_cart_temp WHERE session_id='$session_id'";
        if(mysql_query($sql))
        {
            header('Location:index.php');
        }  else {
            die('Sql Error:'.mysql_error());
        }
        session_destroy();
        session_start();
        header('Location:index.php');
    }
    
    public function save_shipping_info($data)
    {
        $sql="INSERT INTO  tbl_shipping(name,email_address,cell_number,address,city,country,zip_code) VALUES('$data[name]','$data[email_address]','$data[cell_number]','$data[address]','$data[city]','$data[country]','$data[zip_code]') ";
           
       if(mysql_query($sql))
       {
        $shipping_id=  mysql_insert_id();
        $_SESSION['shipping_id']=$shipping_id;
       
       //echo $_SESSION['shipping_id'];

       header('Location:payment.php');    
       }
 else {
           die('Sql Error:'.mysql_error());    
       }
        }

        public function save_order_info($data)
        {
            $payment_type=$data['payment_type'];
            //echo $payment_type;
            if($payment_type=='cash_on_delivery')
            {
                $sql="INSERT INTO tbl_payment(payment_type) VALUES('$payment_type')";
                mysql_query($sql);
                $_SESSION['payment_id']=mysql_insert_id();
                
//                echo $_SESSION['g_total'];
//                exit();
                
                $sql="INSERT INTO tbl_order(customer_id,shipping_id,payment_id,order_total) VALUES('$_SESSION[customer_id]','$_SESSION[shipping_id]','$_SESSION[payment_id]','$_SESSION[g_total]' ) ";
                mysql_query($sql);
                $order_id=mysql_insert_id();
                
                $session_id=  session_id();
                
            $sql="SELECT * FROM tbl_cart_temp WHERE session_id='$session_id'";
            mysql_query($sql);
             $result=  mysql_query($sql);
             while ($row=  mysql_fetch_assoc($result))
             {
                 $sql="INSERT INTO tbl_order_details(order_id,product_id,product_name,product_price,product_sales_quantity) VALUES('$order_id','$row[product_id]','$row[product_name]','$row[product_price]','$row[product_sales_quantity]') ";
                 mysql_query($sql);
             }
              $sql="update tbl_product as p,  tbl_order_details as od
              set p.product_quantity = p.product_quantity - od.product_sales_quantity
              where p.product_id=od.product_id and od.order_id='$order_id' ";
             mysql_query($sql);
             
             $sql="DELETE FROM tbl_cart_temp WHERE session_id='$session_id'";
              mysql_query($sql);
              
            unset($_SESSION['shipping_id']);
              session_start();
             
              header('Location:complete.php');
             
            }
                  if($payment_type=='paypal')
            {
                $sql="INSERT INTO tbl_payment(payment_type) VALUES('$payment_type')";
                mysql_query($sql);
                $_SESSION['payment_id']=mysql_insert_id();
                
                $sql="INSERT INTO tbl_order(customer_id,shipping_id,payment_id,order_total) VALUES('$_SESSION[customer_id]','$_SESSION[shipping_id]','$_SESSION[payment_id]','$_SESSION[g_total]')";
                mysql_query($sql);
                $order_id=mysql_insert_id();
                
                $session_id=  session_id();
                
            $sql="SELECT * FROM tbl_cart_temp WHERE session_id='$session_id'";
            mysql_query($sql);
             $result=  mysql_query($sql);
             while ($row=  mysql_fetch_assoc($result))
             {
                 $sql="INSERT INTO tbl_order_details(order_id,product_id,product_name,product_price,product_sales_quantity) VALUES('$order_id','$row[product_id]','$row[product_name]','$row[product_price]','$row[product_sales_quantity]') ";
                 mysql_query($sql);
             }

              header('Location:paypal.php');
             
            }
            
        
        }
    }
    
    

