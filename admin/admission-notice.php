<?php

include 'includes/session.php';
$notice=+1;
$thisPage='user-dashboard';
include 'includes/head.php';
	
?>
<?php
			if(isset($_GET["delete_id"])){
				$delete_id=$_GET["delete_id"];
                if($_SESSION['username']=='Admin'){
                    $delete_query="DELETE FROM admission_notices WHERE id = '$delete_id'";
				if(mysqli_query($conn,$delete_query)){
                    echo '<script language="javascript">';
                        echo 'alert("Successfully deleted")';
                        echo '</script>'; 
                        header("Refresh:0; url=admission-notice.php"); 
                }
                else{
                    echo '<script language="javascript">';
                        echo 'alert("Failed. Try again..")';
                        echo '</script>'; 
                        header("Refresh:0; url=admission-notice.php");
                }
                    
                }
				
			}
		?>
<?php
if(isset($_POST["update"])){
    
    $notice_id=$_POST["notice_id"];
    $start_date=$_POST["start_date"];
    $end_date=$_POST["end_date"];    
    $session_name=$_POST["session_name"];
    $session_year=$_POST["session_year"];
    
    $sql = "UPDATE `admission_notices` SET `start_date` = '$start_date', `end_date` = '$end_date', `session_name` = '$session_name', `session_year` = '$session_year', `notice_date` = now() WHERE `admission_notices`.`id` = $notice_id";

    if(mysqli_query($conn,$sql)){
        
                    echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0; url=admission-notice.php");   
                }
                else
                    echo '<script language="javascript">';
                        echo 'alert("Failed. Try again..")';
                        echo '</script>'; 
                        header("Refresh:0; url=admission-notice.php");
                }
				

?>
<?php
if(isset($_POST["publish"])){
    
    $start_date=$_POST["start_date"];
    $end_date=$_POST["end_date"];
    
    $session_name=$_POST["session_name"];
    $session_year=$_POST["session_year"];
    
    $sql = "INSERT INTO `admission_notices` (`start_date`, `end_date`, `session_name`, `session_year`, `notice_date`) VALUES ('$start_date', '$end_date', '$session_name', '$session_year', now())";

    if(mysqli_query($conn,$sql)){
        $archive_application_sql = "UPDATE `applied_application` SET `archive` = '1'";
        mysqli_query($conn,$archive_application_sql);
                    $notice_add="New admission notice has been published";   
                }
                else
                    $notice_error="Failed To published!";
                }
				

?>
<?php  
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "UPDATE `admission_notices` SET `status` = '$status' WHERE `admission_notices`.`id` = $id";
if(mysqli_query($conn,$sql)){
    $notice_draft="The notice has been drafted";
    header('location:admission-notice.php');
}
    
}



//code for active students
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "UPDATE `admission_notices` SET `status` = '$status' WHERE `admission_notices`.`id` = $id";
if(mysqli_query($conn,$sql)){
    
    header('location:admission-notice.php');
    $notice_publish="The notice has been published";
}
}

?>
<style>


table {
  border-collapse: collapse;
  width: 100%;
}

td {
  height: 50px;
    padding-left: 10px;
}
</style>
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

<div class="page-title"><h4>Admission Start/End Notices</h4>

</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-md-8">

<div class="panel panel-light">

<div class="panel-heading"><h4>Published Notices</h4>
<?php
        if(isset($notice_add)){
            echo "<span style='color:green;' class='pull-right'>$notice_add</span>";
        }
        if(isset($notice_error)){
            echo "<span style='color:red;' class='pull-right'>$notice_error</span>";
        }
        ?>
</div>

<div class="panel-body">

    <div class="table-responsive">
        
                                <table class="table table-striped table-bordered table-hover" id="basicExample">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Session</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$cnt=1;                              
$sql = "SELECT * from admission_notices";
$run=mysqli_query($conn,$sql);               
                
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$id=$row['id'];
								$start_date=$row['start_date'];
								$end_date=$row['end_date'];
								$session_name=$row['session_name'];
								$session_year=$row['session_year'];
								$status=$row['status'];
    ?>                                       
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($start_date);?></td>
                                            <td class="center"><?php echo htmlentities($end_date);?></td>
                                            <td class="center"><?php echo $session_name." ".$session_year;?></td>
                                            <td class="center"><?php if($status==1)
                                            {
                                                echo htmlentities("Published");
                                            } else {


                                            echo htmlentities("Draft");
}
                                            ?></td>
                                            <td class="center">
