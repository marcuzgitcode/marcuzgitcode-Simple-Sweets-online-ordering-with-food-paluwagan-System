<?php
	session_start();
	require ('db.php');

	// $code=$_GET['on'];
	$myid=$_SESSION['login_me'];
	if(!isset($_SESSION['login_me']) || trim($_SESSION['login_me']=="")){
		header("location: register.php");
		exit();
	}

	$qryget=mysqli_query($conn,"SELECT * FROM customer WHERE id='$myid'");
	if(mysqli_num_rows($qryget) > 0){
		$data1 = mysqli_fetch_assoc($qryget);
	} 
	 
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
        <link rel="stylesheet" type="text/css" href="css/tabmenu.css">
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

<script>
        function loanamount(){
            var permonth = document.getElementById('monthly').value;
            var numbermonth = document.getElementById('numberMonth').value;

            var amountpaid = (Number(permonth) * Number(numbermonth));
            document.getElementById("amountx").value=amountpaid;
            
            var balance_amount = document.getElementById('balanceAmount').value;
            var amountxx = document.getElementById('amountx').value;

            var duedate = document.getElementById('numberMonths').value;
            var penaltyAmount = document.getElementById('penaltyRate').value;

            var penaltyDue=(penaltyAmount * duedate);
            document.getElementById('penalty').value=penaltyDue;
            
            var totalamountDue=(penaltyDue + amountpaid);
            document.getElementById('totalAmountDue').value=totalamountDue;

            if (Number(balance_amount) < Number(amountxx)){
                alert('Invalid input!');
                document.getElementById("numberMonth").value = "";
                document.getElementById('amountx').value="";
                document.getElementById('penalty').value="";
                document.getElementById('totalAmountDue').value="";
            }

            if (Number(balance_amount) == 0){
                alert('You have no paluwagan available!');
                document.getElementById("numberMonth").value = "";
                document.getElementById('amountx').value="";
                document.getElementById('penalty').value="";
                document.getElementById('totalAmountDue').value="";
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

	<!-- <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Check out your order
		</h2>
	</section> -->

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-0 p-r-15 p-t-30 p-lr-0-lg">
			<a href="maindex.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Payment
			</span>
		</div>
	</div>

	<!-- My Order -->
	<div class="bg0 p-t-25 p-b-85">
		<div class="container">
            <div class="tab-wrap">
                <?php
                    $qrygetOrders=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$data1[customer_ID]'");
                    $qrygetOrders_run = mysqli_num_rows($qrygetOrders);

                    $qrygetOrdersPending=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$data1[customer_ID]' AND status='0'");
                    $qrygetOrdersPending_run = mysqli_num_rows($qrygetOrdersPending);

                    $qrygetOrdersApproved=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$data1[customer_ID]' AND status='1'");
                    $qrygetOrdersApproved_run = mysqli_num_rows($qrygetOrdersApproved);

                    $qrygetOrdersCompleted=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$data1[customer_ID]' AND status='3'");
                    $qrygetOrdersCompleted_run = mysqli_num_rows($qrygetOrdersCompleted);

                    $qrygetOrdersCanceled=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$data1[customer_ID]' AND status='2'");
                    $qrygetOrdersCanceled_run = mysqli_num_rows($qrygetOrdersCanceled);
                ?>
					<input type="radio" id="tab4" name="tabGroup2" class="tab" checked>
					<label for="tab4">All <span>(<?= $qrygetOrders_run; ?>)</span></label>
					<input type="radio" id="tab5" name="tabGroup2" class="tab">
					<label for="tab5">Pending <span>(<?= $qrygetOrdersPending_run; ?>)</span></label>
					<input type="radio" id="tab6" name="tabGroup2" class="tab">
					<label for="tab6">To Pick-up <span>(<?= $qrygetOrdersApproved_run; ?>)</span></label>
					<input type="radio" id="tab7" name="tabGroup2" class="tab">
					<label for="tab7">Completed <span>(<?= $qrygetOrdersCompleted_run; ?>)</span></label>
					<input type="radio" id="tab8" name="tabGroup2" class="tab">
					<label for="tab8">Canceled <span>(<?= $qrygetOrdersCanceled_run; ?>)</span></label>

                <div class="tab__content">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Menu</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            <?php
                                $cusid = $data1['customer_ID'];
                                $qrygetMyOrder=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$cusid'");
                                while($qrygetMyOrder_run = mysqli_fetch_assoc($qrygetMyOrder)){
									$date =date('M d, Y', strtotime($qrygetMyOrder_run['date_entry']));

                                $qrygetMenu=mysqli_query($conn,"SELECT * FROM menu WHERE menu_ID='$qrygetMyOrder_run[menu_ID]'");
                                $qrygetMenu_run = mysqli_fetch_assoc($qrygetMenu);
                            ?>
                                <tr>
                                    <td class='menu__details'>
                                        <img src="admin/uploads/<?php echo $qrygetMenu_run['image']; ?>" alt="" class="table__image">
                                            <div class="sed">
                                                <span>
                                                    <?php echo $qrygetMenu_run['menu']; ?><br>
                                                    <?php echo $qrygetMenu_run['description']; ?>
                                                </span>
                                            </div>
                                    </td>
                                    <td><?php echo $qrygetMyOrder_run['qty']; ?></td>
                                        <td>&#8369;<?php echo number_format($qrygetMyOrder_run['price'],2); ?></td>
                                        <td>&#8369;<?php echo number_format($qrygetMyOrder_run['total_price'],2); ?></td>
                                        <?php
                                            if($qrygetMyOrder_run['status']==0){
                                                echo '<td>Pending</td>';
                                            }elseif($qrygetMyOrder_run['status']==1){
                                                echo '<td>Approved</td>';
                                            }elseif($qrygetMyOrder_run['status']==2){
                                                echo '<td>Cancelled</td>';
                                            }elseif($qrygetMyOrder_run['status']==3){
                                                echo '<td>Completed</td>';
                                            }else{
                                                echo '<td></td>';
                                            }
                                        ?>
                                        <td><?php echo $date; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab__content">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Menu</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            <?php
                                $cusid = $data1['customer_ID'];
                                $qrygetMyOrder=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$cusid' AND status='0'");
                                while($qrygetMyOrder_run = mysqli_fetch_assoc($qrygetMyOrder)){
									$date =date('M d, Y', strtotime($qrygetMyOrder_run['date_entry']));

                                $qrygetMenu=mysqli_query($conn,"SELECT * FROM menu WHERE menu_ID='$qrygetMyOrder_run[menu_ID]'");
                                $qrygetMenu_run = mysqli_fetch_assoc($qrygetMenu);
                            ?>
                                <tr>
                                    <td class='menu__details'>
                                        <img src="admin/uploads/<?php echo $qrygetMenu_run['image']; ?>" alt="" class="table__image">
                                            <div class="sed">
                                                <span>
                                                    <?php echo $qrygetMenu_run['menu']; ?><br>
                                                    <?php echo $qrygetMenu_run['description']; ?>
                                                </span>
                                            </div>
                                    </td>
                                    <td><?php echo $qrygetMyOrder_run['qty']; ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['price'],2); ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['total_price'],2); ?></td>
                                    <?php
                                        if($qrygetMyOrder_run['status']==0){
                                            echo '<td>Pending</td>';
                                        }elseif($qrygetMyOrder_run['status']==1){
                                            echo '<td>Approved</td>';
                                        }elseif($qrygetMyOrder_run['status']==2){
                                            echo '<td>Cancelled</td>';
                                        }elseif($qrygetMyOrder_run['status']==3){
                                            echo '<td>Completed</td>';
                                        }else{
                                            echo '<td></td>';
                                        }
                                    ?>
                                    <td><?php echo $date; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab__content">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Menu</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            <?php
                                $cusid = $data1['customer_ID'];
                                $qrygetMyOrder=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$cusid' AND status='1'");
                                while($qrygetMyOrder_run = mysqli_fetch_assoc($qrygetMyOrder)){
									$date =date('M d, Y', strtotime($qrygetMyOrder_run['date_entry']));

                                $qrygetMenu=mysqli_query($conn,"SELECT * FROM menu WHERE menu_ID='$qrygetMyOrder_run[menu_ID]'");
                                $qrygetMenu_run = mysqli_fetch_assoc($qrygetMenu);
                            ?>
                                <tr>
                                    <td class='menu__details'>
                                        <img src="admin/uploads/<?php echo $qrygetMenu_run['image']; ?>" alt="" class="table__image">
                                            <div class="sed">
                                                <span>
                                                    <?php echo $qrygetMenu_run['menu']; ?><br>
                                                    <?php echo $qrygetMenu_run['description']; ?>
                                                </span>
                                            </div>
                                    </td>
                                    <td><?php echo $qrygetMyOrder_run['qty']; ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['price'],2); ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['total_price'],2); ?></td>
                                    <td><?php echo $date; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab__content">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Menu</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            <?php
                                $cusid = $data1['customer_ID'];
                                $qrygetMyOrder=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$cusid' AND status='3'");
                                while($qrygetMyOrder_run = mysqli_fetch_assoc($qrygetMyOrder)){
									$date =date('M d, Y', strtotime($qrygetMyOrder_run['date_entry']));

                                $qrygetMenu=mysqli_query($conn,"SELECT * FROM menu WHERE menu_ID='$qrygetMyOrder_run[menu_ID]'");
                                $qrygetMenu_run = mysqli_fetch_assoc($qrygetMenu);
                            ?>
                                <tr>
                                    <td class='menu__details'>
                                        <img src="admin/uploads/<?php echo $qrygetMenu_run['image']; ?>" alt="" class="table__image">
                                            <div class="sed">
                                                <span>
                                                    <?php echo $qrygetMenu_run['menu']; ?><br>
                                                    <?php echo $qrygetMenu_run['description']; ?>
                                                </span>
                                            </div>
                                    </td>
                                    <td><?php echo $qrygetMyOrder_run['qty']; ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['price'],2); ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['total_price'],2); ?></td>
                                    <td><?php echo $date; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab__content">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Menu</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            <?php
                                $cusid = $data1['customer_ID'];
                                $qrygetMyOrder=mysqli_query($conn,"SELECT * FROM orders WHERE customer_ID='$cusid' AND status='2'");
                                while($qrygetMyOrder_run = mysqli_fetch_assoc($qrygetMyOrder)){
									$date =date('M d, Y', strtotime($qrygetMyOrder_run['date_entry']));

                                $qrygetMenu=mysqli_query($conn,"SELECT * FROM menu WHERE menu_ID='$qrygetMyOrder_run[menu_ID]'");
                                $qrygetMenu_run = mysqli_fetch_assoc($qrygetMenu);
                            ?>
                                <tr>
                                    <td class='menu__details'>
                                        <img src="admin/uploads/<?php echo $qrygetMenu_run['image']; ?>" alt="" class="table__image">
                                            <div class="sed">
                                                <span>
                                                    <?php echo $qrygetMenu_run['menu']; ?><br>
                                                    <?php echo $qrygetMenu_run['description']; ?>
                                                </span>
                                            </div>
                                    </td>
                                    <td><?php echo $qrygetMyOrder_run['qty']; ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['price'],2); ?></td>
                                    <td>&#8369;<?php echo number_format($qrygetMyOrder_run['total_price'],2); ?></td>
                                    <td><?php echo $date; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

		</div>
	</div>
			
	<!-- Footer -->
	<?php include('footer.php');?>

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