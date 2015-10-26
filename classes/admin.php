<?php
require_once '../classes/database.php';

class Admin {
    //put your code here
    public function __construct() {
        $obj_db=new Database();
    }
 //--------------------------------------------------start category------------------------------------------------   
    public function save_category_info($data)
    {
      $sql="INSERT INTO  tbl_category(category_name,category_description,publication_status) VALUES('$data[category_name]','$data[category_description]','$data[publication_status]' ) ";
    
    if(!mysql_query($sql))
    {
        die('Sql Error:' .mysql_error());
    }
 else {
    $message="Save Category Information Successfully";
    return $message;
    header('Location:add_category.php');
    }
      
    }
    
    public function select_all_category()
    {
        $sql="SELECT * FROM tbl_category ";
        $query_result=  mysql_query($sql);
        return $query_result;
    }

    public function delete_category($category_id)
    {
        $sql="DELETE FROM tbl_category WHERE category_id='$category_id'";
        mysql_query($sql);
        
        header('Location:manage_category.php'); 
    }

    public function active_category($category_id)
    {
        $sql="UPDATE tbl_category SET publication_status='1' WHERE category_id='$category_id'";
        mysql_query($sql);
        header('Location:manage_category.php');
    }
     public function inactive_category($category_id)
    {
        $sql="UPDATE tbl_category SET publication_status='0' WHERE category_id='$category_id'";
        mysql_query($sql);
        header('Location:manage_category.php');
    }
    
    public function select_category_info_by_id($category_id)
    {
        $sql="SELECT * FROM tbl_category Where category_id='$category_id'";
        $query_result=  mysql_query($sql);
        return $query_result;
    }
    public function update_category_info($data)
    {
        $sql="UPDATE tbl_category SET category_name='$data[category_name]',category_description='$data[category_description]',publication_status='$data[publication_status]' WHERE category_id='$data[category_id]'";
        mysql_query($sql);
        header('Location:manage_category.php');
    }
//--------------------------------------------------end category------------------------------------------------
//--------------------------------------------------start manufacturer------------------------------------------------
    public function save_manufacturer($data)
    {
        $sql="INSERT INTO tbl_manufacturer(manufacturer_name,manufacturer_description,publication_status) VALUES('$data[manufacturer_name]','$data[manufacturer_description]','$data[publication_status]')";
        if(!mysql_query($sql))
    {
        die('Sql Error:' .mysql_error());
    }
 else {
    $message="Save Manufacturer Information Successfully";
    return $message;
    header('Location:add_manufacture.php');
    }
        
    }
    
    public function select_manufacturer_info()
    {
        $sql="SELECT * FROM tbl_manufacturer";
        $result=mysql_query($sql);
        return $result;
    }

    public function delete_manufacturer($manufacturer_id)
    {
        $sql="DELETE FROM tbl_manufacturer WHERE manufacturer_id='$manufacturer_id'";
        mysql_query($sql);
        header('Location:manage_manufacture.php');
    }
    public function inactive_manufacturer($manufacturer_id)
    {
        $sql="UPDATE tbl_manufacturer SET publication_status='0' WHERE manufacturer_id='$manufacturer_id' ";
        mysql_query($sql);
        header('Location:manage_manufacture.php');
        
    }
      public function active_manufacturer($manufacturer_id)
    {
        $sql="UPDATE tbl_manufacturer SET publication_status='1' WHERE manufacturer_id='$manufacturer_id' ";
        mysql_query($sql);
        header('Location:manage_manufacture.php');
        
    }

    public function select_manufacturer_info_by_id($manufacturer_id)
    {
        $sql="SELECT *FROM tbl_manufacturer WHERE manufacturer_id='$manufacturer_id'";
        $result=mysql_query($sql);
        return $result;
    }

    public function update_manufacturer($data)
    {
        $sql="UPDATE tbl_manufacturer SET manufacturer_name='$data[manufacturer_name]',manufacturer_description='$data[manufacturer_description]',publication_status='$data[publication_status]' WHERE manufacturer_id='$data[manufacturer_id]' ";
        mysql_query($sql);
        header('Location:manage_manufacture.php');
    }

//--------------------------------------------------end manufacturer------------------------------------------------

//--------------------------------------------------start product------------------------------------------------

