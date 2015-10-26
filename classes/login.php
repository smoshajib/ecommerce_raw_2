<?php
require_once '../classes/database.php';
 
class Login {
    //put your code here
    public function __construct() {
       $obj_db=new Database();
       session_start();
    }
   
    public function admin_login_check($data)
    {
        $password=md5($data['admin_password']);
        $sql="SELECT * FROM tbl_admin WHERE admin_email_address='$data[admin_email_address]' AND admin_password='$password' ";
        $query_result=mysql_query($sql);
        $result=  mysql_fetch_assoc($query_result);
//        echo '<pre>';
//        print_r($result);
        if($result)
        {
            $_SESSION['admin_id']=$result['admin_id'];
            $_SESSION['admin_full_name']=$result['admin_full_name'];
            //$this->get_session('true');
            header('Location:dashbord.php');
        }
        else{
            header('Location:index.php');
            $message='Your Email Or Password Invalide !';
            return $message;
        }
    }
//    public function get_session($gstatus=NULL)
//    {
//       // $_SESSION['login_status']=true;
//        if($_SESSION['login_status']==$gstatus)
//        {
//        return true;
//        }
//        else{
//            return false;
//        }
//    }

 }
