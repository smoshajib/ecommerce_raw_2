<?php
class Database {
    //put your code here
    public function __construct() {
        $hostname='localhost';
        $username='root';
        $password='';
        $database_name='ecommerce_row_2';
        $con=  mysql_connect($hostname,$username,$password);
        if($con)
        {
           // echo 'successfully';
            mysql_select_db($database_name);
        }
     else {
     die('Connection Is not Successfully');
 }
    }
}
