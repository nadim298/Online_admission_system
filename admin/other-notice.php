<?php

include 'includes/session.php';
$notice=+1;
$thisPage='user-dashboard';
include 'includes/head.php';
	
?>
<?php
			if(isset($_GET['delete_id'])){
				$delete_id=$_GET['delete_id'];
                if($_SESSION['username']=='Admin'){
                    $delete_query="DELETE FROM `other_notice` WHERE `other_notice`.`id` = $delete_id";
				if(mysqli_query($conn,$delete_query)){
                    echo '<script language="javascript">';
                        echo 'alert("Successfully deleted")';
                        echo '</script>'; 
                        header("Refresh:0; url=other-notice.php#all_other_notice");   
                }
                else
                    $delete_error="Failed Deleted Program";
                }
				
			}
		?>
<?php
if(isset($_POST["update"])){
    $notice_id=$_POST["notice_id"];
    $title=$_POST["title"];
    $details=$_POST["details"];
    
    $sql = "UPDATE `other_notice` SET `title` = '$title', `details` = '$details', `date` = now() WHERE `other_notice`.`id` = $notice_id";

    if(mysqli_query($conn,$sql)){
                    echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0; url=other-notice.php#all_other_notice");   
                }
                else
                    $update_error="Failed To Updated Notice";
                }
				

?>
<?php
if(isset($_POST["publish"])){
    
    $title=$_POST["title"];
    $details=$_POST["details"];
    
    $sql = "INSERT INTO `other_notice` (`title`, `details`, `date`) VALUES ('$title', '$details', now())";

    if(mysqli_query($conn,$sql)){
                    $notice_add="New notice has been published";   
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
$sql = "UPDATE `other_notice` SET `status` = '$status' WHERE `other_notice`.`id` = $id";
if(mysqli_query($conn,$sql)){
    echo '<script language="javascript">';
                        echo 'alert("The notice has been drafted")';
                        echo '</script>'; 
                        header("Refresh:0; url=other-notice.php#all_other_notice");
}
    
}



//code for active students
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "UPDATE `other_notice` SET `status` = '$status' WHERE `other_notice`.`id` = $id";
if(mysqli_query($conn,$sql)){
    echo '<script language="javascript">';
                        echo 'alert("The notice has been published")';
                        echo '</script>'; 
                        header("Refresh:0; url=other-notice.php#all_other_notice");
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

<div  class="page-title"><h4>Other Notices</h4>

</div>


</div>

<div class="main-container">
<div class="row gutter">

<div class="col-md-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Add New Notice</h4>

</div>

<div class="panel-body">
<form method="post">
       
                <table>
                   <tr>
                        <td><strong>Notice Title: </strong></td>
                        <td>
                            <input type="text" name="title" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Details: </strong></td>
                        <td>
                            <textarea name="details" id="" cols="30" rows="5" class="form-control" required></textarea>
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
<div class="row gutter">

<div class="col-md-12">

<div class="panel panel-light">

<div id="all_other_notice" class="panel-heading"><h4>Published Notices</h4>
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
                                            <th>Notice Title</th>
                                            <th>Details</th>
                                            <th>Published Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$cnt=1;                              
$sql = "SELECT * from other_notice";
$run=mysqli_query($conn,$sql);               
                
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$id=$row['id'];
								$title=$row['title'];
								$details=$row['details'];
								$date=$row['date'];
								$status=$row['status'];
    ?>                                       
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($title);?></td>
                                            <td class="center"><?php echo htmlentities($details);?></td>
                                            <td class="center"><?php echo htmlentities($date);?></td>
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
<a href="other-notice.php?inid=<?php echo htmlentities($id);?>" onclick="return confirm('Are you sure you want to darft this notice?');" >  <button class="btn btn-warning">Draft</button></a>
<?php } else {?>

                                                <a href="other-notice.php?id=<?php echo htmlentities($id);?>" onclick="return confirm('Are you sure you want to active this student?');"><button class="btn btn-success">Publish</button></a> 
                                            <?php } ?>
                                          
                                            </td>
                                            <td><button type="button" class="btn btn-primary edit_data" id="<?php echo $id;?>" >Edit</button></td>					
					<td><a href="other-notice.php?delete_id=<?php echo $id;?>" class="btn btn-block btn-danger">Delete</a></td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
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
                        <td><strong>Notice Title: </strong></td>
                        <td>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Details: </strong></td>
                        <td>
                            <textarea name="details" id="details" cols="30" rows="5" class="form-control" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="update" class="btn btn-success">Publish</button></td>
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
                url:"fetch-other-notice.php",  
                method:"POST",  
                data:{notice_id:notice_id},  
                dataType:"json",  
                success:function(data){  
                     $('#notice_id').val(data.id);  
                     $('#title').val(data.title);  
                     $('#details').val(data.details);
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
 