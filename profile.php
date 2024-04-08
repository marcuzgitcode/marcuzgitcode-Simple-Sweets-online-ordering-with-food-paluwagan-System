<?php
session_start();
require('db.php');

	if(!isset($_SESSION['login_me'])){
		header("location: index.php");
		exit();
	}

	$myid=$_SESSION['login_me'];
	$qryget=mysqli_query($conn,"SELECT * FROM customer WHERE id='$myid'");
	if(mysqli_num_rows($qryget) > 0){
		$data1 = mysqli_fetch_assoc($qryget);
	}

	$qrygetAdd=mysqli_query($conn,"SELECT * FROM customer_address WHERE customer_ID='$data1[customer_ID]'");
	$qrygetAdd_run = mysqli_fetch_assoc($qrygetAdd);

	$num_per_page=10;
	if(isset($_GET["pages"])){
		$pages=$_GET["pages"];
	}else{
		$pages=1;
	}
	$start_from=($pages-1)*10;
	$sql = "SELECT * FROM notif WHERE customer_ID='$data1[customer_ID]' LIMIT $start_from, $num_per_page";
	$rs_result = mysqli_query($conn,$sql);

	$msg='';
	if (isset($_POST['submitProfile'])) {
		$code=$_POST['codex'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthDate'];
	
		if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE customer_ID='{$code}'")) > 0) {
			$qrysave="UPDATE customer SET firstName='$firstName', lastName='$lastName', email='$email', mobile='$mobile', sex='$gender', birthday='$birthday' WHERE customer_ID='$code'";
			$result=@mysqli_query($conn,$qrysave);
			if ($result){
				$msg='<div class="alert alert-primary alert-dismissible fade show" role="alert">Success</div>';
			
			}else{
				die("Query Failed!");
			}
		}else{
			// header("location: profile.php?#account");
	
		}
	}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <title>Simple Sweets | Cakes & Kakanin</title>
    <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="css/menu.css">
    <!-- <link rel="stylesheet" href="assets/css/notification.css"> -->
    <link rel="shortcut icon" href="images/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
	<link rel="stylesheet" type="text/css" href="css/profile.css">

