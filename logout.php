
<?php
    session_start();
    unset($_SESSION["login_me"]);
    unset($_SESSION["email"]);
    header("Location:index.php");
?>