<?php 
include 'includes/session.php';
$thisPage='personal-information';
include 'includes/head.php';
//display

?>
<?php

if(isset($_POST["update"])){
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];
    
    if(!empty($_FILES['image']['name'])){
        $sql = "UPDATE `student_login_info` SET `first_name` = '$first_name', `last_name` = '$last_name', `image` = '$image' WHERE `student_login_info`.`hsc_roll` = $session_hsc_roll";        
        if (mysqli_query($conn, $sql)) {
						$path="../media/student_images/$image";
						if(move_uploaded_file($image_tmp,$path)){
							copy($path,"$path");
                            echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0");
						}
					}
                else
                {
                    echo '<script language="javascript">';
                        echo 'alert("Failed!")';
                        echo '</script>'; 
                        header("Refresh:0");
                }
    }
    else
    {
        $sql = "UPDATE `student_login_info` SET `first_name` = '$first_name', `last_name` = '$last_name' WHERE `student_login_info`.`hsc_roll` = $session_hsc_roll";
        if (mysqli_query($conn, $sql)) {
                            echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0");
						}
					
                else
                {
                    echo '<script language="javascript">';
                        echo 'alert("Failed!")';
                        echo '</script>'; 
                        header("Refresh:0");
                }
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

<div class="page-title"><h4>Personal Information</h4>
</div>
<div style="float:right; line-height:70px;">
   <?php if(isset($_SESSION['image_restricted'])&& !empty($_SESSION['image_restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['image_restricted']);?></span>
<?php echo htmlentities($_SESSION['image_restricted']="");
    }
    ?>
</div>
</div>

<div class="main-container">


<div class="row gutter">

<?php include 'includes/profile.php';?>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Edit Full Name & Photo</h4>
</div>

<div class="panel-body">

<form method="post" enctype="multipart/form-data">


<div class="form-group">

<div class="row gutter">

<div class="col-md-6">
<label class="control-label">First Name</label>
<input type="text" class="form-control" onkeyup="lettersOnly(this)" name="first_name" value="<?php echo $session_first_name;?>" >
</div>

<div class="col-md-6">
<label class="control-label">Last Name</label>
<input type="text" class="form-control" onkeyup="lettersOnly(this)" name="last_name" value="<?php echo $session_last_name;?>" >
</div>


</div>
</div>
<div class="form-group">

<div class="row gutter">

<div class="col-md-6">
<label class="control-label">Image</label>
<input type="file" class="form-control" name="image" onchange="checkPhoto(this)">
</div>
<div class="col-md-6">
    <img id="image_preview" style="height:100px; width:100px;" src="" alt="">
    <p style="color:red;" id="image_error"></p>
</div>
</div>
</div>

<button type="submit" name="update" id="update" class="btn btn-success">Update</button>
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
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script >
	    $(function () {
	        $('#dateformat').datepicker({
	            format: "yyyy-mm-dd",
	            autoclose: true,
	            todayHighlight: true,
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        autoclose: true,
		        changeMonth: true,
		        changeYear: true,
		        orientation: "button"
	        });
	    });
	</script>

</html>
<script>
function checkPhoto(target) {
    if(target.files[0].size > 204800) {
        document.getElementById("image_error").innerHTML = "Image too big (max 100kb)";
        $('#update').prop('disabled',true);
        return false;
        
    }
    else{
        var reader =new FileReader();
    reader.onload=function(){
        var output=document.getElementById("image_preview");
        output.src=reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
        document.getElementById("image_error").innerHTML = "";
        $('#update').prop('disabled',false);
    }
    
}
</script>