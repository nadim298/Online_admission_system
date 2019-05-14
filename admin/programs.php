<?php

include 'includes/session.php';
$programs=+1;
include 'includes/head.php';
	
?>

<?php
if(isset($_POST["update"])){
    
    $program_id=$_GET["program_id"];
    $program_name=$_POST["program_name"];
    $values=$_POST["required_group"];
    $required_group=implode(",",$values);
    $required_gpa=$_POST["required_gpa"];
    $registration_fee=$_POST["registration_fee"];
    $sql = "UPDATE `programs` SET `program_name` = '$program_name', `required_gpa` = '$required_gpa', `required_group` = '$required_group', `registration_fee` = '$registration_fee' WHERE `programs`.`program_id` = $program_id";

    if(mysqli_query($conn,$sql)){
        
                    echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0; url=programs.php");  
                }
                else
                    $update_error="Failed To Updated Program. Try again..";
                }
				

?>
<?php
if(isset($_POST["submit"])){
    $program_name=$_POST["program_name"];
    
    $values=$_POST["required_group"];
    $required_group=implode(",",$values);
    
    $required_gpa=$_POST["required_gpa"];
    $registration_fee=$_POST["registration_fee"];
    
    $sql = "INSERT INTO `programs` (`program_name`, `required_group`, `required_gpa`, `registration_fee`) VALUES ('$program_name', '$required_group', '$required_gpa', '$registration_fee');";

    if(mysqli_query($conn,$sql)){
                    $add_msg="Succesfully Added Program";
                }
                else
                    $add_error="Failed To Add Program";
                }
				

