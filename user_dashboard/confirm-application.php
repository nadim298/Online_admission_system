<?php

include 'includes/session.php';
$thisPage='user-dashboard';
include 'includes/head.php';
	
$total_cost=$_SESSION['total'];
$all_program_id=implode(",",$_SESSION['all_program_id']);
$all_program_name=implode(",",$_SESSION['all_program_name']);
?>

<style>


table {
  border-collapse: collapse;
  width: 50%;
}

td {
  height: 50px;
}
</style>
<body>

<div id="loading-wrapper">

<div id="loader">
</div>
</div>

<?php include 'includes/header.php';?>
<div class="container-fluid">

<div class="dashboard-wrapper">

<?php include 'includes/navbar.php';?>
<div class="top-bar clearfix">

<div class="page-title"><h4>Confirm Apply </h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<?php include 'includes/profile.php';?>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Read Details and Confirm to apply</h4>

</div>

<div class="panel-body">

<div>
<form method="post">
            <div align="center">
                <table>
                    <tr>
                        <td><strong>Date: </strong></td>
                        <td><script> document.write(new Date().toLocaleDateString());</script></td>
                    </tr>
                    <tr>
                        <td><strong>Program: </strong></td>
                        <td><input type="text" readonly="true" style ="border: none" id="program_name" name="program_name" value="<?php echo $all_program_name;?>"></td>
                    </tr>
                    <tr>
                        <td><strong>Registration Fee: </strong></td>
                        <td><input type="text" readonly="true" style ="border: none" id="registration_fee"  name="registration_fee" value="<?php echo $total_cost;?> BDT" ></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="confirm" class="btn btn-success">Confirm</button></td>
                        <td><a href="admission-form.php" class="btn btn-danger">Cancel</a></td>
                    </tr>
                </table>
            </div>
        
        </form>
        <br>
        <p style="color:red; text-align:center">You will get a registration no. after confirm. Pay registration fee with it.</p>
    
</div>
</div>
</div>
</div>
</div>

</div>
<?php include 'includes/footer.php';?>
</div>
<?php include 'includes/sidebar.php';?>
</div>
<?php include 'includes/bottom-scripts.php';?>
</body>

<!-- Mirrored from bootstrap.gallery/nexton/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Jan 2019 08:33:53 GMT -->

</html>
<?php
if(isset($_POST['confirm'])){									
					
    
                    $sql = "INSERT INTO `applied_application` (`student_hsc_roll`, `program_id`, `session_name`, `session_year`, `amount`) VALUES ('$session_hsc_roll', '$all_program_id', '$session_name', '$session_year', '$total_cost')";
    if(mysqli_query($conn, $sql)){
        $_SESSION['apply_success']=" New application apply successfully";
        header("Location:applied-application.php");
    }
    else{
        $_SESSION['apply_error']=" Failed to apply application! Try again..";
        header("Location:admission-form.php");
    }
}
                    
?>