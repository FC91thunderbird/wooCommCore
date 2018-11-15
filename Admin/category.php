<?php

session_start();
include('header.php');
include('sidebar.php');
include('db.php');


if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$description=$_POST['description'];
	$sql=mysqli_query($con,"insert into category(categoryName,categoryDescription) values('$category','$description')");
$_SESSION['msg']="Category Created !!";


}

//Delete Record
if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from category where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Category deleted !!";
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


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo $_SESSION['delmsg'];?><?php echo $_SESSION['delmsg']="";?>
									</div>
<?php } ?>

                                    <form role="form" method="post" action="">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" name="category" placeholder="Category Name" class="form-control">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label> Description </label>
                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>
                                       
                                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    

             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>category Description</th>
                                            <th>Created Date</th>
                                            <th>Last Update</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
                                    		$query=mysqli_query($con,"select * from category");
											$cnt=1;
												while($row=mysqli_fetch_array($query))
												{
                                    	?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
											<td><?php echo $row['categoryName'];?></td>
											<td><?php echo $row['categoryDescription'];?></td>
											<td> <?php echo $row['creationDate'];?></td>
											<td><?php echo $row['updationDate'];?></td>
											<td> 
												<a href="edit_category.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>
											<a href="category.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a> </td>
                                        </tr>
                                       
                                       <?php $cnt=$cnt+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>



                    </div>
                    
                    



                </div>

            <!--END PAGE CONTENT -->






 <?php include('footer.php'); ?>