</head>
    
    <body>
        <a id="button">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </a>
    <!-- ***** Preloader Start ***** -->
    <!-- <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>   -->
    <!-- ***** Preloader End ***** -->
    
    <!-- ***** Header Area Start ***** -->
    <header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="maindex.php" class="logo">
						<img src="images/icons/logo.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
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
									echo '<img src="images/'.$data1['image'].'" alt="Profile" class="user-pic" id="img">';
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
							echo '<img src="images/'.$data1['image'].'" alt="Profile" class="user-pic" id="img">';
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
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						<a href="#" class="trans-04">simplesweet@gmail.com</a>
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							My Account
						</a>
			
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li  class="active-menu">
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
					<input class="plh3" type="text" name="menu" placeholder="Search..." value="<?php if(isset($_GET['menu'])){ echo $_GET['menu'];} ?>" required>
				</form>
			</div>
		</div>
	</header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <section class="py-5 my-5">
		<div class="container mt-3">
			<!-- <h1 class="mb-5">Account Settings</h1> -->
			<div class="bg-white d-block d-sm-flex">
				<div class="profile-tab-nav">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<?php
								if($data1['image'] == ''){
									echo '<img src="assets/images/default.png" alt="Image" class="shadow">';
								}else{
									echo '<img src="assets/images/'.$data1['image'].'" alt="Image" class="shadow">';
								}
							?>
							<!-- <img src="img/user2.jpg" alt="Image" class="shadow"> -->
						</div>
						<h6 class="text-center"><strong><?= $data1['firstName'].' '.$data1['lastName']; ?></strong></h6>
					</div>
					<div class="navs flex-columns nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-links actives" id="account-tab" data-toggle="pills" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-user text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-links" id="address-tab" data-toggle="pills" href="#address" role="tab" aria-controls="address" aria-selected="false">
							<i class="fa fa-map-marker text-center mr-1"></i> 
							Address
						</a>
						<a class="nav-links" id="password-tab" data-toggle="pills" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Change Password
						</a>
						<a class="nav-links" id="notification-tab" data-toggle="pills" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
							<i class="fa fa-bell-o text-center mr-1"></i> 
							Notification
						</a>
					</div>
				</div>
				
				<div class="tab-contents shadow rounded-lg p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-panes fades shows actives" id="account" role="tabpanel" aria-labelledby="account-tab">
						<form action="" method="POST">
							<input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
							<h6 class=""><strong>My Profile</strong></h6>
							<p class="mb-3">Manage your account</p>
							<?php echo $msg; ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="firstName" class="form-control" value="<?= $data1['firstName']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="lastName" class="form-control" value="<?= $data1['lastName']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control" value="<?= $data1['email']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Mobile number</label>
										<input type="text" name="mobile" class="form-control" value="<?= $data1['mobile']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Gender</label>
										<select class="form-control" name="gender" id="gender" value>
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
								<div class="col-md-6">
									<div class="form-group">
										<label>Birth Day</label>
										<input type="date" name="birthDate" id="birthDate" value="<?php echo $data1['birthday']; ?>" class="form-control"/>
									</div>
								</div>
							</div>
							<div>
								<button type="submit" name="submitProfile" class="btn btn-primarys">Save</button>
							</div>
						</form>
					</div>
					<div class="tab-panes fades shows" id="address" role="tabpanel" aria-labelledby="address-tab">
						<form action="profile_address_update.php" method="POST">
							<input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
							<h6 class=""><strong>Address</strong></h6>
							<p class="mb-3">Manage your address</p>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Province</label>
										<select name="province" id="province-list" onChange="getMunicipality(this.value)" class="form-control" required>
											<option value disabled selected>Select Province</option>
												<?php 

													$loantype = mysqli_query($conn,"SELECT * FROM province");
													while($rowtype = mysqli_fetch_array($loantype)){ 
												?>
											<option value="<?php echo $rowtype['id'] ?>"><?php echo $rowtype['province'] ?></option>
												<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Municipality</label>
										<select name="municipality" id="municipality-list" onchange="getBarangay(this.value)" class="form-control" required>
										<option value="" >Select Municipality</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Barangay</label>
										<select name="barangay" id="barangay-list" class="form-control" required>
											<option value="">Select Barangay</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Zip Code</label>
										<input type="text" name="zipcode" value="<?= $qrygetAdd_run['zipcode']; ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Complete Address</label>
										<input type="text" name="sitio" value="<?= $qrygetAdd_run['sitio']; ?>"class="form-control" placeholder="Street, Building, House No." required>
									</div>
								</div>
							</div>
							<div>
								<button type="submit" name="submitAddress" class="btn btn-primarys">Save</button>
							</div>
						</form>
					</div>
					<div class="tab-panes fades shows" id="password" role="tabpanel" aria-labelledby="password-tab">
						<form action="profile_change_password.php" method="POST">
							<input type="hidden" name="codex" value="<?= $data1['customer_ID']; ?>">
							<h6 class=""><strong>Password</strong></h6>
							<p class="mb-3">Change your password</p>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Old password</label>
										<input type="password" name="currentPassword" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>New password</label>
										<input type="password" name="newPassword" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Confirm new password</label>
										<input type="password" name="confirmPassword" class="form-control">
									</div>
								</div>
							</div>
							<div>
								<button type="submit" name="submitPassword" class="btn btn-primarys">Save</button>
							</div>
						</form>
					</div>

					<div class="tab-panes fades" id="notification" role="tabpanel" aria-labelledby="notification-tab">
					<section class="notification" id="notification">
						<h6 class="mb-3"><strong>Notification</strong></h6>
						<!-- <p class="mb-3"></p> -->
						<div class="row">
							<!-- <div class="cart__container"> -->
								<table class="content-table">
									<thead>
										<tr>
											<th>Notification</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
											<?php
												while($result=mysqli_fetch_array($rs_result)){
											?>	
											<tr class="active-row">
												<td><?php echo $result['description']; ?></td>
												<td><?php echo $result['date']; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php
									$sql = "SELECT * FROM notif";
									$rs_result = mysqli_query($conn, $sql);
									$total_records = mysqli_num_rows($rs_result);
									$tota_pages = ceil($total_records/$num_per_page);

								?>
								<div class="pignation">
									<!--<button class='btn1'><img src="images/arrow.png">prev</button>-->
									<ul>
										<?php for ($i=1;$i<=$tota_pages;$i++){ ?>
										<li class="link"><a href='profile.php?pages=<?php echo $i; ?>'><?php echo $i; ?></a></li>
										<?php } ?>
									</ul>
									<!--<button class='btn2'>next<img src="images/arrow.png"></button>-->
								</div>
							<!-- </div> -->
						</div>
					</section>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- ***** Map Area Ends ***** -->
    
    <!-- ***** Footer Start ***** -->
    <?php include 'footer.php' ?>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <!-- <script src="assets/js/popper.js"></script> -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap.min.profile.js"></script>

    <!-- Plugins -->
    <script src="js/owl-carousel.js"></script>
    <script src="js/accordions.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/scrollreveal.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imgfix.min.js"></script> 
    <script src="js/slick.js"></script> 
    <script src="js/lightbox.js"></script> 
    <script src="js/isotope.js"></script> 
    
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadesTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadesOut();
            setTimeout(function() {
              $("."+selectedClass).fadesIn();
              $("#portfolio").fadesTo(50, 1);
            }, 500);
                
            });
        });

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script type="text/javascript">
    
        var btn = $('#button');

        $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('shows');
        } else {
            btn.removeClass('shows');
        }
        });

        btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
        });
            
    </script> 
    <!-- <script>
   let circle = document.querySelector(".color-option");

   circle.addEventListener("click", (e)=>{
     let target = e.target;
     if(target.classList.contains("circle")){
       circle.querySelector(".actives").classList.remove("actives");
       target.classList.add("actives");
       document.querySelector(".main-images .actives").classList.remove("actives");
       document.querySelector(`.main-images .${target.id}`).classList.add("actives");
     }
   });

  </script> -->
  <script type = "text/javascript">
        $(document).ready(function(){
            function load_unseen_notification(view = '')
            {
                $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{view:view},
                    dataType:"json",
                    success:function(data)
                    {
                    $('#dropdown-menu').html(data.notification);
                    if(data.unseen_notification > 0){
                    $('.count').html(data.unseen_notification);
                    
                    }
                    }
                });
            }

            $(document).on('click', '#dropdown-menu', function(){
            $('.count').html('');
            load_unseen_notification('yes');
            });
        
            setInterval(function(){ 
                load_unseen_notification();; 
            }, 1000);
        
        });
        </script>
  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
  </script>
    <script>
    let subNotif = document.getElementById("subNotif");

    function toggleMenus(){
        subNotif.classList.toggle("open-menu");
    }
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

		function getMunicipalityup(val) {
			$.ajax({
			url: "getMunicipality_update.php",
			type: "POST",
			data: 'province_idup='+val,
			success: function(data){
			$("#municipality-listup").html(data);
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

		function getBarangayup(val) {
			$.ajax({
			url: "getBarangay_update.php",
			type: "POST",
			data: 'municipality_idup='+val,
			success: function(data){
			$("#barangay-listup").html(data);
		//   $("#barangay-listup").html(data);`
				}
			});
		};
	</script>
  </body>
</html>