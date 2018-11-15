<?php
session_start();
include('header.php');
include('sidebar.php');
include('db.php');


if(isset($_POST['submit']))
{
    $currentTime = date( 'd-m-Y h:i:s A', time () );
    $category=$_POST['category'];
    $description=$_POST['description'];
    $id = $_GET['id'];
$sql=mysqli_query($con,"update category set categoryName='$category',categoryDescription='$description',updationDate='$currentTime' where id='$id'");
$_SESSION['msg']="Category Updated !!";

}


?>


<!--PAGE CONTENT -->
        <div id="content">
           
                <div class="inner">
                    <div class="row" style="padding-left: 15%">
                <div class="col-lg-10">
                    <h1 class="page-header">Add Category</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10" style="padding-left: 15%">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Elements
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



                                    <form role="form" method="post" action="">
                                        <?php
                                            $id = $_GET['id'];
                                            $query=mysqli_query($con,"select * from category where id='$id'");
                                            $row=mysqli_fetch_array($query);
                                            
                                        ?>  
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" name="category" value="<?php echo  $row['categoryName'];?>" class="form-control">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label> Description </label>
                                            <textarea class="form-control" name="description"  rows="3"><?php echo  $row['categoryDescription'];?></textarea>
                                        </div>
                                       
                                        <button type="submit" name="submit" class="btn btn-default">Update</button>
                                         <a href="category.php" class="btn btn-default">Go Category</a>
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