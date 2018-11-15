<?php

session_start();
include('header.php');
include('sidebar.php');
include('db.php');



if(isset($_POST['submit']))
{
    $currentTime = date( 'd-m-Y h:i:s A', time () );
    $category=$_POST['category'];
    $subcat=$_POST['subcategory'];
    $id = $_GET['id'];
$sql=mysqli_query($con,"update subcategory set categoryid='$category',subcategory='$subcat',updationDate='$currentTime' where id='$id'");
$_SESSION['msg']="Sub-Category Updated !!";

}
 ?>




<!--PAGE CONTENT -->
        <div id="content">
           
                <div class="inner">
                    <div class="row" style="padding-left: 15%">
                <div class="col-lg-10">
                    <h1 class="page-header">Edit Sub Category</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10" style="padding-left: 15%">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Sub-Category
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-7">
                                	<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo $_SESSION['delmsg'];?><?php echo $_SESSION['delmsg']="";?>
									</div>
<?php } ?>

                                    <form role="form" method="post" action="">
                                        
                                        <div class="form-group">
                                            <label> Category</label>
<?php
$id = $_GET['id'];
$query=mysqli_query($con,"select category.id,category.categoryName,subcategory.subcategory from subcategory join category on category.id=subcategory.categoryid where subcategory.id='$id'");
$row=mysqli_fetch_array($query);

?>  


                                            <select name="category" class="form-control">
                                               <option value="<?php echo $row['id'];?>"><?php echo $catname=$row['categoryName'];?></option>

                                               <?php $ret=mysqli_query($con,"select * from category");
                                                    while($result=mysqli_fetch_array($ret))
                                                    {
                                                    echo $cat=$result['categoryName'];
                                                    if($catname==$cat)
                                                    {
                                                        continue;
                                                    }
                                                    else{
                                                    ?>
                                                    <option value="<?php echo $result['id'];?>"><?php echo $result['categoryName'];?></option>
                                                    <?php } } ?>
                                            </select>
                                        </div>
                                       


                                        <div class="form-group">
                                            <label>Sub-Category Name</label>
                                            <input type="text" placeholder="Enter SubCategory Name" name="subcategory" value="<?php echo  $row['subcategory'];?>" class="form-control">
                                        </div>
                                       
                                        <button type="submit" name="submit" class="btn btn-default">Update</button>
                                        <a href="subcategory.php"  class="btn btn-default">Go to Subcategary</a>
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






 <?php include('footer.php'); ?>