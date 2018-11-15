<?php

session_start();
include('header.php');
include('sidebar.php');
include('db.php');

if(isset($_GET['del']))
		  {	
		  		$id = $_GET['id'];
		          mysqli_query($con,"delete from products where id = '$id'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }

?>


<div id="content">
           
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All Products</h1>
                </div>
          

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Product Record
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
											<th>Product Name</th>
											<th>Category </th>
											<th>Subcategory</th>
											<th>Company Name</th>
											<th>Creation Date</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php $query=mysqli_query($con,"select products.*,category.categoryName,subcategory.subcategory from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory");
											$cnt=1;
											while($row=mysqli_fetch_array($query))
											{
											?>	
                                        <tr>
                                            <td><?php echo $cnt;?></td>
											<td><?php echo $row['productName'];?></td>
											<td><?php echo $row['categoryName'];?></td>
											<td> <?php echo $row['subcategory'];?></td>
											<td><?php echo $row['productCompany'];?></td>
											<td><?php echo $row['postingDate'];?></td>
											<td> 
												<a href="edit_product.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>
											<a href="manage_product.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a> </td>
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





<?php include('footer.php'); ?>