     public function save_product_info($data, $files) {
        //--------------------step1-----------------------
        if ($files['product_image']['name']) {
            //--------------------step2-----------------------
            $target_dir = "product_images/";
            $target_file = $target_dir . basename($files["product_image"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            //--------------------step3-----------------------
            $check = getimagesize($files["product_image"]["tmp_name"]);
//    echo '<pre>';
//    print_r($check);

            if ($check !== false) {
                //--------------------step4-----------------------
                if ($files["product_image"]["size"] < 500000) {
                    //--------------------step5-----------------------
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        return $message;
                    } else {
                        //--------------------step6-----------------------
                        if (move_uploaded_file($files["product_image"]["tmp_name"], $target_file)) {
                            //--------------------step7-----------------------
                            $product_image = $target_file;

                            $sql = "INSERT INTO tbl_product (category_id,manufacturer_id,product_name,product_price,product_quantity,product_sku,product_short_description,product_long_description,product_image,publication_status) VALUES('$data[category_id]','$data[manufacturer_id]',"
                                    . "'$data[product_name]','$data[product_price]','$data[product_quantity]','$data[product_sku]',"
                                    . "'$data[product_short_description]','$data[product_long_description]','$product_image',$data[publication_status])";

                            if (!mysql_query($sql)) {
                                $message = 'Sql Error' . mysql_error();
                                return $message;
                            } else {
                                $message = 'Product Information Save Successfully !';
                                return $message;
                            }
                        } else {
                            $message = "Sorry, there was an error uploading your file.";
                            return $message;
                        }
                    }
                } else {
                    $message = "Sorry, your file is too large.";
                    return $message;
                }
            } else {
                $message = "File is not an image.";
                return $message;
            }
        } else {
            $message = "Image File Not Selected";
            return $message;
        }
    }

    public function save_product_info1($data, $files) {
        if ($files['product_image']['name']) {
            $target_dir = "product_images/";
            $target_file = $target_dir . basename($files["product_image"]["name"]);
            //echo $target_file;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            //echo $imageFileType;

            $check = getimagesize($files["product_image"]["tmp_name"]);
//            echo '<pre>';
//            print_r($check);

            if ($check !== false) {

                if ($files["product_image"]["size"] < 500000) {

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        return $message;
                    } else {
                        if (move_uploaded_file($files["product_image"]["tmp_name"], $target_file)) {
                            $product_image = $target_file;
                            
                            $sql = "INSERT INTO tbl_product (category_id,manufacturer_id,product_name,product_price,product_quantity,product_sku,product_short_description,product_long_description,product_image,publication_status) VALUES('$data[category_id]','$data[manufacturer_id]',"
                                    . "'$data[product_name]','$data[product_price]','$data[product_quantity]','$data[product_sku]',"
                                    . "'$data[product_short_description]','$data[product_long_description]','$product_image',$data[publication_status])";

                            if (!mysql_query($sql)) {
                                $message = 'Sql Error' . mysql_error();
                                return $message;
                            } else {
                                $message = 'Product Information Save Successfully !';
                                return $message;
                            }
                        } else {
                            $message = "Sorry, there was an error uploading your file.";
                            return $message;
                        }
                    }
                } else {
                    $message = "Sorry, your file is too large.";
                    return $message;
                }
            } else {
                $message = "File is not an image";
                return $message;
            }
        } else {
            $message = 'Image file is not selected';
            return $message;
        }
    }

    public function save_product_info2($data,$files)
    {
        
    if($files['product_image']['name'])
    {
       $target_dir = "product_images/";
       $target_file = $target_dir . basename($files["product_image"]["name"]);
            //echo $target_file;
        $uploadOk = 1; 
         if (move_uploaded_file($files["product_image"]["tmp_name"], $target_file)) {
        $message = 'Product Information Save Successfully !';
        return $message;
    } else {
        $message= "Sorry, there was an error uploading your file.";
        return $message;
    }
    }
 else {
    $message="Image Files is not selected";
    return $message;
    }
    
    }

        public function select_all_product()
    {
        $sql="SELECT * FROM tbl_product";
        $result=mysql_query($sql);
        return $result;
    }

    public function delete_product($product_id)
    {
        $sql="DELETE FROM tbl_product WHERE product_id='$product_id'";
        mysql_query($sql);
        header('Location:manage_product.php');
    }
    public function inactive_product($product_id)
    {
        $sql="UPDATE tbl_product SET publication_status='0' WHERE product_id='$product_id' ";
        mysql_query($sql);
        header('Location:manage_product.php');
        
    }
      public function active_product($product_id)
    {
        $sql="UPDATE tbl_product SET publication_status='1' WHERE product_id='$product_id' ";
        mysql_query($sql);
        header('Location:manage_product.php');
        
    }

