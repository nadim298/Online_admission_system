<?php 
require_once("includes/db.php");
// code user email availablity
if(!empty($_POST["program_name"])) {
	$program_name= $_POST["program_name"];
	
		$sql ="SELECT * FROM programs WHERE program_name='$program_name'";
        $run=mysqli_query($conn,$sql);
if(mysqli_num_rows($run)>0)
{
echo "<span style='color:red'> <b>Warning: </b>Program already exists</span><br>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
    else{
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }

}




?>
