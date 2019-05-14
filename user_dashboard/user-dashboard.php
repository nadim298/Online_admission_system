<?php

include 'includes/session.php';
$user_dashboard=+1;
include 'includes/head.php';
	
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

<div class="page-title"><h4>Dashboard</h4>
</div>
<div style="float:right; line-height:70px;">
   <?php if(isset($_SESSION['admission_start_restricted'])&& !empty($_SESSION['admission_start_restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['admission_start_restricted']);?></span>
<?php echo htmlentities($_SESSION['admission_start_restricted']="");
    }
    ?>
    <?php if(isset($_SESSION['hsc_year_restricted'])&& !empty($_SESSION['hsc_year_restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['hsc_year_restricted']);?></span>
<?php echo htmlentities($_SESSION['hsc_year_restricted']="");
    }
    ?>
    <?php if(isset($_SESSION['academic_update_restricted'])&& !empty($_SESSION['academic_update_restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['academic_update_restricted']);?></span>
<?php echo htmlentities($_SESSION['academic_update_restricted']="");
    }
    ?>
    <?php if(isset($_SESSION['apply_check_restricted'])&& !empty($_SESSION['apply_check_restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['apply_check_restricted']);?></span>
<?php echo htmlentities($_SESSION['apply_check_restricted']="");
    }
    ?>
    <?php if(isset($_SESSION['academic_info_updated'])&& !empty($_SESSION['academic_info_updated']))
    {?>
<span class="pull-right" style="color:green"><?php echo htmlentities($_SESSION['academic_info_updated']);?></span>
<?php echo htmlentities($_SESSION['academic_info_updated']="");
    }
    ?>
</div>

</div>

<div class="main-container">

<div class="row gutter">

<?php include 'includes/profile.php';?>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Details</h4>

    
</div>

<div class="panel-body">

<div id="area-chart3" class="chart-height3">

<table class="table borderless">
        <?php
        $query="SELECT * FROM student_personal_info WHERE ssc_roll='$session_ssc_roll'";
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
    ?>
			<tbody>
				<tr>
                    <td><b>Date Of Birth:</b></td>					
					<td><?php echo $date_of_birth;?></td>					
					<td><b>Gender:</b></td>			
					<td><?php echo $gender;?></td>			
								
				</tr>
				<tr>
                    <td><b>Father's Name:</b></td>					
					<td><?php echo $father_name;?></td>					
					<td><b>Mother's Name:</b></td>			
					<td><?php echo $mother_name;?></td>			
								
				</tr>
				<tr>
                    <td><b>Mobile:</b></td>			
					<td><?php echo $mobile;?></td>					
					<td><b>Parent's Mobile:</b></td>			
					<td><?php echo $parent_mobile;?></td>		
				</tr>
				<tr>
                    <td><b>Permanent Address:</b></td>					
					<td><?php echo $permanent_address;?></td>					
					<td><b>Present Address:</b></td>			
					<td><?php echo $permanent_address;?></td>		
				</tr>
				<tr>
                    <td><b>Religion:</b></td>					
					<td><?php echo $religion;?></td>					
					<td><b>Marital Status:</b></td>			
					<td><?php echo $marital_status;?></td>		
				</tr>
				
				
				
			</tbody>
			<?php
                            }
                        }
    else
    {
        ?>
        <tbody>
            <tr><span style="color:red;">Personal Information not been update yet!</span><a href="personal-information.php" class="btn btn-success btn-xs">Update</a></tr>
        </tbody>

   <?php
    
    }
    
    ?>
			</table>
    
</div>
</div>
</div>
</div>
</div>

<div class="row gutter">
<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
    </div>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="row gutter">

<div class="col-md-6 col-sm-6 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>SSC</h4>
</div>

<div class="panel-body">
<table class="table borderless">
        <?php
        $query="SELECT * FROM student_academic_info WHERE ssc_roll='$session_ssc_roll'";
	$run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){					
					$ssc_registration=$row['ssc_registration'];
					$ssc_group=$row['ssc_group'];
					$ssc_board=$row['ssc_board'];
					$ssc_passing_year =$row['ssc_passing_year'];
					$ssc_gpa =$row['ssc_gpa'];
    ?>
			<tbody>
				<tr>
                    <td><b>Registration No.:</b></td>					
					<td><?php echo $ssc_registration;?></td>	
				</tr>
				<tr>
                    <td><b>Group:</b></td>					
					<td><?php echo $ssc_group;?></td>
				</tr>
				<tr>
                    <td><b>Board:</b></td>			
					<td><?php echo $ssc_board;?></td>
				</tr>
				<tr>
                    <td><b>Passing Year:</b></td>					
					<td><?php echo $ssc_passing_year;?></td>		
				</tr>
				<tr>
                    <td><b>GPA:</b></td>					
					<td><?php echo $ssc_gpa;?></td>		
				</tr>
			</tbody>
			<?php
                            }
                        }
    else
    {
        ?>
        <tbody>
            <tr><a style="color:red;">SSC Information not been update yet!</a><a href="academic-details.php" class="btn btn-success btn-xs">Update</a></tr>
        </tbody>

   <?php
    
    }
    
    ?>
			</table>
   
</div>
</div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>HSC</h4>
</div>

<div class="panel-body">
<table class="table borderless">
        <?php
        $query="SELECT * FROM student_academic_info WHERE ssc_roll='$session_ssc_roll'";
	$run=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($run);
    $run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){					
					$hsc_registration=$row['hsc_registration'];
					$hsc_group=$row['hsc_group'];
					$hsc_board=$row['hsc_board'];
					$hsc_passing_year =$row['hsc_passing_year'];
					$hsc_gpa =$row['hsc_gpa'];
    ?>
			<tbody>
				<tr>
                    <td><b>Registration No.:</b></td>					
					<td><?php echo $hsc_registration;?></td>	
				</tr>
				<tr>
                    <td><b>Group:</b></td>					
					<td><?php echo $hsc_group;?></td>
				</tr>
				<tr>
                    <td><b>Board:</b></td>			
					<td><?php echo $hsc_board;?></td>
				</tr>
				<tr>
                    <td><b>Passing Year:</b></td>					
					<td><?php echo $hsc_passing_year;?></td>		
				</tr>
				<tr>
                    <td><b>GPA:</b></td>					
					<td><?php echo $hsc_gpa;?></td>		
				</tr>
			</tbody>
			<?php
                            }
                        }
    else
    {
        ?>
        <tbody>
            <tr><a style="color:red;">HSC Information not been update yet!</a><a href="academic-details.php" class="btn btn-success btn-xs">Update</a></tr>
        </tbody>

   <?php
    
    }
    
    ?>
			</table>
</div>
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