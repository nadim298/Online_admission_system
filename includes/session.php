<?php
	require_once('db.php');
	ob_start();
	session_start();
	if(!isset($_SESSION['ssc_roll'])){
		header("location:../reg-form.php");
	}


?>