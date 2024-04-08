<?php
    session_start();
    require('db.php');

    if (!isset($_SESSION['login_me']) || trim($_SESSION['login_me'] == '')) {
        header("Location: login.php");
        die();
    }

    if (isset($_POST['submit'])) {
        $paluwagan=$_POST['codex'];
        $customer=$_POST['code'];
        $date=$_POST['date_pickup'];

        $month = date('m-Y', strtotime($date));
        date_default_timezone_set('Asia/Manila');
        $petsa=date("Y-m-d");

        if (mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM paluwagan_member WHERE paluwagan_ID='$paluwagan' AND month='$month'"))){
            $_SESSION['status']="This month is taken by other customer";
            $_SESSION['status_code']="warning";
            header("location: paluwagan-detail_main.php?aid=$paluwagan");
            exit();
        }
        
        if (mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM paluwagan_member WHERE customer_ID='$customer' AND balance !='0'"))){
            $_SESSION['status']="You have an active or pending paluwagan.";
            $_SESSION['status_code']="warning";
            header("location: paluwagan-detail_main.php?aid=$paluwagan");
            exit();
        }
        
        
        $membersearch = mysqli_query($conn,"SELECT * FROM `paluwagan_member` ORDER BY seq DESC");
        $membersearch_run=mysqli_fetch_array($membersearch);

        $dateString = date('Ymd');
        $type = 'PMID';
        $memberIDNumber = $membersearch_run['seq'];

        if($memberIDNumber < 9999) {
        
            $memberIDNumber = $memberIDNumber + 1;
        
        }else{
        $memberIDNumber = 1;
        } 
        $menuNumber = $type . '' . $dateString . '-' . $memberIDNumber;

        $query_pal=mysqli_query($conn,"SELECT * FROM paluwagan WHERE paluwagan_ID='$paluwagan'");
        $query_pal_run=mysqli_fetch_array($query_pal);

        $balance = $query_pal_run['price'];

        // $watcher=mysqli_query($conn,"SELECT * FROM paluwagan_member WHERE paluwagan_ID='$paluwagan'");
        // $counter=mysqli_num_rows($watcher);
        
        // if($counter<=0){
            $sql = "INSERT INTO paluwagan_member(seq, paluwagan_member_id, paluwagan_ID, customer_ID, date_pickup, month, status, balance, terms_condition, date_entry) 
            VALUES('$memberIDNumber', '$menuNumber', '$paluwagan', '$customer', '$date', '$month', '0', '$balance', '1', '$petsa')";
            $qry_run = mysqli_query($conn, $sql);

                if($qry_run){
                    header("Location: thankyou_paluwagan.php");
                }else{
                    die("Could not insert");
                }
            // }else{
            //     $_SESSION['status']="This month is already taken or maybe you have an active or pending paluwagan.";
            //     $_SESSION['status_code']="warning";
            //     header("Location: paluwagan-detail_main.php?aid=$paluwagan");
            // }
        }else {
            header("Location: thankyou_paluwagan.php");
    }

?>