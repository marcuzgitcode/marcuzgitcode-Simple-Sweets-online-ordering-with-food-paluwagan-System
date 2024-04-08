<?php
	session_start();
	require ('db.php');
	include 'check_my_cart1.php';

	$myid=$_SESSION['login_me'];
	$qryget=mysqli_query($conn,"SELECT * FROM customer WHERE id='$myid'");
	if(mysqli_num_rows($qryget) > 0){
		$data1 = mysqli_fetch_assoc($qryget);
	}

	$menu_id=$_GET['aid'];
	$sql = mysqli_query($conn,"SELECT * FROM menu WHERE menu_ID = '$menu_id'");
	$query = mysqli_fetch_assoc($sql);

	$sqlCat = mysqli_query($conn,"SELECT * FROM category WHERE id = '$query[category]'");
	$queryCat = mysqli_fetch_assoc($sqlCat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Detail</title>
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
							<!-- <div class="header-cart-item-img">
								<img src="admin/uploads/<?= $rowMenu['image']; ?>" alt="IMG-PRODUCT">
							</div> -->

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
							<a href="myorder.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								My Order
							</a>
						</div>

						<div class="header-cart-item-img1">
							<i class="fa fa-balance-scale mr-2" aria-hidden="true"></i> 
						</div>
						<div class="header-cart-item-txt1 p-t-0">
							<a href="paluwagan_profile.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
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

	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Menu Details
		</h2>
	</section>	

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="maindex.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="product_main.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?= $queryCat['category']?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?= $query['menu']?>
			</span>
		</div>
	</div>

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb" >
								<div class="item-slick3" data-thumb="admin/uploads/<?= $query['image']; ?>">
									<div class="wrap-pic-w pos-relative">
										<img src="admin/uploads/<?= $query['image']; ?>" height="600vh !important" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="admin/uploads/<?= $query['image']; ?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<form action="save_to_cart.php" method="POST">
							<input type="hidden" value="<?php echo ($query['menu_ID']); ?>" name="code">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								<?= $query['menu']?>
							</h4>

							<span class="mtext-106 cl2">
								&#8369;<?= number_format($query['price'], 2); ?>
							</span>
							<input type="hidden" value="<?php echo ($query['price']); ?>" name="price">

							<p class="stext-102 cl3 p-t-23">
								<?= $query['description']?>
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down1 cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up1 cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button type="submit" class="flex-c-m stext-103 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" name="add_to_cart">
											Add to cart
										</button>
									</div>
								</div>	
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				Product ID: <?= $query['menu_ID']?>
			</span>

			<span class="stext-107 cl6 p-lr-25">
				Category: <?= $queryCat['category']?>
			</span>
		</div> -->
	</section>


	<!-- Related Products -->
	<!-- <section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Menu
				</h3>
			</div>

			
			<div class="wrap-slick2">
				<div class="slick2">
					<?php
						$a=$query['menu'];
						$qrydisplaymenu=mysqli_query($conn,"SELECT * FROM menu WHERE menu LIKE '%$a%'");
						while($detail=mysqli_fetch_array($qrydisplaymenu)){ 
					?>
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
	
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="admin/uploads/<?= $detail['image']; ?>" alt="IMG-PRODUCT">

								<a href="product-detail_main.php?aid=<?php echo $detail['menu_ID']; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
									Add to Cart
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail_main.php?aid=<?php echo $detail['menu_ID']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?= $detail['menu']?>
									</a>

									<span class="stext-105 cl3">
										&#8369;<?= number_format($detail['price'], 2); ?>
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section> -->
		

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