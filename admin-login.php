<?php
	include 'includes/db.php';
	ob_start();
	session_start();
	
	if(isset($_POST['submit'])){
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			
			$query="SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $run=mysqli_query($conn,$query);
            if(mysqli_num_rows($run)>0){
							$row=mysqli_fetch_array($run);
								
                $_SESSION['username']=$username;
				header('location:admin/admin-dashboard.php');
			}
			else{
				echo '<script language="javascript">';
                        echo 'alert("Invalid details!")';
                        echo '</script>';
                header("Refresh:0");
			}
			
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="shortcut icon" href="admin/img/favicon.ico">
<title>Admin Panel
</title>

<link href="admin/css/login.css" rel="stylesheet" media="screen">

<link href="admin/fonts/icomoon/icomoon.css" rel="stylesheet">

<?php include 'includes/head.php';?>
</head>

<body class="login">
<?php include 'includes/header.php'; ?> 
<form method="post" action="#">

<div id="login-wrapper">

<div id="login_header"><h2>Admin</h2>
</div>

<div class="login-user"><img src="admin/img/admin.jpg" alt="User">
</div><h5>Sign in to access to your admin control panel.</h5>

<div id="inputs">

<div class="form-block">
<input type="text" placeholder="Username" name="username"> <i class="icon-envelope"></i>
</div>

<div class="form-block">
<input type="password" id="password" placeholder="Password" name="password"> <i onclick="myFunction()" class="icon-eye2"></i>
</div>
<input type="submit" name="submit" value="Login">
</div>
</div>
</form>
<?php include 'includes/footer.php';?>
</body>

</html>
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>