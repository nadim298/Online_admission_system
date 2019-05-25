<?php
session_start();
$this_page="reg_form";
?>
       <!-- registration -->
        <?php
			include 'includes/db.php';
						 if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
				
				}
				
				if(isset($_POST['submit'])){
					$ssc_roll=$_POST['ssc_roll'];					
					$hsc_roll=$_POST['hsc_roll'];					
					$first_name=ucfirst(trim($_POST['first_name']));					
					$last_name=ucfirst(trim($_POST['last_name']));
					$email=$_POST['email'];
					$password=md5($_POST['password']);
					
					$sql = "INSERT INTO student_login_info (ssc_roll,hsc_roll,first_name,last_name,email,password,registration_date)
					VALUES ('$ssc_roll','$hsc_roll','$first_name','$last_name','$email','$password', now())";
					
					if (mysqli_query($conn, $sql)) {
						
						echo '<script language="javascript">';
                        echo 'alert("Registration Succesfull. Log in to your account!")';
                        echo '</script>';
                header("Refresh:0");
					}
					
					else {
						echo "<script>alert('Failed. Try again..');</script>";
					}

					mysqli_close($conn);
				}
				
		?>
		<!-- registration -->
		
		<!-- sign in -->
		<?php
	include 'includes/db.php';
	if(!$conn){
		echo ("Error connection: ".mysqli_connect_error());
	}
	
	if(isset($_POST['sign-in'])){
			$ssc_roll=$_POST['ssc_roll'];
			$hsc_roll=$_POST['hsc_roll'];
			$password=md5($_POST['password']);
			
			$query=mysqli_query($conn,"SELECT * FROM student_login_info WHERE ssc_roll='$ssc_roll' AND hsc_roll='$hsc_roll' AND password='$password'");
			
			
			if(mysqli_fetch_array($query)){
				header('location:user_dashboard/user-dashboard.php');
				$_SESSION['ssc_roll']=$ssc_roll;
				$_SESSION['hsc_roll']=$hsc_roll;
			}
			else{
				echo '<script language="javascript">';
                        echo 'alert("Invalid details!")';
                        echo '</script>';
			}
			
		}
?>
		<!-- sign in -->
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php include 'includes/head.php';?>
    
        <script>
function lettersOnly(input) {
    var regex = /[^a-z ]/gi;
    input.value = input.value.replace(regex, "");
}
            function numbersOnly(input) {
    var regex = /[^0-9]/gi;
    input.value = input.value.replace(regex, "");
}
            
            
</script>    
</head>
<body class="form-v10">
<?php include 'includes/header.php';?>
	<div class="page-content">
		<div class="form-v10-content">
			<div class="form-detail" action="#" method="post" id="myform">
				<div class="form-left">
				<form method="post" enctype="multipart/form-data">
					<h2>LOGIN</h2>
					<div class="form-row">
						<input type="text" name="ssc_roll"  placeholder="SSC Roll.." onkeyup="numbersOnly(this)" maxlength="6" value="<?php if(isset($_POST['ssc_roll'])){echo $_POST['ssc_roll'];}?>" required>
					</div>
					<div class="form-row">
						<input type="text" name="hsc_roll"  placeholder="HSC Roll.." onkeyup="numbersOnly(this)" maxlength="6" value="<?php if(isset($_POST['hsc_roll'])){echo $_POST['hsc_roll'];}?>" required>
					</div>
					<div class="form-row">
						<input type="password" name="password" placeholder="Password.." required>
					</div>
					   <div class="form-row-last">
						<input type="submit" name="sign-in" class="register" value="Login">
					</div>
                    </form>
				</div>
				
				<div class="form-right">
				<form method="post" enctype="multipart/form-data">
					<h2>Registration Form</h2>
					<div class="form-row">
						<input type="text" name="ssc_roll" id="ssc_roll"  placeholder="SSC Roll.." onchange="checkAvailability()" onkeyup="numbersOnly(this)" maxlength="6" required>
					</div>
					<div class="form-row">
						<input type="text" name="hsc_roll" id="hsc_roll"  placeholder="HSC Roll.." onchange="checkAvailability()" onkeyup="numbersOnly(this)" maxlength="6" required>
					</div>
					<div class="form-row">
					
					<div class="row">
					    <div class="col-md-6">
					    <input type="text" name="first_name"  placeholder="First name.." onkeyup="lettersOnly(this)" required>
					</div>
					<div class="col-md-6">
					    <input type="text" name="last_name"  placeholder="Last name.." onkeyup="lettersOnly(this)" required>
					</div>
					    
					</div>
						
						
					</div>
					<div class="form-row">
						<input type="text" name="email" id="email" onchange="checkAvailability()"  placeholder="Email Address.." required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
					</div>
					
					
					<div class="form-row">
						<input placeholder="Password.." title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="password" onchange="
          this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
          if(this.checkValidity()) form.confirm_password.pattern = this.value;
        ">
					</div>
					
					<div class="form-row">
						<input  placeholder="Re-enter Password.." title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="confirm_password" onchange="
          this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
        ">
					</div>
					<div class="form-checkbox">
						<label class="container"><p>I do accept the <a href="#" class="text">Terms and Conditions</a> of your site.</p>
						  	<input type="checkbox" name="checkbox">
						  	<span class="checkmark"></span>
						</label>
					</div>
					
					<div class="form-row-last">
						<input type="submit" name="submit" id="submit" class="register" value="Register">
						<div class="pull-right" style="margin-right:45px;padding-top:10px;">
						    <span id="roll_email_availability_status" style="font-size:12px;color:yellow;margin-left:10px;"></span>
						</div>
					</div>
                   <div class="form-row">
						
						
					</div>
                    </form>
				</div>
			</div>
		</div>
	</div>
	<?php include 'includes/footer.php';?>
</body>
</html>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_roll_email_availability.php",
data:{ssc_roll: $("#ssc_roll").val(), hsc_roll: $("#hsc_roll").val(), email: $("#email").val()},
type: "POST",
success:function(data){
$("#roll_email_availability_status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script> 