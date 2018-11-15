<?php

session_start();
include('header.php');
include('sidebar.php');
include('db.php');



if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	
	
	$productdescription=$_POST['productDescription'];
	
	$productavailability=$_POST['productAvailability'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
//for getting product id
$query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
	 $productid=$result['pid']+1;
	$dir="productimages/$productid";
	mkdir($dir);// directory creation for product images
	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);
$sql=mysqli_query($con,"insert into products(category,subCategory,productName,productCompany,productDescription,productAvailability,productImage1,productImage2,productImage3) values('$category','$subcat','$productname','$productcompany','$productdescription','$productavailability','$productimage1','$productimage2','$productimage3')");
$_SESSION['msg']="Product Inserted Successfully !!";

}



?>

 <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}

</script>	



<!--PAGE CONTENT -->
        <div id="content">
           
                <div class="inner" style="padding-left: 10%">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Insert Product</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Product
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

                                	
                                    <form role="form" method="post" enctype="multipart/form-data">
                                    	<div class="form-group">
                                            <label>Category</label>
                                            <select name="category" class="form-control" onChange="getSubcat(this.value);"  required>
                                                <option value="">Select Category</option>
                                                <?php $query=mysqli_query($con,"select * from category");
													while($row=mysqli_fetch_array($query))
													{?>

													<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
													<?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub-Category</label>
                                        <select class="form-control" name="subcategory"  id="subcategory">
                                            
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="productName"  placeholder="Enter Product Name">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Product Company</label>
                                            <input class="form-control" name="productCompany"  placeholder="Enter Product Comapny Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea name="productDescription"  placeholder="Enter Product Description" class="form-control" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Availability</label>
                                            <select name="productAvailability"  id="productAvailability" class="form-control">
                                                <option value="">Select</option>
												<option value="In Stock">In Stock</option>
												<option value="Out of Stock">Out of Stock</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
				                        <label class="control-label col-lg-6">Image Upload</label>
				                        <div class="col-lg-6">
				                            <div class="fileupload fileupload-new" data-provides="fileupload">
				                                <div class="fileupload-preview thumbnail"></div>
				                                <div>
				                                    <span class="btn btn-file"><span class="fileupload-new"></span><span class="fileupload-exists"></span><input type="file" name="productimage1" id="productimage1" /></span>
				                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload" style="float: right;">Remove</a>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                    	<div class="form-group">
                                            <label>Image 2</label>
                                            <input type="file" name="productimage2">
                                        </div>
                                        <div class="form-group">
                                            <label>Image 3</label>
                                            <input type="file" name="productimage3">
                                        </div>
                                        
                                        
                                        <button type="submit" name="submit" class="btn btn-default">Insert</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    
                    </div>
                    
                    
                    

                </div>
            <!--END PAGE CONTENT -->




<script src="assets/plugins/jasny/js/bootstrap-fileupload.js"></script>

<?php include('footer.php'); ?>