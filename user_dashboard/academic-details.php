<?php 
include 'includes/session.php';
$academic_details=+1;
if($personal_info_checker==0){
    $_SESSION['restricted']="Sorry.. Update Your Personal info first";
    header("Location:personal-information.php");
}
if($academic_info_checker==1){
    $_SESSION['academic_update_restricted']="Sorry.. You cant edit academic details";
    header("Location:user-dashboard.php");
}

include 'includes/head.php';

if(isset($_POST['submit'])){
					$ssc_roll=$session_ssc_roll;				
					$ssc_registration=$_POST['ssc_registration'];
					$ssc_group=$_POST['ssc_group'];
					$ssc_board=$_POST['ssc_board'];
					$ssc_passing_year =$_POST['ssc_passing_year'];
					$ssc_gpa =$_POST['ssc_gpa'];
                    
                    $hsc_roll=$session_hsc_roll;					
					$hsc_registration=$_POST['hsc_registration'];
					$hsc_group=$_POST['hsc_group'];
					$hsc_board=$_POST['hsc_board'];
					$hsc_passing_year =$_POST['hsc_passing_year'];
					$hsc_gpa =$_POST['hsc_gpa'];
					
					$sql = "INSERT INTO student_academic_info (ssc_roll,ssc_registration,ssc_group,ssc_board,ssc_passing_year,ssc_gpa,hsc_roll,hsc_registration,hsc_group,hsc_board,hsc_passing_year,hsc_gpa)
					VALUES ('$ssc_roll','$ssc_registration','$ssc_group','$ssc_board','$ssc_passing_year','$ssc_gpa','$hsc_roll','$hsc_registration','$hsc_group','$hsc_board','$hsc_passing_year','$hsc_gpa')";
					
					if (mysqli_query($conn, $sql)) {
						
						$_SESSION['academic_info_updated']="Your Academic info updated Successfully!";
                header("location:user-dashboard.php");
					}
					
					else {
						echo '<script language="javascript">';
                        echo 'alert("Failed. Try again..")';
                        echo '</script>';
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

<div class="page-title"><h4>Academic Details</h4>
</div>
<div style="float:right; line-height:70px;">
   <?php if(isset($_SESSION['academic_restricted'])&& !empty($_SESSION['academic_restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['academic_restricted']);?></span>
<?php echo htmlentities($_SESSION['academic_restricted']="");
    }
    ?>
    </div>
</div>

<div class="main-container">


<div class="row gutter">

<?php include 'includes/profile.php';?>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">


<div class="panel-heading"><h4>Please Fill Up All</h4>
</div>

<div class="panel-body">

<form id="movieForm" method="post">

<div class="row">
<!---Ssc--->
<div class="form-group col-md-6">
<h3>SSC</h3>
        <div >
        <label class="control-label">Registration No.</label>
        <input type="text" class="form-control" onkeyup="numbersOnly(this)" name="ssc_registration" required>
        </div>
        <div >
        <label class="control-label">Group</label>
            <select class="form-control"  name="ssc_group" required>
                <option value="Science">Science</option>
                <option value="Business Studies">Business Studies</option>
                <option value="Arts">Arts</option>
            </select>
        </div>
        <div >
        <label class="control-label">Board</label>
        <select class="form-control"  name="ssc_board" required>
                <option value="Dhaka">Dhaka</option>
                <option value="Rajshahi">Rajshahi</option>
                <option value="Comilla">Comilla</option>
                <option value="Jessore">Jessore</option>
                <option value="Chittagong">Chittagong</option>
                <option value="Barisal">Barisal</option>
                <option value="Sylhet">Sylhet</option>
            </select>
        </div>
        <div >
        <label class="control-label">Passing year</label>
        <select class="form-control"  name="ssc_passing_year" required>
   <?php
        $end= 1900;
        $start = date("Y");
       for( $year = $start ; $year >=$end; $year--){
          echo "<option value='$year'>$year</option>";
        }
       ?>
   </select>
        </div>
       
        <div >
        <label class="control-label">GPA</label>
        <input type="text" class="form-control" pattern="[0-5][.][0-9][0-9]" title="Write GPA within 5.00" name="ssc_gpa" required>
        </div>
    
</div>

<!---Hsc--->
<div class="form-group col-md-6">
<h3>HSC</h3>
        <div >
        <label class="control-label">Registration No.</label>
        <input type="text" class="form-control" onkeyup="numbersOnly(this)" name="hsc_registration" required>
        </div>
        <div >
        <label class="control-label">Group</label>
        <select class="form-control"  name="hsc_group" required>
                <option value="Science">Science</option>
                <option value="Business Studies">Business Studies</option>
                <option value="Arts">Arts</option>
            </select>
        </div>
        <div >
        <label class="control-label">Board</label>
        <select class="form-control"  name="hsc_board" required>
                <option value="Dhaka">Dhaka</option>
                <option value="Rajshahi">Rajshahi</option>
                <option value="Comilla">Comilla</option>
                <option value="Jessore">Jessore</option>
                <option value="Chittagong">Chittagong</option>
                <option value="Barisal">Barisal</option>
                <option value="Sylhet">Sylhet</option>
            </select>
        </div>
        <div >
        <label class="control-label">Passing year</label>
        <select class="form-control"  name="hsc_passing_year" required>
   <?php
        $end= 1900;
        $start = date("Y");
       for( $year = $start ; $year >=$end; $year--){
          echo "<option value='$year'>$year</option>";
        }
       ?>
   </select>
        </div>
       
        <div >
        <label class="control-label">GPA</label>
        <input type="text" class="form-control" pattern="[0-5][.][0-9][0-9]" title="Write GPA within 5.00" name="hsc_gpa" required>
        </div>
</div>
</div>

<input type="submit" name="submit" class="btn btn-default" value="Submit">
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