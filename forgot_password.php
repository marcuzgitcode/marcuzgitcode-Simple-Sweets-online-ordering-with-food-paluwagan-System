<?php
    session_start();
    require ('db.php');
    
	$msg = "";
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $code = mysqli_real_escape_string($conn, md5(rand()));
    
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE email='{$email}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE customer SET code='{$code}' WHERE email='{$email}'");
            
            if ($query) {
                $from = 'https://simplesweetkakanin.com';
                $to = $email;
                $subject = 'no reply';
                $message = 'Here is the verification link <b><a href="https://simplesweetkakanin.com/reset_password.php?reset='.$code.'">';
        
                $headers = $from;
                mail($to, $subject, $message, $headers);
                
                $msg = "<div class='alert alert-info'>We've send a verification link on your email account.</div>";   
            }
        } else {
            $msg = "<div class='alert alert-info'>This email address did not found.</div>";   
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
                        <h2>Forgot Password</h2>
                        <p>Send a verification code to change your password. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <button id="btn" name="submit" class="btn" type="submit">Send</button>
                        </form>
                        <div class="social-icons">
                            <p>Back to login! <a href="login.php">Login</a>.</p>
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

</body>

</html>