<?php if($status==1)
 {?>
<a href="admission-notice.php?inid=<?php echo htmlentities($id);?>" onclick="return confirm('Are you sure you want to darft this notice?');" >  <button class="btn btn-warning">Draft</button></a>
<?php } else {?>

                                                <a href="admission-notice.php?id=<?php echo htmlentities($id);?>" onclick="return confirm('Are you sure you want to active this student?');"><button class="btn btn-success">Publish</button></a> 
                                            <?php } ?>
                                          
                                            </td>
                                            <td><button type="button" class="btn btn-primary edit_data" id="<?php echo $id;?>" >Edit</button></td>					
					<td><a href="admission-notice.php?delete_id=<?php echo $id;?>" class="btn btn-block btn-danger" onclick="return confirm('Are you sure you want to delete this notice?');">Delete</a></td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                                
    </div>

</div>
</div>
</div>

<div class="col-md-4">

<div class="panel panel-light">

<div class="panel-heading"><h4>Add New Notice</h4>
</div>

<div class="panel-body">

<form method="post">
       
                <table>
                    <tr>
                        <td><strong>Admission start from: </strong></td>
                        <td>
                            <div class='input-group date dateformat' >
		                    <input type="text" name="start_date" class="form-control" required >
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    
		                    </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>End On: </strong></td>
                        <td>
                            <div class='input-group date dateformat' id=''>
		                    <input type="text" name="end_date" class="form-control" required >
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    
		                    </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>For Session: </strong></td>
                        <td>
                            
                            <div >

                            <select class="form-control" name="session_name" required>
                            <option value="">--Select Session--</option>
                            <option value="Spring">Spring</option>
                            <option value="Summer">Summer</option>
                            <option value="Fall">Fall</option>

                            </select>

                                </div>
                                <div >
                           <select class="form-control"  name="session_year" required>

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
                        </td>

                    </tr>
                    <tr>
                        <td><button type="submit" name="publish" class="btn btn-success">Publish</button></td>
                    </tr>
                </table>
        
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Program's Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form method="post">
       <input type="hidden" class="form-control" name="notice_id" id="notice_id">
                <table>
                    <tr>
                        <td><strong>Admission start from: </strong></td>
                        <td>
                            <div class='input-group date dateformat' >
		                    <input type="text" name="start_date" id="start_date" class="form-control" required >
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    
		                    </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>End On: </strong></td>
                        <td>
                            <div class='input-group date dateformat' id=''>
		                    <input type="text" name="end_date" id="end_date" class="form-control" required >
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    
		                    </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>For Session: </strong></td>
                        <td>
                            
                            <div class="">

                            <select class="form-control" name="session_name" id="session_name" required>
                                <option value="Spring">Spring</option>
                                <option value="Summer">Summer</option>
                                <option value="Fall">Fall</option>

                            </select>

                                </div>
                        </td>
                        <td>
                            
                            <div class="">
                           <select class="form-control"  name="session_year" id="session_year"  required>
                            
                            
                           <?php
                                $end= 1900;
                                $start = date("Y");
                               for( $year = $start ; $year >=$end; $year--){
                                  echo "<option value='$year'>$year</option>";
                                }
                               ?>
                           </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="update" class="btn btn-success">Update</button></td>
                    </tr>
                </table>
        
</form>
      </div>
    </div>
  </div>
</div>
</body>

</html>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
	    $(function () {
	        $('.dateformat').datepicker({
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
    $(document).ready(function(){
$(document).on('click', '.edit_data', function(){  
           var notice_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch-admission-notice.php",  
                method:"POST",  
                data:{notice_id:notice_id},  
                dataType:"json",  
                success:function(data){  
                     $('#notice_id').val(data.id);  
                     $('#start_date').val(data.start_date);  
                     $('#end_date').val(data.end_date);  
                     $('#session_name').val(data.session_name);  
                     $('#session_year').val(data.session_year);
                    $('#exampleModal').modal('show');
                }  
           });  
      }); 
    });
</script>

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
 