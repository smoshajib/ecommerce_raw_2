<?php

require_once './dompdf_helper.php';

        $order_id=$_GET['id'];
        $view_file= include './pages/invoice.php';
        $file_name=pdf_create($view_file, 'inv-00'.$order_id);
        echo $file_name;