?>
<?php
			if(isset($_GET['delete_id'])){
				$delete_id=$_GET['delete_id'];
                if($_SESSION['username']=='Admin'){
                    $delete_query="DELETE FROM `programs` WHERE `programs`.`program_id` = $delete_id";
				if(mysqli_query($conn,$delete_query)){
                       echo '<script language="javascript">';
                        echo 'alert("Successfully deleted")';
                        echo '</script>'; 
                        header("Refresh:0; url=programs.php"); 
                }
                else
                    $delete_error="Failed Deleted Program";
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

<div class="page-title"><h4>Programs</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-md-8">

<div class="panel panel-light">

<div class="panel-heading"><h4>All Programs</h4>
<?php
        if(isset($add_msg)){
            echo "<span style='color:green;' class='pull-right'>$add_msg</span>";
        }
         if(isset($add_error)){
            echo "<span> style='color:red;' class='pull-right'>$add_error</span>";
        }
    if(isset($update_error)){
            echo "<span> style='color:red;' class='pull-right'>$add_error</span>";
        }
    
        ?>
</div>

<div class="panel-body">
        
        
    
				<table class="table table-bordered table-striped table-hover" id="basicExample">
			       <thead>
				<tr>
					<th>Programs</th>
					<th>Required Group</th>
					<th>Required GPA</th>
					<th>Registration Fee</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php                
                $query="SELECT * FROM programs";
                $run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$program_id=$row['program_id'];
								$program=$row['program_name'];
								$required_group=$row['required_group'];
								$required_gpa=$row['required_gpa'];
								$registration_fee=$row['registration_fee'];
    ?>    

        
				<tr>
					<td><?php echo $program;?></td>					
					<td><?php echo $required_group;?></td>					
					<td><?php echo $required_gpa;?></td>					
					<td>BDT <?php echo $registration_fee;?></td>					
					<td><a class="btn btn-primary" href="programs.php?program_id=<?php echo $program_id;?>" >Edit</a></td>					
					<td><a href="programs.php?delete_id=<?php echo $program_id;?>" class="btn btn-block btn-danger" onclick="return confirm('Are you sure you want to delete this program?');">Delete</a></td>					
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

<div class="col-md-4">

<div class="panel panel-light">

<div class="panel-heading"><h4><?php if(isset($_GET["program_id"])){echo "Update Program";} else {echo "Add New Programs";}?></h4>
</div>

<div class="panel-body">
        
        <?php
    if(isset($_GET["program_id"])){
        $program_id=$_GET["program_id"];
        $query="SELECT * FROM programs where program_id=$program_id";
                $run=mysqli_query($conn,$query);
         
      $row = mysqli_fetch_array($run);
        $groups=$row['required_group'];
        $splited_grp=explode(",",$groups);
        $counter=1;
        
    }
    ?>
<form method="post">
        <div >
        <label class="control-label">Program Name:</label>
        <span id="program_name_availability_status" class="pull-right" style="font-size:12px;"></span>
        <input type="text" class="form-control" name="program_name" id="program_name" onchange="checkAvailability()" value="<?php if(isset($_GET["program_id"])){echo $row['program_name'];}?>" required>
        
        </div><br>
        <div >
        <label class="control-label">Required Group:</label> <br> 
        <input type="checkbox" name="required_group[]" value="Science"
        <?php
               if(isset($_GET["program_id"])){
        if(in_array("Science",$splited_grp))
        {
            echo "checked";
        }
               }
               ?>
        >Science<br/> <br> 
        <input type="checkbox" name="required_group[]" value="Business Studies"
        <?php
               if(isset($_GET["program_id"])){
        if(in_array("Business Studies",$splited_grp))
        {
            echo "checked";
        }
               }
               ?>
        >Business Studies<br /> <br>
        <input type="checkbox" name="required_group[]" value="Arts"
        <?php 
               if(isset($_GET["program_id"])){
        if(in_array("Arts",$splited_grp))
        {
            echo "checked";
        }
               }
               ?>
        >Arts<br />
        </div><br>
        <div >
        <label class="control-label">Required GPA:</label><br>
        <input type="text" class="form-control" name="required_gpa" value="<?php if(isset($_GET["program_id"])){echo $row['required_gpa'];}?>" required>
        </div><br>   
        <div >
        <label class="control-label">Registration Fee:</label>
        <input type="text" class="form-control" name="registration_fee" value="<?php if(isset($_GET["program_id"])){echo $row['registration_fee'];}?>" required>
        </div>
        <br>

<button type="submit" id="submit" name="<?php if(isset($_GET["program_id"])){echo "update";} else {echo "submit";}?>" class="btn btn-success"><?php if(isset($_GET["program_id"])){echo "update";} else {echo "submit";}?></button>
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

 <!--
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
        <div >
        
        <input type="hidden" class="form-control" name="program_id" id="program_id">
        
        <label class="control-label">Program Name:</label>        
        <input type="text" class="form-control" name="program_name" id="program_name">
        </div><br>
        <div >
        
        <input type="hidden" class="form-control" name="required_group" id="required_group">
        
        <br>
        <label class="control-label">Required Group:</label> <br>
        <input type="checkbox" name="required_group[]" value="Science">Science<br/> <br> 
        <input type="checkbox" name="required_group[]" value="Business Studies">Business Studies<br /> <br>
        <input type="checkbox" name="required_group[]" value="Arts">Arts<br />
        </div><br>
        <div >
        <label class="control-label">Required GPA:</label><br>
        <input type="text" class="form-control" name="required_gpa" id="required_gpa">
        </div><br>   
        <div >
        <label class="control-label">Registration Fee:</label>
        <input type="text" class="form-control" name="registration_fee" id="registration_fee">
        </div>
        <br>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="update"   class="btn btn-primary">Save changes</button>
</form>
      </div>
    </div>
  </div>
</div>-->


<!--<script>
    $(document).ready(function(){
$(document).on('click', '.edit_data', function(){  
           var program_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch-program.php",  
                method:"POST",  
                data:{program_id:program_id},  
                dataType:"json",  
                success:function(data){  
                     $('#program_name').val(data.program_name);  
                     $('#required_gpa').val(data.required_gpa);  
                     $('#registration_fee').val(data.registration_fee);  
                     $('#required_group').val(data.required_group);  
                     $('#program_id').val(data.program_id);
                    $('#exampleModal').modal('show');
                }  
           });  
      }); 
    });
</script>-->
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_program_availability.php",
data:{program_name: $("#program_name").val()},
type: "POST",
success:function(data){
$("#program_name_availability_status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
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

