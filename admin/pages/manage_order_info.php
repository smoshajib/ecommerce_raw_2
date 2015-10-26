
<?php

    $query_result=$obj_admin->select_all_order();
   

   
    if(isset($_GET['status']))
    {
        $status=$_GET['status'];
        $order_id=$_GET['id'];
        
        if($status=='delete')
        {
          $obj_admin->delete_order($order_id);  
        }        
        
          elseif($status=='active')
        {
          $obj_admin->active_order($order_id);  
        }   
            elseif($status=='inactive')
        {
          $obj_admin->inactive_order($order_id);  
        }    
        
    }
        
  
    
?>


<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a> 
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Tables</a></li>
</ul>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Order Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                
                
                <tbody>
                <?php
                    while($row=  mysql_fetch_assoc($query_result))
                    {
                ?>
                    <tr>
                        <td><?php echo $row['order_id']?></td>
                        <td class="center"><?php echo $row['customer_name']?></td>
                         <td class="center"><?php echo $row['order_total']?></td>
                        <td class="center">
                       <?php
                         if ($row['order_status']=='complete')
                         {
                       ?>
                            <span class="label label-success">Complete</span>
                         <?php } else { ?>  
                            <span class="label label-important">Pending</span>
                         <?php } ?>
                        </td>
                        <td class="center">
                            <?php
                                if($row['order_status']=='pending')
                                {
                            ?>
                            <a class="btn btn-success" href="?status=active&id=<?php echo $row['order_id'];?>">
                                <i class="halflings-icon white thumbs-up"></i>  
                            </a>
                                <?php } else{?>
                                <a class="btn btn-danger" href="?status=inactive&id=<?php echo $row['order_id'];?>">
                                <i class="halflings-icon white thumbs-down"></i>  
                            </a>
                            
                                <?php } ?>
                             <a class="btn btn-primary" href="view.php?id=<?php echo $row['order_id']?>" title="View">
                                <i class="halflings-icon zoom-in white " ></i>  
                            </a>
                            <a class="btn btn-info" href="edit_category.php?id=<?php echo $row['order_id']?>" title="Edit">
                                <i class="halflings-icon white edit" ></i>  
                            </a>
                             <a class="btn btn-info" href="test.php?id=<?php echo $row['order_id']?>" title="Download">
                                <i class="halflings-icon white download-alt"></i> 
                            </a>
                            <a class="btn btn-danger" href="?status=delete&id=<?php echo $row['order_id']?>" onclick="return check_delete();" title="Delete">
                                <i class="halflings-icon white trash"></i> 
                            </a>
                           
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->