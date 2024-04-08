<?php
session_start();
require('db.php');

$myid=$_SESSION['login_me'];
$qryget=mysqli_query($conn,"SELECT * FROM mycart WHERE buyer_ID='$myid'");
$data1 = mysqli_num_rows($qryget);

?>