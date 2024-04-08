<?php
	session_start();
	require ('db.php');

	$code=$_GET['on'];
	$myid=$_SESSION['login_me'];
	if(!isset($_SESSION['login_me']) || trim($_SESSION['login_me']=="")){
		header("location: register.php");
		exit();
	}
	

	$qryget=mysqli_query($conn,"SELECT * FROM customer WHERE id='$myid'");
	if(mysqli_num_rows($qryget) > 0){
		$data1 = mysqli_fetch_assoc($qryget);
	}

	if(isset($_GET['remove'])){
		$remove_id = $_GET['remove'];
		mysqli_query($conn, "DELETE FROM `mycart` WHERE id = '$remove_id'");
// 		$_SESSION['flash_message'] = 'Request failed, Your first request is not yet accepted.';
		header('location:check_my_cart.php');
	 };
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Simple Sweet Shoping Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
		<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
		<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">

		<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
		<!-- Google Font -->
		<link
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
		rel="stylesheet"/>
	<!--===============================================================================================-->

	<script>
		function  validate(){
			var province = document.myform.c_province.value;
			if(province == ""){
				alert("Please Select Province");
				document.myform.c_province.focus();
                return false;
			}
		}
	</script>
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="maindex.php" class="logo">
						<img src="images/icons/logo.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="maindex.php">Home</a>
							</li>

							<li>
								<a href="product_main.php">Menu</a>
							</li>

							<li>
								<a href="paluwagan_main.php">Paluwagan</a>
							</li>

							<li>
								<a href="about_main.php">About</a>
							</li>

							<li>
								<a href="contact_main.php">Contact</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

                        <?php
							$getdata = $conn->query("SELECT * FROM mycart WHERE buyer_ID='$myid'");
							$count = mysqli_num_rows($getdata);

							if($count > 0){
						?>
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti count js-show-cart">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
						<?php }else{?>
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
						<?php } ?>
                        
						<?php
							$getnotif = $conn->query("SELECT * FROM notif WHERE seen_status = '0' AND customer_ID='$data1[customer_ID]'");
							$countNotif = mysqli_num_rows($getnotif);

							if($countNotif > 0){
						?>
							<div class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-notif">
								<i class="zmdi zmdi-notifications"></i>
							</div>
						<?php }else{?>
							<div class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
								<i class="zmdi zmdi-notifications"></i>
							</div>
						<?php } ?>

						<div class="sideMenu">
							<?php
								if($data1['image'] == ''){
									echo '<img src="images/default.png" alt="Profile" class="user-pic js-show-profile" id="img">';
								}else{
									echo '<img src="admin/uploads/'.$data1['image'].'" alt="Profile" class="user-pic js-show-profile" id="img">';
								}
							?>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="maindex.php"><img src="images/icons/logo.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
				<?php
					$getdata = $conn->query("SELECT * FROM mycart WHERE buyer_ID='$myid'");
					$count = mysqli_num_rows($getdata);

					if($count > 0){
				?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
				<?php }else{?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
				<?php } ?>

				<?php
					$getnotif = $conn->query("SELECT * FROM notif WHERE seen_status = '0' AND customer_ID='$data1[customer_ID]'");
					$countNotif = mysqli_num_rows($getnotif);

					if($countNotif > 0){
				?>
					<div class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-notif">
						<i class="zmdi zmdi-notifications"></i>
					</div>
				<?php }else{?>
					<div class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
						<i class="zmdi zmdi-notifications"></i>
					</div>
				<?php } ?>

				<div class="sideMenu">
					<?php
						if($data1['image'] == ''){
							echo '<img src="images/default.png" alt="Profile" class="user-pic js-show-profile" id="img">';
						}else{
							echo '<img src="admin/uploads/'.$data1['image'].'" alt="Profile" class="user-pic js-show-profile" id="img">';
						}
					?>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="maindex.php">Home</a>
				</li>

				<li>
					<a href="product_main.php">Menu</a>
				</li>

				<li>
					<a href="paluwagan_main.php">Paluwagan</a>
				</li>

				<li>
					<a href="about_main.php">About</a>
				</li>

				<li class="active-menu">
					<a href="contact_main.php">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form action="searchResult.php" class="wrap-search-header flex-w p-l-15" method="GET">
					<button class="flex-c-m trans-04" type="submit" name="submit">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="menu" placeholder="Search..." value="<?php if(isset($_GET['menu'])){ echo $_GET['menu'];} ?>">
				</form>
			</div>
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-101 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php
						$grand_total = 0;
						$getdata = $conn->query("SELECT * FROM mycart WHERE buyer_ID='$myid'");
						while($row = $getdata->fetch_array()){ 

						$proid = $row['menu_ID'];
						$getMenu = $conn->query("SELECT * FROM menu WHERE menu_ID='$proid'");
						$rowMenu = $getMenu->fetch_array();
					?>
						<li class="header-cart-item flex-w flex-t m-b-12">
							<div class="header-cart-item-img">
								<img src="admin/uploads/<?= $rowMenu['image']; ?>" alt="IMG-PRODUCT">
							</div>

							<div class="header-cart-item-txt p-t-8">
								<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
									<?= $rowMenu['menu'];?>
								</a>

								<span class="header-cart-item-info">
									<?= $row['qty'];?> x &#8369;<?php echo number_format($sub_total = ($row['price'] * $row['qty']),2); ?>
								</span>
							</div>
						</li>							
					<?php $grand_total += $sub_total; 
						} 
					?>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: &#8369;<?php echo number_format($grand_total, 2);  ?>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="check_my_cart.php" class="flex-c-m stext-107 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="check_my_cart.php" class="flex-c-m stext-107 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Notification -->
	<div class="wrap-header-cart js-panel-notif">
		<div class="s-full js-hide-notif"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-101 cl2">
					Your Notification
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-notif">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php
						$getNotif = $conn->query("SELECT * FROM notif WHERE seen_status = '0' AND customer_ID='$data1[customer_ID]'");
						while($rowNotif = $getNotif->fetch_array()){ 

						$cusid = $rowNotif['customer_ID'];
						$getCus = $conn->query("SELECT * FROM customer WHERE customer_ID='$cusid'");
						$rowCus = $getCus->fetch_array();
					?>
						<li class="header-cart-item flex-w flex-t m-b-12">
							<!-- <div class="header-cart-item-img">
								<img src="admin/uploads/<?= $rowMenu['image']; ?>" alt="IMG-PRODUCT">
							</div> -->

							<div class="header-cart-item-txt p-t-0">
								<span class="header-cart-item-name m-b-10 trans-04">
									<?= $rowNotif['description'];?>
								</span>

								<span class="header-cart-item-info">
									<?= $rowNotif['date'];?>
								</span>
							</div>
						</li>							
					<?php } ?>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-buttons flex-w w-full">
						<a href="#" class="flex-c-m stext-107 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Notification
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- User Profile -->
	<div class="wrap-header-cart js-panel-profile">
		<div class="s-full js-hide-profile"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-101 cl2">
					<?= $data1['firstName'].' '.$data1['lastName']; ?>
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-profile">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img1">
							<i class="fa fa-user" aria-hidden="true"></i>
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="myaccount.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								My Account
							</a>
						</div>

						<div class="header-cart-item-img1">
							<i class="fa fa-shopping-bag" aria-hidden="true"></i>
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="myorder.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								My Order
							</a>
						</div>

						<div class="header-cart-item-img1">
							<i class="fa fa-balance-scale mr-2" aria-hidden="true"></i> 
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="paluwagan_main.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Paluwagan
							</a>
						</div>

						<div class="header-cart-item-img1">
							<i class="fa fa-money" aria-hidden="true"></i>
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="payment.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Payment
							</a>
						</div>

						<div class="header-cart-item-img1">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="logout.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Logout
							</a>
						</div>
					</li>							
				</ul>
			</div>
		</div>
	</div>

	<!--<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">-->
	<!--	<h2 class="ltext-105 cl0 txt-center">-->
	<!--		Check out your order-->
	<!--	</h2>-->
	<!--</section>-->

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-0 p-r-15 p-t-30 p-lr-0-lg">
			<a href="maindex.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Checkout
			</span>
		</div>
	</div>

	<!-- Shoping Cart -->
	<div class="bg0 p-t-65 p-b-85">
		<div class="container">
			<form name ="myform" action="checkout_exe.php" method="POST" onsubmit="return validate()">
			<input type="hidden" name="codex" class="form-control" value="<?= $data1['customer_ID']; ?>">
				<div class="row">
					<div class="col-md-6 mb-5 mb-md-0">
						<h2 class="h3 mb-3 text-black">Customer Address</h2>
						<div class="p-3 p-lg-5 border bg-white">
							<?php 
								$cusid = $data1['customer_ID'];
								$getCus = $conn->query("SELECT * FROM customer_address WHERE customer_ID='$cusid'");
								if(mysqli_num_rows($getCus) > 0 ){ 
									while($rowCus = $getCus->fetch_array()){

										$proid = $rowCus['province_ID'];
										$getPro = $conn->query("SELECT * FROM province WHERE id='$proid'");
										$rowPro = $getPro->fetch_array();

										$munid = $rowCus['municipal_ID'];
										$getMun= $conn->query("SELECT * FROM municipality WHERE id='$munid'");
										$rowMun = $getMun->fetch_array();

										$barid = $rowCus['barangay_ID'];
										$getBar= $conn->query("SELECT * FROM barangay WHERE id='$barid'");
										$rowBar = $getBar->fetch_array();
							
							?>	
									<div class="form-group row">
										<div class="col-md-12">
											<label for="province" class="text-black">Province</label>
											<input type="text" class="form-control" id="province" name="province" value="<?= $rowPro['province']; ?>" readonly/>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<label for="municipality" class="text-black">Municipality</label>
											<input type="text" class="form-control" id="municipality" name="municipality" value="<?= $rowMun['municipality']; ?>" readonly/>
										</div>
									</div>
								
									<div class="form-group row">
										<div class="col-md-12">
											<label for="barangay" class="text-black">Barangay</label>
											<input type="text" class="form-control" id="barangay" name="barangay" value="<?= $rowBar['barangay']; ?>" readonly/>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-6">
											<label for="address" class="text-black">Address</label>
											<input type="text" class="form-control" id="address" name="address" value="<?= $rowCus['sitio']; ?>" readonly/>
										</div>
										<div class="col-md-6">
											<label for="zip" class="text-black">Zipcode</label>
											<input type="text" class="form-control" id="zip" name="zip" value="<?= $rowCus['zipcode']; ?>" readonly/>
										</div>
									</div>

								<?php 
										}
									}else{ ?>
								<div class="form-group">
									<label for="" class="text-black">Province <span class="text-danger">*</span></label>
									<select class="form-control" name="c_province" id="province-list" onchange="getMunicipality(this.value)" required>
										<option value="">Select Province</option>
											<?php 
												$loantype = mysqli_query($conn,"SELECT * FROM province");
												while($rowtype = mysqli_fetch_array($loantype)){ 
											?>
										<option value="<?php echo $rowtype['id'] ?>"><?php echo $rowtype['province'] ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="form-group">
									<label for="c_municipality" class="text-black">Municipality <span class="text-danger">*</span></label>
									<select class="form-control" name="municipality-list" id="municipality-list" onchange="getBarangay(this.value)" required>
										<option value="">Select municipality</option>
									</select>
								</div>

								<div class="form-group">
									<label for="c_barangay" class="text-black">Barangay <span class="text-danger">*</span></label>
									<select class="form-control" name="barangay-list" id="barangay-list" required>
										<option value="">Select barangay</option>
									</select>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="c_address" name="c_address" placeholder="Apartment, suite, unit etc." required/>
									</div>
									<div class="col-md-6">
										<label for="c_postal_zip" class="text-black">Zip Code <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip" required />
									</div>
								</div>
							<?php } ?>						
								<div class="form-group row">
									<div class="col-md-6">
										<label for="date_pick_up" class="text-black">Date of pick-up <span class="text-danger">*</span></label>
										<input type="date" class="form-control" id="date_pick_up" name="date_pick_up" required />
									</div>
									<div class="col-md-6">
										<label for="date_pick_up" class="text-black">Time of pick-up <span class="text-danger">*</span></label>
										<input type="time" class="form-control" id="timePicker" onchange="validateTime()" name="time_pick_up" required />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<label for="dedication" class="text-black">Dedication <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="dedication" name="dedication" value="N/A" placeholder="For cake order only write N/A if NOT applicable" required />
									</div>
								</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row mb-5">
							<div class="col-md-12">
								<h2 class="h3 mb-3 text-black">Your Order</h2>
								<div class="p-3 p-lg-5 border bg-white">
									<table class="table site-block-order-table mb-5">
										<thead>
											<th>Menu</th>
											<th>Total</th>
										</thead>
										<tbody>
											<?php
												$grand_total = 0;
												$select_cart = mysqli_query($conn, "SELECT * FROM `mycart` WHERE orderNO = '$code' AND buyer_ID='$data1[id]'");
												if(mysqli_num_rows($select_cart) > 0){
													while($fetch_cart = mysqli_fetch_array($select_cart)){

													$menuid=$fetch_cart['menu_ID'];
													$sql = mysqli_query($conn, "SELECT * FROM menu WHERE menu_ID='$menuid'");
													$row=mysqli_fetch_array($sql);	
													 
													$typequery = mysqli_query($conn,"SELECT * FROM terms_condition WHERE type='Ordering' OR type='Order'");
													$typedata = mysqli_fetch_array($typequery);
											?>
												<tr>
													<input type="hidden" name="code" value="<?php echo $fetch_cart['orderNo']; ?>">
													<td><?php echo $row['menu']; ?> <strong class="mx-2">x</strong> <?= $fetch_cart['qty']; ?></td>
													<td>&#8369;<?php echo number_format($sub_total = ($row['price'] * $fetch_cart['qty']),2); ?></td>
												</tr>
											<?php 
												$grand_total += $sub_total;  
												} }
											?>
											<tr>
												<input type="hidden" name="gTotal" value="<?php echo ($grand_total); ?>">
												<td class="text-black font-weight-bold"><strong>Order Total</strong></td>
												<td id="gTotal" class="text-black font-weight-bold"><strong>&#8369;<?php echo number_format($grand_total,2); ?></strong></td>
											</tr>
										</tbody>
									</table>
										<label>Note:</label><br>
										<p style="color: red">Order pickups are scheduled from 7:00 AM to 10:00 PM. Pickups requested after this time will be processed the next day.</p>
									<div class="wrapper" style="margin-top: 30px ">
										<input  type="checkbox" name="terms" autocomplete="off" id="check" required /> 
										<label for="check"> I agree with the <a href="admin/terms/<?php echo $typedata['terms_condition']; ?>"> Terms and condition</a></label>
									</div>
									<div class="flex-c-m flex-w w-full p-t-0">
									   <?php
									        if($data1['identification'] =='' || $data1['address'] =='' || $data1['status'] == 0){ ?>
                    							<a href="restrict_menu.php?on=<?php echo $data1['customer_ID']; ?>" class="flex-c-m stext-103 cl0 size-103 bg3 bor1 hov-btn1 p-lr-15 trans-04 pointer m-tb-5">Proceed to Checkout</a>
                    						<?php } else{ ?>
    										<button type="submit" class="flex-c-m stext-103 cl0 size-103 bg3 bor1 hov-btn1 p-lr-15 trans-04 pointer m-tb-5" name="placeorder" id="btn">
    											Proceed to Checkout
    										</button>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
			

	<!-- Footer -->
	<?php include('footer.php');?>

  <script>
    function validateTime() {
      var timeInput = document.getElementById("timePicker");
      var selectedTime = new Date("2000-01-01T" + timeInput.value);
      var lowerBound = new Date("2000-01-01T07:00:00");
      var upperBound = new Date("2000-01-01T22:00:00");

      if (selectedTime < lowerBound || selectedTime > upperBound) {
        alert("Please select a time between 7:00 AM and 10:00 PM.");
        timeInput.value = ""; // Clear the invalid selection
      }
    }
  </script>
  
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>
	<script type='text/javascript' src="js/sweetalert.min.js"></script>
	<?php
		if(isset($_SESSION['status']) && $_SESSION['status'] !='')
		{
			?>
				<script>
				swal({
				text: "<?php echo $_SESSION['status']?>",
				icon: "<?php echo $_SESSION['status_code']?>",
				button: "Ok",

		});
				</script>
				<?php 
				unset($_SESSION['status']);
		}
	?>
	<script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("date_pick_up").setAttribute("min", today);
    </script>
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>

	<script type="text/javascript">
		function getMunicipality(val) {
		$.ajax({
		url: "getMunicipality.php",
		type: "POST",
		data: 'province_id='+val,
		success: function(data){
		$("#municipality-list").html(data);
		//   $("#municipality-listup").html(data);
		// getMunicipality();
			}
		});
		};

		function getBarangay(val) {
		$.ajax({
		url: "getBarangay.php",
		type: "POST",
		data: 'municipality_id='+val,
		success: function(data){
		$("#barangay-list").html(data);
		//   $("#barangay-listup").html(data);`
			}
		});
		};
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>