<?php 
include 'includes/session.php';
$personal_information=+1;
include 'includes/head.php';
//display
$counter=0;
    $query="SELECT * FROM student_personal_info WHERE hsc_roll='$session_hsc_roll'";
	$run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){					
					$date_of_birth=$row['date_of_birth'];
					$mobile=$row['mobile'];
					$gender=$row['gender'];
					$father_name =$row['father_name'];
					$mother_name =$row['mother_name'];
                    $parent_mobile =$row['parent_mobile'];
					$permanent_address=$row['permanent_address'];
					$present_address=$row['present_address'];
					$religion=$row['religion'];
					$marital_status=$row['marital_status'];
                                $counter=$counter+1;
                            }
                        }
//display 
if(isset($_POST["submit"])){
					$ssc_roll=$session_ssc_roll;					
					$hsc_roll=$session_hsc_roll;					
					$date_of_birth=$_POST['date_of_birth'];
					$mobile=$_POST['mobile'];
					$gender=$_POST['gender'];
					$father_name =ucfirst(trim($_POST['father_name']));
					$mother_name =ucfirst(trim($_POST['mother_name']));
					$parent_mobile =$_POST['parent_mobile'];
					$permanent_address=$_POST['permanent_address'];
					$present_address=$_POST['present_address'];
					$religion=$_POST['religion'];
					$marital_status=$_POST['marital_status'];
					if($counter==1){
                        $sql = "UPDATE `student_personal_info` SET `date_of_birth` = '$date_of_birth', `mobile` = '$mobile', `gender` = '$gender', `father_name` = '$father_name', `mother_name` = '$mother_name', `parent_mobile` = '$parent_mobile', `permanent_address` = '$permanent_address', `present_address` = '$present_address', `religion` = '$religion', `marital_status` = '$marital_status' WHERE `student_personal_info`.`hsc_roll` = $hsc_roll";
                    }
    else{
        $sql = "INSERT INTO student_personal_info (ssc_roll,hsc_roll,date_of_birth,mobile,gender,father_name,mother_name,parent_mobile,permanent_address,present_address,religion,marital_status)
					VALUES ('$ssc_roll','$hsc_roll','$date_of_birth','$mobile','$gender','$father_name','$mother_name','$parent_mobile','$permanent_address','$present_address','$religion','$marital_status')";
    }
					
                        if(mysqli_query($conn, $sql)){
                            echo '<script language="javascript">';
                        echo 'alert("Information Updated")';
                        echo '</script>';
                header("Refresh:0");
                        }
					

					mysqli_close($conn);
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
   <?php if(isset($_SESSION['personal_info_restricted'])&& !empty($_SESSION['personal_info_restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['personal_info_restricted']);?></span>
<?php echo htmlentities($_SESSION['personal_info_restricted']="");
    }
    ?>
    </div>
</div>

<div class="main-container">


<div class="row gutter">

<?php include 'includes/profile.php';?>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Submit Your Personal Information</h4>

</div>

<div class="panel-body">

<form method="post">

<div class="form-group">

<div class="row gutter">

<div class="col-md-4">
<label class="control-label">Date of Birth</label>
<div class='input-group date' id='dateformat'>
		                    <input type="text" name="date_of_birth" class="form-control" value="<?php if($counter==1){echo $date_of_birth;}?>" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    
		                </div>
</div>

<div class="col-md-4 selectContainer">
<label class="control-label">Gender
</label>
<select class="form-control" name="gender" value="<?php if($counter==1){echo $father_name;}?>" required>

<option value="Male">Male</option>

<option value="Female">Female</option>
</select>
</div>
<div class="col-md-4">
<label class="control-label">Mobile</label>
<input type="text" class="form-control" onkeyup="numbersOnly(this)" maxlength="11" name="mobile" value="<?php if($counter==1){echo $mobile;}?>" required>
</div>

</div>
</div>


<div class="form-group">

<div class="row gutter">

<div class="col-md-4">
<label class="control-label">Father's Name</label>
<input type="text" class="form-control" onkeyup="lettersOnly(this)" name="father_name" value="<?php if($counter==1){echo $father_name;}?>" required>
</div>

<div class="col-md-4">
<label class="control-label">Mother's Name</label>
<input type="text" class="form-control" onkeyup="lettersOnly(this)" name="mother_name" value="<?php if($counter==1){echo $mother_name;}?>" >
</div>

<div class="col-md-4">
<label class="control-label">Parent's Mobile</label>
<input type="text" class="form-control" onkeyup="numbersOnly(this)" maxlength="11" name="parent_mobile" value="<?php if($counter==1){echo $parent_mobile;}?>" >
</div>
</div>
</div>

<div class="form-group">

<div class="row gutter">

<div class="col-md-6">
<label class="control-label">Permanent Address</label>
<textarea class="form-control" name="permanent_address" rows="5" required><?php if($counter==1){echo $permanent_address;}?> 
</textarea>
</div>

<div class="col-md-6">
<label class="control-label">Present Address</label>
<textarea class="form-control" name="present_address" rows="5" required><?php if($counter==1){echo $present_address;}?>
</textarea>
</div>

</div>
</div>
<div class="form-group">

<div class="row gutter">

<div class="col-md-4 selectContainer">
<label class="control-label">Religion</label>
<select class="form-control" name="religion"  >

<option value="<?php if($counter==1){echo $religion;}?>"><?php if($counter==1){echo $religion;} else{echo "Select";}?></option>
<option value="Muslim">Muslim</option>
<option value="Hindu">Hindu</option>
<option value="Chistian">Chistian</option>
<option value="Buddha">Buddha</option>
<option value="Other">Other</option>
</select>
</div>
<div class="col-md-4 selectContainer">
<label class="control-label">Marital Status</label>
<select class="form-control" name="marital_status"  >

<option value="<?php if($counter==1){echo $marital_status;}?>"><?php if($counter==1){echo $marital_status;}?></option>
<option value="Married">Married</option>
<option value="Unmarried">Unmarried</option>
</select>
</div>
</div>
</div>
<input type="submit" name="submit" class="btn btn-success" value="<?php if($counter==1){echo "Update";} else {echo "Submit";}?>"> 
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