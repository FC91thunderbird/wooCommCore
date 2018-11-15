<?php 
include('header.php');

if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Your Cart hasbeen Updated');</script>";
		}
	}

// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{


		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
	
}


?>






<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">cart</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<form id="checkout-form" class="clearfix">
					
					

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
							</div>


							<table class="shopping-cart-table table">

								<thead>
									<tr>
										<th>Image</th>
										<th> Product Name</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Price</th>
										
										<th class="text-center">Total</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

				array_push($pdtid,$row['id']);

	?>
 
								<tbody>
									<tr>
										<td class="thumb">
											<img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="">
										</td>
										<td class="details">
											<a href="#"><?php echo $row['productName']; ?></a>
											<ul>
												<li><span>Size: XL</span></li>
												<li><span>Color: Camelot</span></li>
											</ul>
										</td>
										<td class="qty text-center"><input class="input" type="number" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]"></td>
										<td class="price text-center"><strong><?php echo "Rs"." ".$row['productPrice']; ?>.00 </strong><br><del class="font-weak"><small></small></del></td>
										
										<td class="total text-center"><strong class="primary-color"><?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</strong></td>
										<td class="text-right"><button name="remove_code[]" value="<?php echo $row['id'];?>" class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>

									</tr>
									
								</tbody>
<?php }?>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total"><?php echo "Rs"." ".$totalprice; ?>.00 </th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SHIPING</th>
										<td colspan="2">Free Shipping</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total"><?php echo "Rs"." ".$totalprice; ?>.00</th>
									</tr>
								</tfoot>
								<?php  }?>
							</table>
						
							<div class="pull-right">
								<button class="primary-btn">Place Order</button>
							</div>
						</div>

					</div>
				</form>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->




	<?php include('footer.php'); ?>