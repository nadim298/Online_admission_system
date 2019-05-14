<?php

include 'includes/session.php';
$thisPage='user-dashboard';
include 'includes/head.php';
	
?>

<?php

if(isset($_POST["change"])){
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT * FROM student_login_info WHERE hsc_roll='$session_hsc_roll' AND password='$password'";
$run=mysqli_query($conn,$sql);
    
if(mysqli_num_rows($run)>0)
{
$change_query="UPDATE `student_login_info` SET `password` = '$newpassword' WHERE `student_login_info`.`hsc_roll` = $session_hsc_roll";
mysqli_query($conn,$change_query);
$_SESSION['success_msg']="Your password is successfully changed";
}
else {
$_SESSION['failed_msg']="Failed to change your password! Try again..";  
}
}

?>

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

<div class="page-title"><h4>Setting</h4>
</div>

<div style="float:right; line-height:70px;">
   <?php if(isset($_SESSION['success_msg'])&& !empty($_SESSION['success_msg']))
    {?>
<span class="pull-right" style="color:green"><?php echo htmlentities($_SESSION['success_msg']);?></span>
<?php echo htmlentities($_SESSION['success_msg']="");
    }
    ?>
    <?php if(isset($_SESSION['failed_msg'])&& !empty($_SESSION['failed_msg']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['failed_msg']);?></span>
<?php echo htmlentities($_SESSION['failed_msg']="");
    }
    ?>
    
</div>

</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">

<div class="panel panel-light">

								<div class="panel-heading">
									<h4>Change Password</h4>
								</div>
								<div class="panel-body">
<form role="form" method="post" onSubmit="return valid();" name="chngpwd">

<div class="form-group">
<label>Current Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="newpassword" autocomplete="off" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"   />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off"  required />
</div>

 <button type="submit" name="change" class="btn btn-info">Chnage </button> 
</form>

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

</html>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>