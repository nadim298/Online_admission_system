<?php 
include 'includes/session.php';
$admission=+1;
$present_year = date("Y");
$admission_notice_query="SELECT * FROM admission_notices WHERE end_date >=now() and start_date<=now()";
	$admission_notice_run=mysqli_query($conn,$admission_notice_query);

$apply_check_query="select * from applied_application where session_name in(select session_name from admission_notices) AND session_year in(select session_year from admission_notices) AND student_hsc_roll='$session_hsc_roll'";
$apply_check_run=mysqli_query($conn,$apply_check_query);

$hsc_year_difference_query="select * from terms_and_condition where id='1'";
	
	$hsc_year_difference_run=mysqli_query($conn,$hsc_year_difference_query);
	$hsc_year_difference_row=mysqli_fetch_array($hsc_year_difference_run);
					$hsc_year_difference=$hsc_year_difference_row['hsc_year_difference'];
						
if(!mysqli_num_rows($admission_notice_run)>0){
                            $_SESSION['admission_start_restricted']="Admission does not start yet!";
                            header("Location:user-dashboard.php");
                        }

     else if($personal_info_checker==0){
    $_SESSION['personal_info_restricted']="Sorry.. Update Your Personal info first";
    header("Location:personal-information.php");
    }
     else if($academic_info_checker==0){
    $_SESSION['academic_restricted']="Sorry.. Update Your Academic info first";
    header("Location:academic-details.php");
    }
     else if(mysqli_num_rows($apply_check_run)>0){
        $_SESSION['apply_check_restricted']="You have already apply! You cant apply twice. Try in next session.";
    header("Location:user-dashboard.php");
    }
   




else if(isset($hsc_passing_year)){
    if(($present_year-$hsc_passing_year)>$hsc_year_difference){
    $_SESSION['hsc_year_restricted']="You cant apply because of your HSC passing year!";
    header("Location:user-dashboard.php");
}
}



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

<div class="page-title"><h4>Apply</h4>
</div>

</div>

<div class="main-container">


<div class="row gutter">

<?php include 'includes/profile.php';?>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Select Department
<?php if(isset($_SESSION['restricted'])&& !empty($_SESSION['restricted']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['restricted']);?></span>
<?php echo htmlentities($_SESSION['restricted']="");
    }
    ?>
<?php if(isset($_SESSION['apply_error'])&& !empty($_SESSION['apply_error']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['apply_error']);?></span>
<?php echo htmlentities($_SESSION['apply_error']="");
    }
    ?>
</h4>
</div>

<div class="panel-body">
   <div class="col-md-6">
       
				<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th></th>
					<th>Eligible Department</th>
					<th>Registration Fee</th>
				</tr>
			</thead>
			<tbody>
			<?php
                $query="SELECT * FROM student_academic_info WHERE hsc_roll='$session_hsc_roll'";
	$run=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($run);
					$hsc_group=$row['hsc_group'];
					$hsc_gpa=$row['hsc_gpa'];
                
                $query="SELECT * FROM programs WHERE required_group like '%$hsc_group%' AND required_gpa<=$hsc_gpa";
    $run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$program_id=$row['program_id'];
								$program=$row['program_name'];
								$registration_fee=$row['registration_fee'];
    ?>
				<tr>
					<td><input type="checkbox" class="checkbox" name="checkbox" value="<?php echo $program_id;?>" id="<?php echo $program_id;?>"></td>
					<td><?php echo $program;?></td>					
					<td ><?php echo $registration_fee;?></td>				
				</tr>
				<?php
                            }
                        }
                ?>
			</tbody>
			</table>
			
   </div>
   
                        
    <div class="col-md-6">
        <table id="userTable" class="table table-borderless table-hover">
            <thead >
                <tr>
                    <th > <center> Program</center></th>
                    <th ><center>Cost</center></th>                   
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
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




<!-- Modal -->
<!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Read details & confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <form method="post">
            <p> <strong>Date: </strong> <script> document.write(new Date().toLocaleDateString());</script></p>
            <input type="text" hidden="true" style ="border: none" id="program_id" name="program_id" />
            
            <p> <strong>Program: </strong> <input type="text" readonly="true" style ="border: none" id="program_name" name="program_name" value="<?php echo $_SESSION['all_program'];?>"> </p>
            <p> <strong>Registration Fee: </strong> <input type="text" readonly="true" style ="border: none" id="registration_fee"  name="registration_fee" > </p>
        <h3 style="color:green; text-align: center;">  Token: <input type="text" readonly="true" style ="border: none" id="token" name="token"/>  </h3>
        <p style="color:red; text-align: center;"> <strong>Pay registration fee by bkash with counter no. 1 and token no. as reference </strong></p>

       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="confirm" class="btn btn-success">Confirm</button>
        
        </form>
        

      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
$(document).on('click', '.apply', function(){  
    var registration_fee =;
      
                    $('#registration_fee').val(registration_fee);
                    $('#exampleModal').modal('show'); 
      });
        $('#exampleModal').on('hide.bs.modal', function () {
   $('#exampleModal').removeData();
})
        
    });
</script>-->

    
	<script type="text/javascript">
        $(document).ready(function () {
            $('input[name="checkbox"]').click(function () {
                getSelectedCheckBoxes('checkbox');
            });

            var getSelectedCheckBoxes = function (groupName) {
                var result = $('input[name="' + groupName + '"]:checked');
                
                if (result.length > 0) {
                    var resultString =[];
                    var tr_str="";
                    result.each(function () {
                        resultString.push($(this).val());
                    });
                    $.ajax({  
                url:"fetch-program.php",  
                type:"GET",  
                data:{program_id:resultString},  
                
                success:function(data){ 
                    $("#userTable tbody").html(data);
                }  
           }); 

                }
                else {
                    $("#userTable tbody").html("No checkbox checked");
                }
            };
            
        });
    </script>
</html>