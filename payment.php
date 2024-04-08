<?php
	session_start();
	require ('db.php');

	$myid=$_SESSION['login_me'];
	if(!isset($_SESSION['login_me']) || trim($_SESSION['login_me']=="")){
		header("location: register.php");
		exit();
	}

    if (isset($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); // Clear the message to avoid displaying it again
      } else {
          $flashMessage = null;
    }
    
	$qryget=mysqli_query($conn,"SELECT * FROM customer WHERE id='$myid'");
	if(mysqli_num_rows($qryget) > 0){
		$data1 = mysqli_fetch_assoc($qryget);
	}

    $qrygetAdd=mysqli_query($conn,"SELECT * FROM customer_address WHERE customer_ID='$data1[customer_ID]'");
    $qrygetAdd_run = mysqli_fetch_assoc($qrygetAdd);

    $msg = "";
    if(isset($_POST['submitPayment'])){
        $code = $_POST['codex'];	
        $paluwaganID = $_POST['paluwaganID'];
        $pamountx = $_POST['totalAmountDue'];
        $subAmount = $_POST['amountx'];
        $balance = $_POST['balanceAmount'];
        $monthly = $_POST['monthly'];
        $penalty = $_POST['penalty'];
        $nom = $_POST['numberMonth'];
    
        $file = rand(1000,100000)."-".$_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder="admin/uploads/";
    
        $new_size = $file_size/1024;  
        $new_file_name = strtolower($file); 
        $final_file=str_replace(' ','-',$new_file_name);
        
        // $current_balance= $balance-$subAmount;
        
        date_default_timezone_set('Asia/Manila');
        $petsa=date("Y-m-d");
        
        $date = date("Y-m-d");
        $date = strtotime($date);
        $date = strtotime("+30 day", $date);
        $ood  = date('Y-m-d', $date);
        
        $next_due_date=($ood);
    
        $menusearch = mysqli_query($conn,"SELECT * FROM payment ORDER BY seq DESC");
        $search_run=mysqli_fetch_array($menusearch);
    
        $dateString = date('Ymd');
        $type = 'PID';
        $IDNumber = $search_run['seq'];
    
        if($IDNumber < 9999) {
        
            $IDNumber = $IDNumber + 1;
          
          }else{
           $IDNumber = 1;
          } 
          $number = $type . '' . $dateString . '-' . $IDNumber;
    
        if(move_uploaded_file($file_loc,$folder.$final_file)){
    
            $watcher=mysqli_query($conn,"SELECT * FROM payment_request WHERE customer_ID='$code' AND paluwagan_ID='$paluwaganID' AND status=0");
            $counter=mysqli_num_rows($watcher);
    
            if($counter<=0){
                $qrysave="INSERT INTO payment_request (seq, payment_ID, paluwagan_ID, customer_ID, subTotal, amount, monthly, penalty, nom, duedate, image, status, date_entry) 
                VALUES ('$IDNumber','$number','$paluwaganID','$code', '$subAmount', '$pamountx', '$monthly','$penalty','$nom','$next_due_date', '$final_file', '0', '$petsa')";
                $result=mysqli_query($conn,$qrysave);
    
                if ($result){
                    $_SESSION['flash_message'] ='Payment request submitted';
                    header("location: payment.php");
                }else{
                    die("Query Failed!");
                }
            }else{
                $_SESSION['flash_message'] = 'Request failed, Your first request is not yet accepted.';
                header("location: payment.php");
            }
        }
        header("location: payment.php");
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
		<script src="../js/script.js"></script>
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

	<!-- Shoping Cart -->
	<div class="bg0 p-t-65 p-b-85">
		<div class="container">
            <?php if ($flashMessage): ?>
                <div id="flash-message" class="alert alert-info alert-dismissible fade show" role="alert">
                    <?php echo $flashMessage; ?>
                    </div>
            <?php endif; ?>
            
			<form action="" method="POST" enctype="multipart/form-data">        
				<div class="row">
					<div class="col-md-6 mb-5 mb-md-0">
						<h2 class="h3 mb-3 text-black">Payment Details</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <?php
                                $cusid = $data1['customer_ID'];
                                // $l = mysqli_query($conn, "SELECT * FROM paluwagan_member");
                                $l = mysqli_query($conn, "SELECT * FROM paluwagan_member WHERE customer_ID='$cusid' AND balance != 0 AND status = 1");
                                while($l1= mysqli_fetch_assoc($l)){

                                    $palid = $l1['paluwagan_ID'];
                                    $sqlPaluwagan = mysqli_query($conn, "SELECT * FROM paluwagan WHERE paluwagan_ID='$palid' AND status = 3");
                                    $sqlPaluwagan_run = mysqli_fetch_assoc($sqlPaluwagan);

                                    $mydue=$l1['paluwagan_ID'];
                                    $payments = mysqli_query($conn,"SELECT * from payment where paluwagan_ID='$mydue'");

                                    $getmydue=mysqli_query($conn,"SELECT * FROM paluwagan_schedule WHERE paluwagan_ID='$mydue' AND paid=0 ORDER BY date(duedate) ASC limit 1");
                                    $l7=mysqli_fetch_assoc($getmydue);

                                    date_default_timezone_set("Asia/Taipei");
                                    $sdate = $l7['duedate'];
                                    $edate = date('Y-m-d');

                                    if (strtotime($sdate) < strtotime($edate)){
                                        $date_diff = abs(strtotime($sdate) - strtotime($edate));

                                        $years = floor($date_diff / (365*60*60*24));
                                        $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
                                        $days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    }else{
                                        $months=0;
                                    }
                                
                            ?>
                            <input type="hidden" name="codex" class="form-control" value="<?= $data1['customer_ID']; ?>">
                            <input type="hidden" name="penaltyRate" id="penaltyRate" value="<?php echo $sqlPaluwagan_run['penalty']; ?>" />
                            <input type="hidden" name="numberMonths" id="numberMonths" value="<?php echo $months; ?>" />
                            <input type="hidden" name="codex" id="codex" value="<?php echo $data1['customer_ID']; ?>" />
                            <input type="hidden" name="paluwaganID" id="paluwaganID" value="<?php echo $l1['paluwagan_ID']; ?>"  />
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="text-black" >Payment Information<span class="text-danger"></span></label>
                                    <label class="text-black" >Name: Vannesa S. Cabrera<span class="text-danger"></span></label>
                                    <label class="text-black" >GCash Number: 09550162688<span class="text-danger"></span></label>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="province" class="text-black">Price</label>
                                    <input type="text" name="price" value="<?= $sqlPaluwagan_run['price']; ?>" class="form-control" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="municipality" class="text-black">Monthly</label>
                                    <input type="text" name="monthly" id="monthly" value="<?= $sqlPaluwagan_run['monthly']; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="barangay" class="text-black">Balance</label>
                                    <input type="text" name="balanceAmount" id="balanceAmount" value="<?= $l1['balance']; ?>" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-black">Penalty</label>
                                    <input type="text" name="penalty" id="penalty" placeholder="0" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="zip" class="text-black">Total Amount Due</label>
                                    <input type="text" name="totalAmountDue" id="totalAmountDue" placeholder="0" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="zip" class="text-black">Number of Months<span class="text-danger">*</span></label>
                                    <input type="text" name="numberMonth" id="numberMonth" class="form-control" onchange="loanamount()" onkeyup="loanamount()" required>
                                    <input type="hidden" class="box" style="font-size: 16px" name="amountx" id="amountx" min="1"  placeholder="Amount" readonly required/>
                                </div>
                            </div>
							
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="text-black" >Prof of Payment<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file" id="inputPic1ToLoad" required>
                                </div>
                            </div> 
							
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<button type="submit" class="flex-c-m stext-103 cl0 size-103 bg3 bor1 hov-btn1 p-lr-15 trans-04 pointer m-tb-5" name="submitPayment">
									Confirm Payment
								</button>
							</div>
                            <?php  } ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row mb-5">
							<div class="col-md-12">
								<h2 class="h3 mb-3 text-black">Payment Summary</h2>
								<div class="p-3 p-lg-5 border bg-white">
									<table class="table site-block-order-table mb-5">
										<thead>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Monthly</th>
                                            <th>Duedate</th>
                                            <th>Status</th>
										</thead>
										<tbody>
											<?php
												$paluid = $l1['paluwagan_ID'];
                                                $getmydues=mysqli_query($conn,"SELECT * FROM paluwagan_schedule WHERE customer_ID='$cusid'");
                                                while($l8=mysqli_fetch_assoc($getmydues)){
													$date =date('M d, Y', strtotime($l8['duedate']));
                                                
                                                $getmyduespal=mysqli_query($conn,"SELECT * FROM paluwagan WHERE paluwagan_ID='$l8[paluwagan_ID]'");
                                                $l9=mysqli_fetch_assoc($getmyduespal)
													
											?>
												<tr>
                                                    <td><?= $l8['paluwagan_ID']; ?></td>
                                                    <td>&#8369;<?= number_format($l9['price'],2); ?></td>
                                                    <td>&#8369;<?= number_format($l9['monthly'],2); ?></td>
                                                    <td><?= $date; ?></td>
                                                    <td>
                                                        <?php
                                                            if($l8['paid']==0){
                                                                echo 'Unpaid';
                                                            }else{
                                                                echo 'Paid';
                                                            } 
                                                        ?>
                                                    </td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
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