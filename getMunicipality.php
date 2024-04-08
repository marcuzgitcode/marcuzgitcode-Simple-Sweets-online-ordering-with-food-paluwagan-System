<?php
	include 'db.php';
	$conn->set_charset("utf8");
	$pid=$_POST["province_id"];
	$result = mysqli_query($conn,"SELECT * FROM municipality WHERE province_ID='$pid'");
    $output='';
    
    echo '<option value disabled selected>Select municipality</option>';
    
while($row = mysqli_fetch_array($result)) {
	
    $output .='
    
        <option value='. $row['id'] . '>'. $row['municipality'] .'</option>
        ';
    }
        echo $output;
?>

