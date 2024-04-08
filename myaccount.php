<?php
	session_start();
	require ('db.php');

	// $code=$_GET['on'];
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

	if (isset($_POST['submitProfilePicture']) && isset($_FILES['profile_image'])) {
		$code=$_POST['codex'];

		$img_name = $_FILES['profile_image']['name'];
		$img_size = $_FILES['profile_image']['size'];
		$tmp_name = $_FILES['profile_image']['tmp_name'];
		$error = $_FILES['profile_image']['error'];

		if ($error === 0) {
			if ($img_size > 625000) {
				$msgprofilepicture = "Sorry, your file is too large.";
				// header("Location: addcustomer.php?error=$em");
			}else {
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_lc = strtolower($img_ex);
	
				$allowed_exs = array("jpg", "jpeg", "png"); 
	
				if (in_array($img_ex_lc, $allowed_exs)) {
					$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
					$img_upload_path = 'admin/uploads/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);
	
					if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE customer_ID='{$code}'")) > 0) {
						$sql = "UPDATE customer SET image='$new_img_name' WHERE customer_ID='$code'";
						$result = mysqli_query($conn, $sql);
							if ($result){
								$_SESSION['flash_message'] = 'Successfully Updated';
								header("Location: myaccount.php");
							}else{
								die("Query Failed!");
							}
					}else {
						$_SESSION['flash_message'] = 'Update failed.';
						header("Location: myaccount.php");
					}
	
				}else {
					$_SESSION['flash_message'] ='Please fill all the required field.';
					header("Location: myaccount.php");
				}
			}
			}
		}

	if (isset($_POST['submitProfile'])) {
		$code=$_POST['codex'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		
		date_default_timezone_set('Asia/Manila');
        $petsa=date("Y-m-d");
        
		$eighteen_years_ago = date("Y-m-d", strtotime("-18 years"));
	
	    if (strlen($mobile) >= 10) {
	        if ($birthday <= $eighteen_years_ago) {
        		if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE customer_ID='{$code}'")) > 0) {
        			$qrysave="UPDATE customer SET firstName='$firstName', lastName='$lastName', email='$email', mobile='$mobile', sex='$gender', birthday='$birthday' WHERE customer_ID='$code'";
        			$result=mysqli_query($conn,$qrysave);
        			if ($result){
        				$_SESSION['flash_message'] ='<div class="alert alert-success alert-dismissible fade show" role="alert">Successfully Updated.</div>';
        				header("Location: myaccount.php");
        			}else{
        				die("Query Failed!");
        			}
        		}else{
                    $_SESSION['flash_message'] ='Update failed.';
                    header("Location: myaccount.php");
        		}
	        } else {
                $_SESSION['flash_message'] ='You must be at least 18 years old to register.';
                header("Location: myaccount.php");
            }
	    } else {
            $_SESSION['flash_message'] ='Invalid mobile number';
            header("Location: myaccount.php");
       }
	}

	if (isset($_POST['submitPassword'])) {
        $code=$_POST['codex'];
        $op = md5($_POST['currentPassword']);
        $np = md5($_POST['newPassword']);
        $c_np = md5($_POST['confirmPassword']);
        
        if( empty($op)){
            $_SESSION['flash_message'] ='Old Password is required.';
            header("Location: myaccount.php");
            exit();
      
          }else if( empty($np)){
            $_SESSION['flash_message'] ='New Password is required.';
            header("Location: myaccount.php");
            exit();
      
          }else if($np !== $c_np){
            $_SESSION['flash_message'] ='The confirmation password  does not match.';
            header("Location: myaccount.php");
            exit();
    
        }else {
	
            $sql = $conn->query("SELECT * FROM customer WHERE password='$op' AND customer_ID='$code'");
            $result = $sql->fetch_array();
            if($result > 0){
                
                $sql_2 = "UPDATE customer SET password='$np' WHERE customer_ID='$code'";
                $conn->query($sql_2);
                $_SESSION['flash_message'] ='Your password has been changed successfully.';
                header("Location: myaccount.php");
            }else {
              $_SESSION['flash_message'] ='Incorrect password.';
              header("Location: myaccount.php");
            }
    
        }
    }

    if (isset($_POST['submitAddress'])) {
        $code=$_POST['codex'];
        $province = $_POST['province'];
        $municipality = $_POST['municipality'];
        $barangay = $_POST['barangay'];
        $zipcode = $_POST['zipcode'];
        $sitio = $_POST['sitio'];

		if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer_address WHERE customer_ID='{$code}'")) > 0) {
			$qrysave = "UPDATE customer_address SET province_ID='$province', municipal_ID='$municipality', barangay_ID='$barangay', zipcode='$zipcode', sitio='$sitio' WHERE customer_ID='$code'";
			$result = mysqli_query($conn,$qrysave);
				if ($result){
				$_SESSION['flash_message'] ='Your address has been updated successfully.';
                header("Location: myaccount.php");
				}else{
					die("Query Failed!");
			}

		}else{
			$sql = "INSERT INTO customer_address(customer_ID, province_ID, municipal_ID, barangay_ID, zipcode, sitio) 
			VALUES('$code','$province', '$municipality', '$barangay', '$zipcode', '$sitio')";
			$results = mysqli_query($conn, $sql);
			if ($results){
			    $idenUpdate = mysqli_query($conn,"UPDATE customer SET address='1' WHERE customer_ID='$code'");
				$_SESSION['flash_message'] ='Successfully added your address.';
				header("Location: myaccount.php");
				}else{
					die("Query Faileds!");
			}
		}

    }
    
	if (isset($_POST['submitIdentification'])) {
		$code=$_POST['codex'];
		$typeid=$_POST['typeid'];
		$idnumber=$_POST['idnumber'];
		$expiryDate=$_POST['expiry_date'];
	
		date_default_timezone_set('Asia/Manila');
		$petsa=date("Y-m-d");
	
		$oneMonthLater = date('Y-m-d', strtotime('+1 month'));
	
		$file = rand(1000,100000)."-".$_FILES['image']['name'];
		$file_loc = $_FILES['image']['tmp_name'];
		$file_size = $_FILES['image']['size'];
		$file_type = $_FILES['image']['type'];
		$folder="admin/uploads/";
	
		$new_size = $file_size/1024;
		$new_file_name = strtolower($file); 
		$final_file=str_replace(' ','-',$new_file_name);
		move_uploaded_file($file_loc,$folder.$final_file);
	
		if ($expiryDate > $oneMonthLater) {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer_identification WHERE customer_ID='{$code}'")) > 0) {
                $qrysave="UPDATE customer_identification SET customer_ID='$code', type_id='$typeid', id_number='$idnumber', image_id='$final_file', expiry_date='$expiryDate', status='0' WHERE customer_ID='$code'";
            	$result1=mysqli_query($conn,$qrysave);
            	mysqli_query($conn, "UPDATE `customer` SET status='0' WHERE customer_ID = '$code'");
            	$_SESSION['flash_message'] ='Your ID has been change successfully.';
            	header("Location: myaccount.php");
            }else{	
    			$sql = "INSERT INTO customer_identification(customer_ID, type_id, id_number, image_id, expiry_date, status, date_entry) 
    			VALUES('$code', '$typeid', '$idnumber', '$final_file', '$expiryDate', '0', '$petsa')";
    			$result=mysqli_query($conn,$sql);
            
    				if($result){
    				    mysqli_query($conn, "UPDATE `customer` SET status='0' WHERE customer_ID = '$code'");
    					$_SESSION['flash_message'] ='Your ID has been saved successfully.';
    					header("Location: myaccount.php");
    				}else{
    					die("Query Failed!");
    				}
            }
		}else{
			$_SESSION['flash_message'] ='Expiry date must be at least one month later.';
			header("Location: myaccount.php");
        }
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
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="assets/js/script.js"></script>
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
				Payment
			</span>
		</div>
	</div>

	<!-- My Order -->
	<div class="bg0 p-t-25 p-b-125">
		<div class="container">
            <div class="tab-wrap">
                <input type="radio" id="tab3" name="tabGroup2" class="tab" checked>
                <label for="tab3">Profile Picture</label>
                <input type="radio" id="tab4" name="tabGroup2" class="tab">
                <label for="tab4">Account</label>
                <input type="radio" id="tab5" name="tabGroup2" class="tab">
                <label for="tab5">Address</label>
                <input type="radio" id="tab6" name="tabGroup2" class="tab">
                <label for="tab6">Change Password</label>
                <input type="radio" id="tab7" name="tabGroup2" class="tab">
                <label for="tab7">Upload Identification</label>
            
            <!-- Profile Image -->
            <div class="tab__content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
                    <h6 class="p-b-25">Upload Profile Picture</h6>
                    <?php if ($flashMessage): ?>
                        <div id="flash-message" class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo $flashMessage; ?>
                            </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php
                                    if($data1['image'] == ''){
                                        echo '<img src="images/default.png" alt="Image" class="shadow" style="width: 200px">';
                                    }else{
                                        echo '<img src="admin/uploads/'.$data1['image'].'" alt="Image" class="shadow" style="width: 200px">';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <!-- <label>Profile Picture</label> -->
                                <input type="file" class="form-control" name="profile_image" value="<?=$data1['image']?>" id="">
                            </div>
							<input type="text" hidden="hidden" name="old_pp" value="<?=$data1['image']?>" >
                            <button type="submit" name="submitProfilePicture">							
                                <div class="flex-c-m stext-103 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Save
                                </div>
                            </button>	
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- My Account -->
            <div class="tab__content">
                <form action="" method="POST">
                    <input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
                    <h6 class="p-b-25">Manage your account</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="firstName" class="form-control" value="<?= $data1['firstName']; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" name="lastName" class="form-control" value="<?= $data1['middleName']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lastName" class="form-control" value="<?= $data1['lastName']; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="<?= $data1['email']; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile number</label>
                                    <input type="text" name="mobile" class="form-control" value="<?= $data1['mobile']; ?>" min="0" maxlength="10" minlength="10" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" id="gender" required />
                                    <option value disabled selected>Select Gender</option>
                                        <?php
                                        $query = "SELECT * FROM gender";
                                        $query_run = mysqli_query($conn, $query);

                                        if (mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach ($query_run as $row){
                                            ?>
                                                <option 
                                                value="<?= $row['id'];?>"><?= $row['gender'];?>
                                                </option>
                                        <?php  } }  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Birth Day</label>
                                    <input type="date" name="birthDate" id="birthDate" value="<?php echo $data1['birthday']; ?>" class="form-control" required />
                                </div>
                            </div>
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <button type="submit" name="submitProfile">							
                                    <div class="flex-c-m stext-103 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Save
                                    </div>
                                </button>	
                            </div>
                        </div>
                </form>
            </div>

            <!-- My Address -->
            <div class="tab__content">
                <form action="" method="POST">
                    <input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
                    <h6 class="p-b-25">Manage your address</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Province</label>
                                    <select name="province" id="province-list" onChange="getMunicipality(this.value)" class="form-control" required>
                                        <option value disabled selected>Select province</option>
                                            <?php 
                                                $loantype = mysqli_query($conn,"SELECT * FROM province");
                                                while($rowtype = mysqli_fetch_array($loantype)){ 
                                            ?>
                                        <option value="<?php echo $rowtype['id'] ?>"><?php echo $rowtype['province'] ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Municipality</label>
                                    <select name="municipality" id="municipality-list" onchange="getBarangay(this.value)" class="form-control" required>
                                        <option value="" >Select municipality</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Barangay</label>
                                    <select name="barangay" id="barangay-list" class="form-control" required>
                                        <option value="">Select barangay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Zip Code</label>
									<input type="text" name="zipcode" value="<?= $qrygetAdd_run['zipcode']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Complete Address</label>
									<input type="text" name="sitio" value="<?= $qrygetAdd_run['sitio']; ?>"class="form-control" placeholder="Street, Building, House No." required>
                                </div>
                            </div>
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <button type="submit" name="submitAddress">							
                                    <div class="flex-c-m stext-103 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Save
                                    </div>
                                </button>	
                            </div>
                        </div>
                </form>
            </div>

            <!-- My Password -->
            <div class="tab__content">
                <form action="" method="POST" onsubmit="return validateForm()">
                    <input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
                    <h6 class="p-b-25">Change your password</h6>
                    <span id="password-error" style="color: red;"></span>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" name="currentPassword" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" name="newPassword" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" name="confirmPassword" class="form-control">
                            </div>
                        </div>
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <button type="submit" name="submitPassword">							
                                <div class="flex-c-m stext-103 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Save
                                </div>
                            </button>	
                        </div>
                    </div>
                </form>
            </div>

            <!-- Identification -->
            <div class="tab__content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
                    <h6 class="p-b-25">Upload identification</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type of ID</label>
                                    <select name="typeid" id="typeid" class="form-control" required>
                                        <option value disabled selected>Select Identification Type</option>
                                            <?php 
                                            $loantype = mysqli_query($conn,"SELECT * FROM type_id");
                                                while($rowtype = mysqli_fetch_array($loantype)){ 
                                            ?>
                                        <option value="<?php echo $rowtype['id'] ?>"><?php echo $rowtype['type_id'] ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ID Number</label>
									<input type="text" name="idnumber" class="form-control" required />
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Expiry Date</label>
									<input type="date" name="expiry_date" class="form-control" id="date_expiry" placeholder="Select Date of Expiry" />
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image ID</label>
									<input type="file" class="form-control" name="image" id="exampleInputFile" required />
                                </div>
                            </div>

                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <button type="submit" name="submitIdentification">							
                                    <div class="flex-c-m stext-103 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Save
                                    </div>
                                </button>	
                            </div>
                        </div>
                </form>
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
        document.querySelectorAll('input[type="number"]').forEach(input =>{
            input.oninput = () =>{
                if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
            }
        });
    </script>
        <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            
            if (password.length < 8) {
                document.getElementById("password-error").innerHTML = "Password must be at least 8 characters long";
                return false;
            } else if (!containsUpperCase(password) || !containsLowerCase(password) || !containsNumber(password)) {
                document.getElementById("password-error").innerHTML = "Password must contain at least one uppercase letter, one lowercase letter, and one number";
                return false;
            } else {
                document.getElementById("password-error").innerHTML = "";
                return true;
            }
        }
        
        function containsUpperCase(str) {
            return /[A-Z]/.test(str);
        }
        
        function containsLowerCase(str) {
            return /[a-z]/.test(str);
        }
        
        function containsNumber(str) {
            return /\d/.test(str);
        }
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