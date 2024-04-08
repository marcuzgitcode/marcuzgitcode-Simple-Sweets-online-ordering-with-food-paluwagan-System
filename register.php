<?php
    session_start();
    require ('db.php');
    
    if (isset($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); // Clear the message to avoid displaying it again
      } else {
          $flashMessage = null;
    }
    if (isset($_POST['submit'])) {
        $codex=mysqli_real_escape_string($conn,$_POST['codex']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $mname = mysqli_real_escape_string($conn, $_POST['mname']);
        $mobile = $_POST['mobile'];
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $birthday = $_POST['birthday'];
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));

        date_default_timezone_set('Asia/Manila');
        $petsa=date("Y-m-d");
        
        $eighteen_years_ago = date("Y-m-d", strtotime("-18 years"));
        
        if ($birthday <= $eighteen_years_ago) {
            if (strlen($mobile) >= 10) {
                $customersearch = mysqli_query($conn,"SELECT * FROM `customer` ORDER BY seq DESC");
                $customersearch_run=mysqli_fetch_array($customersearch);
            
            	$dateString = date('Ymd');
                $type = 'CID';
                $customerIDNumber = $customersearch_run['seq'];
            
            	if($customerIDNumber < 9999) {
                
            		$customerIDNumber = $customerIDNumber + 1;
            	  
            	  }else{
            	   $customerIDNumber = 1;
            	  } 
            	  $customerNumber = $type . '' . $dateString . '-' . $customerIDNumber;
        
                    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE email='{$email}'")) > 0) {
                        $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
                    } else {
                        if ($password === $confirm_password) {
                            $sql = "INSERT INTO customer (seq, customer_ID, firstName, lastName, middleName, mobile, email, birthday, password, terms_condition, code, date_entry) 
                            VALUES('$customerIDNumber', '$customerNumber','$fname', '$lname', '$mname','$mobile','$email','$birthday','$password', '1', '$code','$petsa')";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $from = 'simplesweetkakanin.com';
                                $to = $email;
                                $subject = 'no reply';
                                $message = 'Here is the verification link <b><a href="http://simplesweetkakanin.com/login.php?verification='.$code.'">';
                                $headers = $from;
                                mail($to, $subject, $message, $headers);
                                // $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                                $_SESSION['flash_message'] ="We've send a verification link on your email address.";
                                // header("location: login.php");
                                header("Location: login.php?" . urlencode($_SESSION['flash_message']));
                            } else {
                                // $msg = "<div class='alert alert-warning'>Something wrong went.</div>";
                                $_SESSION['flash_message'] ="Something wrong went.";
                                header("location: register.php");
                            }
                        } else {
                            // $msg = "<div class='alert alert-warning'>Password and Confirm Password do not match.</div>";
                            $_SESSION['flash_message'] ="Password and Confirm Password do not match.";
                            header("location: register.php");
                        }
                    }
            } else {
                // $msg = "<div class='alert alert-warning'>Invalid mobile number.</div>";
                $_SESSION['flash_message'] ="Invalid mobile number.";
                header("location: register.php");
            }
        } else {
            // $msg = "<div class='alert alert-warning'>You must be at least 18 years old.</div>";
            $_SESSION['flash_message'] ="You must be at least 18 years old.";
            header("location: register.php");
       }
    }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Simple Sweet Registration</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/register.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
      rel="stylesheet"/>
</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                    <a href="index.php" style="color:#fff"><span class="fa fa-close"></span></a>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image2.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>-->
                            <?php if ($flashMessage): ?>
                                <div id="flash-message" class="alert alert-info alert-dismissible fade show" role="alert">
                                    <?php echo $flashMessage; ?>
                                    </div>
                            <?php endif; ?>
                        <form action="" method="POST" onsubmit="return validateForm()">
                            <span>Last name</span>
                            <input type="text" class="name" name="lname" placeholder="Enter your last Name" required />
                            <span>First name</span>
                            <input type="text" class="name" name="fname" placeholder="Enter your First Name" required />
                            <span>Middle name</span>
                            <input type="text" class="name" name="mname" placeholder="Enter your Middle Name">
                            <span>Mobile</span><br>
                            <span style="font-size: 13px; color: red;">Input 10 digit mobile number ex. 9xxxxxxxxx</span>
                            <input type="number" class="name" name="mobile" placeholder="Enter your Mobile No." min="0" maxlength="10" minlength="10" required />
                            <span>Email</span>
                            <input type="email" class="email" name="email" placeholder="Enter your Email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required />
                            <span>Birthday</span>
                            <input type="date" class="name" name="birthday" placeholder="Enter your birthday" required />
                            <span>Password</span>
                            <input type="password" class="password" name="password" id="password" placeholder="Enter your password" required>
                            <span>Confirm password</span>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Enter your confirm password" required />
                            <div class="wrappers">
                            <?php
                                $typequery = mysqli_query($conn,"SELECT * FROM terms_condition WHERE type='Customer' OR type='Registration'");
                                $typedata = mysqli_fetch_array($typequery);
                            ?>
                                <input  type="checkbox" class="chk" name="terms" autocomplete="off" id="check"  required /> 
                                <label for="check"> I agree with the <a href="admin/terms/<?php echo $typedata['terms_condition']; ?>" target="_blank"> Terms and condition</a></label>
                            </div>
                            <span id="password-error" style="color: red;"></span>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script language="JavaScript" type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
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
</body>

</html>