    public function select_product_info_by_id($product_id)
    {
        $sql="SELECT *FROM tbl_product WHERE product_id='$product_id'";
        $result=mysql_query($sql);
        return $result;
    }

    public function update_product($data,$files)
    {
        if($files['product_image']['name'])
        {
          if($files['product_image']['name'])
    {
       $target_dir = "product_images/";
       $target_file = $target_dir . basename($files["product_image"]["name"]);
            //echo $target_file;
        $uploadOk = 1; 
         if (move_uploaded_file($files["product_image"]["tmp_name"], $target_file)) {
        $sql="UPDATE tbl_product SET product_name='$data[product_name]',category_id='$data[category_id]',manufacturer_id='$data[manufacturer_id]',product_price='$data[product_price]',product_quantity='$data[product_quantity]',product_sku='$data[product_sku]',product_short_description='$data[product_short_description]',product_long_description='$data[product_long_description]',product_image='$target_file',publication_status='$data[publication_status]' WHERE product_id='$data[product_id]' ";
        mysql_query($sql);
        header('Location:manage_product.php');

//        $message = 'Product Information Save Successfully !';
//        return $message;
    } else {
        $message= "Sorry, there was an error uploading your file.";
        return $message;
    }
    }
 else {
    $message="Image Files is not selected";
    return $message;
    }
    }
 else {
        $sql="UPDATE tbl_product SET product_name='$data[product_name]',category_id='$data[category_id]',manufacturer_id='$data[manufacturer_id]',product_price='$data[product_price]',product_quantity='$data[product_quantity]',product_sku='$data[product_sku]',product_short_description='$data[product_short_description]',product_long_description='$data[product_long_description]',publication_status='$data[publication_status]' WHERE product_id='$data[product_id]' ";
        mysql_query($sql);
        header('Location:manage_product.php');
    }
        
    }

//--------------------------------------------------end product------------------------------------------------

//--------------------------------------------------start  order------------------------------------------------

    public function select_all_order()
    {
        $sql="SELECT c.*,o.* FROM tbl_customer as c ,tbl_order as o WHERE c.customer_id=o.customer_id";
        $query_result=mysql_query($sql);
        return $query_result;
        
    }
      public function delete_order($order_id)
    {
        $sql="DELETE FROM tbl_order WHERE order_id='$order_id'";
        mysql_query($sql);
        header('Location:manage_order.php');
    }
    public function inactive_order($order_id)
    {
        $sql="UPDATE tbl_order SET order_status='pending' WHERE order_id='$order_id' ";
        mysql_query($sql);
        header('Location:manage_order.php');
        
    }
      public function active_order($order_id)
    {
        $sql="UPDATE tbl_order SET order_status='complete' WHERE order_id='$order_id' ";
        mysql_query($sql);
        header('Location:manage_order.php');
        
    }
    
    public function select_order_by_id($order_id)
    {
        $sql="SELECT *FROM tbl_order WHERE order_id='$order_id'";
        $result=mysql_query($sql);
        $order_info=mysql_fetch_assoc($result);
        return $order_info;
    }
    
    public function select_customer_by_id($customer_id)
    {
       $sql="SELECT *FROM tbl_customer WHERE customer_id='$customer_id'";
        $result=mysql_query($sql);
        $customer_info=mysql_fetch_assoc($result);
        return $customer_info; 
    }

     public function select_shipping_by_id($shipping_id)
    {
       $sql="SELECT *FROM tbl_shipping WHERE shipping_id='$shipping_id'";
        $result=mysql_query($sql);
        $shipping_info=mysql_fetch_assoc($result);
        return $shipping_info; 
    }

    public function select_order_details_by_id($order_id)
    {
        $sql="SELECT *FROM tbl_order_details WHERE order_id='$order_id'";
        $result=mysql_query($sql);
        
        return $result;
    }

//--------------------------------------------------end order------------------------------------------------
   
    
    
    public function logout()
    {
        session_destroy();
        session_start();
        $_SESSION['message']='You Are Successfully Logout !';
        header('Location:index.php');
    }
}

