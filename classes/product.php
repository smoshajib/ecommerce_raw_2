<?php

require_once 'database.php';
class Product {
    //put your code here
    public function __construct() {
        $obj_db=new Database();
    }
    public function select_publiched_category()
    {
        $sql="SELECT * FROM tbl_category WHERE publication_status='1'";
        $query_result=  mysql_query($sql);
        return $query_result;
    }
    
    public function select_publiched_manufacturer()
    {
        $sql="SELECT * FROM tbl_manufacturer WHERE publication_status='1'";
        $query_result=  mysql_query($sql);
        return $query_result;
    }
       public function select_publiched_product()
    {
        $sql="SELECT * FROM tbl_product WHERE publication_status='1'";
        $query_result=  mysql_query($sql);
        return $query_result;
    }
    public function select_publiched_product_by_category_id($category_id)
    {
        $sql="SELECT * FROM tbl_product WHERE publication_status='1' AND category_id='$category_id'";
        $query_result=mysql_query($sql);
        return $query_result;
    }
    public function select_publiched_product_by_manufacturer_id($manufacturer_id)
    {
        $sql="SELECT * FROM tbl_product WHERE publication_status='1' AND manufacturer_id='$manufacturer_id'";
        $query_result=mysql_query($sql);
        return $query_result;
    }
    public function select_product_by_id($product_id)
    {
        $sql="SELECT * FROM tbl_product WHERE product_id='$product_id'";
        $query_result=  mysql_query($sql);
        return $query_result;
    }
    public function select_publiched_manufacturer_id($manufacturer_id)
    {
       $sql="SELECT * FROM tbl_manufacturer WHERE publication_status='1' AND manufacturer_id='$manufacturer_id'";
        $manufacturer_result=mysql_query($sql);
        return $manufacturer_result; 
    }
}
