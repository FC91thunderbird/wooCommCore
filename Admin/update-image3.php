<?php

session_start();
include('header.php');
include('sidebar.php');
include('db.php');



$pid = $_GET['id'];// product id
if(isset($_POST['submit']))
{
	$productname=$_POST['productName'];
	$productimage3=$_FILES["productimage3"]["name"];
//$dir="productimages";
//unlink($dir.'/'.$pimage);


	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$pid/".$_FILES["productimage3"]["name"]);
	$sql=mysqli_query($con,"update  products set productImage3='$productimage3' where id='$pid' ");
$_SESSION['msg']="Product Image Updated Successfully !!";

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
                    <h1 class="page-header">Upload Image</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Image
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

$query=mysqli_query($con,"select productName,productImage3 from products where id='$pid'");
$cnt=1;
$row=mysqli_fetch_array($query);


?>                                   	<div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="productName"  value="<?php echo $row['productName'];?>" readonly>
                                            
                                        </div>
				                    	<div class="form-group">
                                            <label>Current Image </label>
                                            <img src="productimages/<?php echo $pid;?>/<?php echo $row['productImage3'];?>" height="100px"> 
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>New Image</label>
                                            <input type="file" name="productimage3">
                                        
                                        </div>
                                        
                                        
                                        
                                        <button type="submit" name="submit" class="btn btn-default">Update</button><br><br>
                                       After Update Image Plz go Back
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