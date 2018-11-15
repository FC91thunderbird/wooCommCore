<?php

session_start();
include('header.php');
include('sidebar.php');
include('db.php');

$pid = $_GET['id'];

if(isset($_POST['submit']))
{
    $category=$_POST['category'];
    $subcat=$_POST['subcategory'];
    $productname=$_POST['productName'];
    $productcompany=$_POST['productCompany'];
    
    $productdescription=$_POST['productDescription'];
    
    $productavailability=$_POST['productAvailability'];
    
$sql=mysqli_query($con,"update  products set category='$category',subCategory='$subcat',productName='$productname',productCompany='$productcompany',productDescription='$productdescription',productAvailability='$productavailability' where id='$pid' ");
$_SESSION['msg']="Product Updated Successfully !!";

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

<?php 

$query=mysqli_query($con,"select products.*,category.categoryName as catname,category.id as cid,subcategory.subcategory as subcatname,subcategory.id as subcatid from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
$cnt=1;
$row=mysqli_fetch_array($query);


?>
<div class="form-group">
    <label>Category</label>
    <select name="category" class="form-control" onChange="getSubcat(this.value);"  required>
  
<option value="<?php echo $row['cid'];?>"><?php echo $row['catname'];?></option> 

<?php $query=mysqli_query($con,"select * from category");
while($rw=mysqli_fetch_array($query))
{
    if($row['catname']==$rw['categoryName'])
    {
        continue;
    }
    else{
    ?>

<option value="<?php echo $rw['id'];?>"><?php echo $rw['categoryName'];?></option>
<?php }} ?>
 </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub-Category</label>
                                        <select class="form-control" name="subcategory"  id="subcategory">
                                            <option value="<?php echo $row['subcatid'];?>"><?php echo $row['subcatname'];?></option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="productName"  value="<?php echo $row['productName'];?>">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Product Company</label>
                                            <input class="form-control" name="productCompany"  value="<?php echo $row['productCompany'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea name="productDescription" class="form-control" rows="3"><?php echo $row['productDescription'];?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Availability</label>
                                            <select name="productAvailability"  id="productAvailability" class="form-control">
                                                <option value="<?php echo $row['productAvailability'];?>"><?php echo $row['productAvailability'];?></option>
                                                
												<option value="In Stock">In Stock</option>
												<option value="Out of Stock">Out of Stock</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Image 1</label>
                                            <img src="productimages/<?php echo $pid;?>/<?php echo $row['productImage1'];?>" height="100px"> <a href="update-image1.php?id=<?php echo $row['id'];?>">Change Image</a>
                                        </div>
				                    	<div class="form-group">
                                            <label>Image 2</label>
                                            <img src="productimages/<?php echo $pid;?>/<?php echo $row['productImage2'];?>" height="100px"> <a href="update-image2.php?id=<?php echo $row['id'];?>">Change Image</a>
                                        </div>
                                        <div class="form-group">
                                            <label>Image 3</label>
                                            <img src="productimages/<?php echo $pid;?>/<?php echo $row['productImage3'];?>" height="100px"> <a href="update-image3.php?id=<?php echo $row['id'];?>">Change Image</a>
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