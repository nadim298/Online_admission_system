<?php

include 'includes/session.php';
$applied_application=+1;
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

<div class="page-title"><h4>Applied Application</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>All Application</h4>
</div>

<div class="panel-body">
   <label><b>Select Session to display applications</b></label>
<div class="row gutter">

<form action="" method="get">
    <div class="col-md-4">
   
<select class="form-control" name="search_session_name" required="required">
<option value="">Selsect Session</option>
<option value="Spring">Spring</option>
<option value="Summer">Summer</option>
<option value="Fall">Fall</option>
 
</select>

    </div>
    <div class="col-md-4">
   <select class="form-control" id="" name="search_session_year" required="required">
   <option value="">Selsect Year</option>
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
<table class="table table-responsive table-bordered table-striped table-hover" id="basicExample">
			<thead>
				<tr>
					<th>Registration No</th>
					<th>Program</th>
					<th>Session</th>
					<th>Registration Date</th>
					<th>Amount</th>
					<th>payment_status</th>
				</tr>
			</thead>
           <tbody>
            <?php
               if(isset($_GET['session_search'])){
        
$search_session_name=$_GET['search_session_name'];
$search_session_year=$_GET['search_session_year'];
               $query="SELECT * FROM applied_application where session_name='$search_session_name' AND session_year='$search_session_year'";
               }
               else{
                   $query="SELECT * FROM applied_application where archive=0";
               }
    
    
                $run=mysqli_query($conn,$query);
    if(mysqli_num_rows($run)>0){
        
							while($row=mysqli_fetch_array($run)){
                                $program_name=array();
								$registration_id=$row['registration_id'];
								$program_id=$row['program_id'];
                                $array_program_id = explode(",",$program_id);
                                foreach($array_program_id as $i){
                                    $program_query="SELECT program_name FROM programs WHERE program_id='$i'";
                                    $program_query_run=mysqli_query($conn,$program_query);
                                    $program_query_row=mysqli_fetch_array($program_query_run);
                                    array_push($program_name,$program_query_row['program_name']);
                                    
                                }
								$registration_date=$row['registration_date'];
								$session_name=$row['session_name'];
								$session_year=$row['session_year'];
								$amount=$row['amount'];
								$payment_status=$row['payment_status'];
    
    ?>
				
			
				<tr>
					<td><?php echo $registration_id;?></td>									
					<td><?php echo implode(",",$program_name);?></td>									
					<td><?php echo $session_name." ".$session_year;?></td>																
					<td><?php echo $registration_date;?></td>																
					<td><?php echo $amount;?></td>									
					<td><?php echo $payment_status;?></td>									
				</tr>
				
			
			
			<?php
                            }
                        }
                   
            ?>
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