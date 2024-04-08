<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->
<?php
    session_start();
    require ('db.php');

	$msg = "";
    if (isset($_GET["reset"])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE code='{$_GET['reset']}'")) > 0) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
    
                if ($password === $confirm_password) {
                    $query = mysqli_query($conn, "UPDATE customer SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");
    
                    if ($query) {
                        header("Location: login.php");
                    }
                } else {
                    $msg = "<div class='alert alert-warning'>Password and Confirm Password did not match.</div>";   
                }
            }
        } else {
            $msg = "<div class='alert alert-warning'>Reset Link did not match.</div>";  
        }
    } else {
        header("Location: reset_password.php");
    }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Simple Sweet Login</title>
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
                            <img src="images/image.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Change new password</h2>
                        <p>Change your new password to continue shoping. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post" onsubmit="return validateForm()">
                            <input type="password" class="password" name="password" id="password" placeholder="Enter Your New Password" style="margin-bottom: 2px;" required>
                            <input type="password" class="password" name="confirm_password" placeholder="Enter Confirm Password" style="margin-bottom: 2px;" required>
                            <span id="password-error" style="color: red;"></span>
                            <button id="btn" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
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