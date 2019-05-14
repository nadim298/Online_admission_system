<?php 
require_once("includes/db.php");
// code user email availablity
if(!empty($_POST["ssc_roll"]) && !empty($_POST["hsc_roll"])) {
	$ssc_roll= $_POST["ssc_roll"];
	$hsc_roll= $_POST["hsc_roll"];
	$email= $_POST["email"];
	
		$sql ="SELECT * FROM student_login_info WHERE ssc_roll='$ssc_roll' OR hsc_roll='$hsc_roll'";
        $run=mysqli_query($conn,$sql);
if(mysqli_num_rows($run)>0)
{
echo "<span style='color:yellow'> <b>Warning: </b>SSC or HSC roll already exists</span><br>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
    else{
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }

}
if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	
		$email_check_sql ="SELECT * FROM student_login_info WHERE email='$email'";
        $email_check_run=mysqli_query($conn,$email_check_sql);
if(mysqli_num_rows($email_check_run)>0)
{
echo "<span style='color:yellow'> <b>Warning: </b>Email already exists! Use another.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
    else{
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }

}



?>
