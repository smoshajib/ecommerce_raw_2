<script type="text/javascript">
<!--
//Create a boolean variable to check for a valid Internet Explorer instance.
var xmlhttp = false;
//Check if we are using IE.
try {
//If the Javascript version is greater than 5.
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
//alert(xmlhttp);
//alert ("You are using Microsoft Internet Explorer.");
} catch (e) {
   // alert(e);
    
//If not, then use the older active x object.
try {
//If we are using Internet Explorer.
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//alert ("You are using Microsoft Internet Explorer");
} catch (E) {
//Else we must be using a non-IE browser.
xmlhttp = false;
}
}
//If we are using a non-IE browser, create a javascript instance of the object.
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
xmlhttp = new XMLHttpRequest();
//alert ("You are not using Microsoft Internet Explorer");
}

function makerequest(given_text,objID)
 {
	//alert(given_text);
        //var obj = document.getElementById(objID);
        serverPage='check_category.php?text='+given_text;
	xmlhttp.open("GET", serverPage);
	xmlhttp.onreadystatechange = function()
	 {
	//alert(xmlhttp.readyState);
	//alert(xmlhttp.status);
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		 {
			//alert(xmlhttp.responseText);
                                        document.getElementById(objID).innerHTML = xmlhttp.responseText;
			//document.getElementById(objcw).innerHTML = xmlhttp.responseText;
                                        if(xmlhttp.responseText=='Alredy Exists')
                                        {
                                            document.getElementById('btn').disabled=true;
                                        }
                                        else{
                                             document.getElementById('btn').disabled=false;
                                        }
		 }
	}
xmlhttp.send(null);
}
</script>

<?php
    if(isset($_POST['btn']))
    {
        $message=$obj_admin->save_category_info($_POST);
        
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
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Category</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" action="" method="post" onsubmit="return validateStandard(this)">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Category Name (<span style="color:red">*</span>) </label>
                        <div class="controls">
                            <input type="text" name="category_name" class="span6 typeahead" required regexp="JSVAL_RX_ALPHA" err="Please Enter Valide Category Name"  data-provide="typeahead" data-items="4" onblur="return makerequest(this.value,'res')" >
                            <span id="res"></span>
                        </div>
                    </div>
<!--                    <div class="control-group">
                        <label class="control-label" for="typeahead">Confirm Category Name (<span style="color:red">*</span>) </label>
                        <div class="controls">
                            <input type="text"  class="span6 typeahead" required equals="category_name" err="Category Name and Confirm Category Name mustbe same"  data-provide="typeahead" data-items="4">
                            
                        </div>
                    </div>-->
                       
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Category Description</label>
                        <div class="controls">
                            <textarea name="category_description" class="cleditor" id="textarea2" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Publication Status (<span style="color:red">*</span>) </label>
                        <div class="controls">
                            <select name="publication_status" required exclude=" ">
                                <option value=" ">Select Status.....</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="btn" id="btn" class="btn btn-primary">Save changes</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->