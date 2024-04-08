<?php
    session_start();
    require ('db.php');
    $myid=$_SESSION['login_me'];
	$qryget=mysqli_query($conn,"SELECT * FROM customer WHERE id='$myid'");
	if(mysqli_num_rows($qryget) > 0){
		$data1 = mysqli_fetch_assoc($qryget);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Simple Sweet Menu</title>
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
		<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
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
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-10 p-r-11 js-show-modal-search">
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
							$getnotif = $conn->query("SELECT * FROM notif WHERE seen_status = 0 AND customer_ID='$myid'");
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
									echo '<img src="admin/uploads/'.$data1['image'].'" alt="Profile" class="user-pic" id="img">';
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
					$getnotif = $conn->query("SELECT * FROM notif WHERE seen_status = 0 AND customer_ID='$myid'");
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
							echo '<img src="admin/uploads/'.$data1['image'].'" alt="Profile" class="user-pic" id="img">';
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

				<li>
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
									<?= $row['qty'];?> x &#8369;<?php echo $sub_total = number_format($row['price'] * $row['qty'],2); ?>
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
						$getNotif = $conn->query("SELECT * FROM notif WHERE seen_status = '0' AND customer_ID='$data1[customer_ID]' ORDER BY id DESC");
						while($rowNotif = $getNotif->fetch_array()){ 
						    $date =date('M d, Y', strtotime($rowNotif['date']));

    						$cusid = $rowNotif['customer_ID'];
    						$getCus = $conn->query("SELECT * FROM customer WHERE customer_ID='$cusid'");
    						$rowCus = $getCus->fetch_array();
					?>
						<li class="header-cart-item flex-w flex-t m-b-12">
							<div class="header-cart-item-txt p-t-0">
								<span class="header-cart-item-name m-b-10 trans-04">
									<?= $rowNotif['description'];?>
								</span>

								<span class="header-cart-item-info">
									<?= $date;?>
								</span>
							</div>
						</li>							
					<?php  
						} 
					?>
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
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								My Order
							</a>
						</div>

						<div class="header-cart-item-img1">
							<i class="fa fa-balance-scale mr-2" aria-hidden="true"></i> 
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Paluwagan
							</a>
						</div>

						<div class="header-cart-item-img1">
							<i class="fa fa-money" aria-hidden="true"></i>
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
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

	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Our delicious menu
		</h2>
	</section>	

	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="row isotope-grid">
				<?php 
					$counters=1;
					$sql_qry=mysqli_query($conn, "SELECT * FROM category ORDER BY category ASC");
					while($categ=mysqli_fetch_array($sql_qry)){
					
						$a=$categ['id'];
						if($_SERVER["REQUEST_METHOD"] == "GET") {
							$menu = $_GET['menu'];
		
							$sql = "SELECT * FROM menu WHERE 1=1 AND status = 1 AND category ='$a'";
							
							if (!empty($menu)) {
								$sql .= " AND menu LIKE '%$menu%'";
							}
							$result = $conn->query($sql);
						
							if ($result->num_rows > 0 ) {
	
								
								while ($detail = $result->fetch_assoc()) { 
				?>	
								<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $categ['id']; ?>">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/uploads/<?= $detail['image']; ?>" alt="IMG-PRODUCT">

											<a href="product-detail_main.php?aid=<?php echo $detail['menu_ID']; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
												Add to Cart
											</a>

										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail_main.php?aid=<?php echo $detail['menu_ID']; ?>" class="stext-103 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?= $detail['menu']; ?>
												</a>

												<span class="stext-105 cl3">
													&#8369;<?= number_format($detail['price'],2); ?>
												</span>
											</div>
										</div>
									</div>
								</div>
				<?php 			} 
							}
						} 
					} 
				?>
			</div>

			<!-- Load more -->
			<!--<div class="flex-c-m flex-w w-full p-t-45">-->
			<!--	<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">-->
			<!--		Load More-->
			<!--	</a>-->
			<!--</div>-->
		</div>
	</div>
	
	<!-- Footer -->
	<?php include 'footer.php';?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

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
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
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
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>