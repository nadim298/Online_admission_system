<?php

include 'includes/session.php';
$generate_admit=+1;
$thisPage='user-dashboard';
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

<div class="page-title"><h4>Admit Card</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Select Criteria</h4>
</div>

<div class="panel-body">


<form role="form" action="insert-admit.php" method="post" enctype="multipart/form-data">





<div class="form-group">
<label>Program<span style="color:red;">*</span></label>
<select class="form-control" name="program_id" required>
<option value=""> Select Program</option>
<?php 

$sql = "SELECT * from  programs ";
$run=mysqli_query($conn,$sql);
    if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$program_id=$row['program_id'];
								$program_name=$row['program_name'];
    ?>  
<option value="<?php echo htmlentities($program_id);?>"><?php echo htmlentities($program_name);?></option>
 <?php }} ?> 
</select>
</div>

<div class="form-group">
<label>Exam Date<span style="color:red;">*</span></label>
<div class='input-group date' id='dateformat'>
		                    <input type="text" name="exam_date" class="form-control" required >
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    
		                </div>
</div>
<div class="form-group">
<label class="control-label">Exam Time</label>
<input type="time" class="form-control"  name="exam_time">
</div>

<div class="form-group">
<label>Select Session<span style="color:red;">*</span></label><span id="session-availability-status" style="font-size:12px;"></span>
<div class="row gutter">

<div class="col-md-6">
   
<select class="form-control" name="session_name" id="session_name" onchange="checkAvailability()" required>
<option value="">--Select Session--</option>
<option value="Spring">Spring</option>
<option value="Summer">Summer</option>
<option value="Fall">Fall</option>
 
</select>

    </div>
    <div class="col-md-6">
   <select class="form-control"  name="session_year" id="session_year" onchange="checkAvailability()"  required>
   
    <option value="">--Select Year--</option>
   <?php
        $end= 1900;
        $start = date("Y");
       for( $year = $start ; $year >=$end; $year--){
          echo "<option value='$year'>$year</option>";
        }
       ?>
   </select>
    </div>
    </div>
    </div>
    
    <div class="form-group">
<label class="control-label">Venue</label>
<input type="text" class="form-control" onkeyup="lettersOnly(this)" name="venue">
</div>

<button type="submit" name="generate" class="btn btn-info" id="submit">Generate</button>

</form>
</div>
</div>
</div>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Generated Admit Card</h4>
<?php if(isset($_SESSION['msg'])&& !empty($_SESSION['msg']))
    {?>
<span class="pull-right" style="color:green"><?php echo htmlentities($_SESSION['msg']);?></span>
<?php echo htmlentities($_SESSION['msg']="");
    }
    ?>
    <?php if(isset($_SESSION['error'])&& !empty($_SESSION['error']))
    {?>
<span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['error']);?></span>
<?php echo htmlentities($_SESSION['error']="");
    }
    ?>
</div>

<div class="panel-body">

    <label><b>Select Session to display generated admit card</b></label>
<div class="row gutter">

<form action="" method="get">
    <div class="col-md-4">
   
<select class="form-control" name="search_session_name" required="required">
<option value="Spring">Spring</option>
<option value="Summer">Summer</option>
<option value="Fall">Fall</option>
 
</select>

    </div>
    <div class="col-md-4">
   <select class="form-control" id="" name="search_session_year" required="required">
   <?php
        $end= 1900;
        $start = date("Y");
       for( $year = $start ; $year >=$end; $year--){
          echo "<option value='$year'>$year</option>";
        }
       ?>
   
   </select>
    </div>
    <div class="col-md-4">
<button type="submit" name="session_search" class="btn btn-info">View</button>
   
    </div>
</form>
    </div>
    <br>
    
        
                                <table class="table table-striped table-bordered table-hover" id="basicExample">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Registration ID</th>
                                            <th>HSC Roll</th>
                                            <th>Program</th>
                                            <th>Session</th>
                                            <th>Exam Date</th>
                                            <th>Venue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
    if(isset($_GET['session_search'])||isset($_GET['search_session_name'])){
        
$search_session_name=$_GET['search_session_name'];
$search_session_year=$_GET['search_session_year'];
    
$cnt=1;                              
$sql = "SELECT * from admit_card WHERE session_name='$search_session_name' AND session_year='$search_session_year'";
$run=mysqli_query($conn,$sql);               
                
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$registration_id=$row['registration_id'];
								$student_hsc_roll=$row['student_hsc_roll'];
								$program_id=$row['program_id'];
                                $program_query="SELECT program_name FROM programs WHERE program_id='$program_id'";
                                    $program_query_run=mysqli_query($conn,$program_query);
                                    $program_query_row=mysqli_fetch_array($program_query_run);
                                $program_name=$program_query_row['program_name'];
                                $session_name=$row['session_name'];
                                $session_year=$row['session_year'];
								$exam_date=$row['exam_date'];
								$venue=$row['venue'];
    ?>                                       
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($registration_id);?></td>
                                            <td class="center"><?php echo htmlentities($student_hsc_roll);?></td>
                                            <td class="center"><?php echo htmlentities($program_name);?></td>
                                            <td class="center"><?php echo htmlentities($session_name.' '.$session_year);?></td>
                                             <td class="center"><?php echo htmlentities($exam_date);?></td>
                                             <td class="center"><?php echo htmlentities($venue);?></td>
                                        </tr>
 <?php $cnt=$cnt+1;}}} ?>                                      
                                    </tbody>
                                </table>
    


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
	<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:{session_year: $("#session_year").val(), session_name: $("#session_name").val()},
type: "POST",
success:function(data){
$("#session-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script> 
	
</html>



<script src="js/datatables/dataTables.min.js">
</script>
<script src="js/datatables/dataTables.bootstrap.min.js">
</script>
<script src="js/datatables/dataTables.tableTools.js">
</script>
<script src="js/datatables/autoFill.min.js">
</script>
<script src="js/datatables/autoFill.bootstrap.min.js">
</script>
<script src="js/datatables/fixedHeader.min.js">
</script>
<script src="js/datatables/buttons.min.js">
</script>
<script src="js/datatables/flash.min.js">
</script>
<script src="js/datatables/jszip.min.js">
</script>
<script src="js/datatables/pdfmake.min.js">
</script>
<script src="js/datatables/vfs_fonts.js">
</script>
<script src="js/datatables/html5.min.js">
</script>
<script src="js/datatables/buttons.print.min.js">
</script>
<script src="js/datatables/custom-datatables.js">
</script>