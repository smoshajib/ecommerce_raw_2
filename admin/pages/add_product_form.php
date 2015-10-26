<?php
//require_once '../classes/product.php';
//$obj_product=new Product();
$category_result=$obj_product->select_publiched_category();
$manufacturer_result=$obj_product->select_publiched_manufacturer();


    if(isset($_POST['btn']))
    {
        $message=$obj_admin->save_product_info($_POST,$_FILES);
        
    }
    

?>
<h2>
    <?php
        if(isset($message))
        {
            echo $message;
            unset($message);
        }
    
    ?>
</h2>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form  class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Name </label>
                        <div class="controls">
                            <input type="text" name="product_name" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Category Name</label>
                        <div class="controls">
                            <select name="category_id">
                                <option>Select Status.....</option>
                                <?php
                                    while ($row=  mysql_fetch_assoc($category_result))
                                    {
                                ?>
                                <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Manufacturer Name</label>
                        <div class="controls">
                            <select name="manufacturer_id">
                                <option>Select Status.....</option>
                                <?php
                                    while ($row=  mysql_fetch_assoc($manufacturer_result))
                                    {
                                ?>
                                <option value="<?php echo $row['manufacturer_id']?>"><?php echo $row['manufacturer_name']?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Price </label>
                        <div class="controls">
                            <input type="text" name="product_price" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Quantity </label>
                        <div class="controls">
                            <input type="text" name="product_quantity" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product SKU </label>
                        <div class="controls">
                            <input type="text" name="product_sku" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
                        </div>
                    </div>   
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Product Short Description</label>
                        <div class="controls">
                            <textarea name="product_short_description" class="cleditor" id="textarea2" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Product Long Description</label>
                        <div class="controls">
                            <textarea name="product_long_description" class="cleditor" id="textarea2" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Image </label>
                        <div class="controls">
                            <input type="file" name="product_image" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Publication Status</label>
                        <div class="controls">
                            <select name="publication_status">
                                <option>Select Status.....</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                    </div>
                        
                    <div class="form-actions">
                        <button type="submit" name="btn" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->

