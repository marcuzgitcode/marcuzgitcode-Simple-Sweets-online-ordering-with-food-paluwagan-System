<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->
<?php
    session_start();
    require ('db.php');
    // if (isset($_SESSION['login_me'])) {
    //     header("Location: maindex.php");
    //     die();
    // }

    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE customer SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: login.php");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM customer WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (empty($row['code'])) {
                $_SESSION['login_me'] = $row['id'];
                header("Location: maindex.php");
            } else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
        }
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
                        <h2>Login Now</h2>
                        <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>-->
                        <?php echo $msg; ?>
                        <form action="" method="post" onsubmit="return validateForm()">
                            <span>Email</span>
                            <input type="email" class="email" name="email" placeholder="Enter your email" required>
                            <span>Password</span>
                            <input type="password" class="password" name="password" id="password" placeholder="Enter your password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot_password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
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
            } else {
                document.getElementById("password-error").innerHTML = "";
                return true;
            }
        }
    </script>

</body>

</html>