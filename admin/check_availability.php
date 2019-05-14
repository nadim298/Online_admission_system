<?php 
require_once("includes/db.php");
// code user email availablity
if(!empty($_POST["session_year"]) && !empty($_POST["session_name"])) {
	$session_year= $_POST["session_year"];
	$session_name= $_POST["session_name"];
	
		$sql ="SELECT * FROM admit_card WHERE session_year='$session_year' AND session_name='$session_name'";
        $run=mysqli_query($conn,$sql);
if(mysqli_num_rows($run)>0)
{
echo "<span style='color:red'> Session already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Session available for generate .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}

}


?>
