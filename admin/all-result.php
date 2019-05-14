<?php

include 'includes/session.php';
$all_result=+1;
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

<div class="page-title"><h4>All Results</h4>
</div>
<div style="float:right; line-height:70px;">
   <?php if(isset($_SESSION['upload_result'])&& !empty($_SESSION['upload_result']))
    {?>
<span class="pull-right" style="color:green"><?php echo htmlentities($_SESSION['upload_result']);?></span>
<?php echo htmlentities($_SESSION['upload_result']="");
    }?>
   
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Results</h4>
</div>

<div class="panel-body">
   <label><b>Select Session to display applications</b></label>
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
<table class="table table-responsive table-bordered table-striped table-hover" id="basicExample">
			<thead>
				<tr>
					<th>#</th>
					<th>Student's Hsc Roll</th>
					<th>Session</th>
					<th>English</th>
					<th>Math</th>
					<th>General Knowlegde</th>
					<th>Total</th>
					<th>Position</th>
					<th>Merit/Waiting</th>
					<th>Pass/Fail</th>
				</tr>
			</thead>
           <tbody>
            <?php
               $count=1;
               if(isset($_GET['session_search'])){
        
$search_session_name=$_GET['search_session_name'];
$search_session_year=$_GET['search_session_year'];
               $query="SELECT * FROM applied_application where session_name='$search_session_name' AND session_year='$search_session_year'";
               }
               else{
                   $query="SELECT * FROM result ORDER BY id";
               }
    
    $program_name=array();
                $run=mysqli_query($conn,$query);
    if(mysqli_num_rows($run)>0){
        
							while($row=mysqli_fetch_array($run)){
    
    ?>
				
			
				<tr>
					<td><?php echo $count;?></td>										
					<td><?php echo $row['hsc_roll'];?></td>										
					<td><?php echo $row['session'];?></td>										
					<td><?php echo $row['english'];?></td>										
					<td><?php echo $row['math'];?></td>										
					<td><?php echo $row['gk'];?></td>										
					<td><?php echo $row['total'];?></td>										
					<td><?php echo $row['position'];?></td>										
					<td><?php if($row['position']>0 && $row['position']<4){echo "M";} else if($row['position']>4){  echo "W";  } ?></td>										
					<td><?php if($row['status']==1){echo "<p style='background-color:green; text-align:center; color:white;'>Passed</p>";} else{echo "<p style='background-color:red; text-align:center; color:white;'>Failed</p>";}?></td>										
													
				</tr>
				
			
			
			<?php
                                $count++;
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