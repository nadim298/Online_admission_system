<?php
	require_once('db.php');
	ob_start();
	session_start();
	if(!isset($_SESSION['ssc_roll'])){
		header("location:../index.php");
	}
else{
    $session_ssc_roll=$_SESSION['ssc_roll'];
	$session_hsc_roll=$_SESSION['hsc_roll'];
	$query="SELECT * FROM student_login_info WHERE ssc_roll='$session_ssc_roll'";
	$run=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($run);
					$session_first_name=$row['first_name'];
					$session_last_name=$row['last_name'];
					$session_image=$row['image'];
					$session_status=$row['status'];
if($session_status==0){
    session_destroy();
    header("location:error.html");
}

$personal_info_checker=0;
//personal info check
$personal_info_check_query="SELECT * FROM student_personal_info WHERE hsc_roll='$session_hsc_roll'";
$personal_info_check_run=mysqli_query($conn,$personal_info_check_query);
if(mysqli_fetch_array($personal_info_check_run)){
    $personal_info_checker=$personal_info_checker+1;
}
//personal info check

//acaemic info check
$academic_info_checker=0;
$academic_info_check_query="SELECT * FROM student_academic_info WHERE hsc_roll='$session_hsc_roll'";
$academic_info_check_run=mysqli_query($conn,$academic_info_check_query);
if($academic_info_row=mysqli_fetch_array($academic_info_check_run)){
    $hsc_passing_year=$academic_info_row['hsc_passing_year'];
    $academic_info_checker=$academic_info_checker+1;
}
}
	
//acaemic info check
$user_dashboard=0;
$personal_information=0;
$academic_details=0;
$admission=0;
?>