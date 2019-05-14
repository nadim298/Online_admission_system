<?php

include 'includes/session.php';
$all_students=+1;
$thisPage='user-dashboard';
include 'includes/head.php';
	
?>
<?php  
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "UPDATE `student_login_info` SET `status` = '$status' WHERE `student_login_info`.`hsc_roll` = $id";
mysqli_query($conn,$sql);
header('location:all-students.php');
}



//code for active students
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "UPDATE `student_login_info` SET `status` = '$status' WHERE `student_login_info`.`hsc_roll` = $id";
mysqli_query($conn,$sql);
header('location:all-students.php');
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

<div class="page-title"><h4>All Students</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-md-12">

<div class="panel panel-light">



<div class="panel-body">
   
    <div class="table-responsive">
        
                                <table class="table table-striped table-bordered table-hover" id="basicExample">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>SSC Roll</th>
                                            <th>HSC Roll</th>
                                            <th>Student Name</th>
                                            <th>Email id </th>
                                            <th>Image</th>
                                            <th>Reg Date</th>
                                            <th>Personal Info</th>
                                            <th>Academic Info</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$cnt=1;                              
$sql = "SELECT * from student_login_info";
$run=mysqli_query($conn,$sql);               
                
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$ssc_roll=$row['ssc_roll'];
								$hsc_roll=$row['hsc_roll'];
								$first_name=$row['first_name'];
								$last_name=$row['last_name'];
								$email=$row['email'];
								$image=$row['image'];
								$registration_date=$row['registration_date'];
								$status=$row['status'];
    ?>                                       
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($ssc_roll);?></td>
                                            <td class="center"><?php echo htmlentities($hsc_roll);?></td>
                                            <td class="center"><?php echo $first_name." ".$last_name;?></td>
                                            <td class="center"><?php echo htmlentities($email);?></td>
                                            <td class="center"><img style="height:75px; width:75px;" src="<?php echo '../media/student_images/'.$image;?>" alt=""> </td>
                                             <td class="center"><?php echo htmlentities($registration_date);?></td>
                                             <td><input type="button" value="view" id="<?php echo $row["hsc_roll"]; ?>" class="btn btn-info btn-xs view_personal_details" /></td>
                                             <td><input type="button" value="view" id="<?php echo $row["hsc_roll"]; ?>" class="btn btn-info btn-xs view_academic_details" /></td>
                                            <td class="center"><?php if($status==1)
                                            {
                                                echo htmlentities("Active");
                                            } else {


                                            echo htmlentities("Blocked");
}
                                            ?></td>
                                            <td class="center">
<?php if($status==1)
 {?>
<a href="all-students.php?inid=<?php echo htmlentities($hsc_roll);?>" onclick="return confirm('Are you sure you want to block this student?');" >  <button class="btn btn-warning"> Inactive</button></a>
<?php } else {?>

                                                <a href="all-students.php?id=<?php echo htmlentities($hsc_roll);?>" onclick="return confirm('Are you sure you want to active this student?');"><button class="btn btn-success"> Active</button></a> 
                                            <?php } ?>
                                          
                                            </td>
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


    
    <!---personal modal-->
    <div id="dataModal_personal_details" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Personal Details</h4>  
                </div>  
                <div class="modal-body" id="personal_details">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
 
 <!---academic modal-->
    <div id="dataModal_academic_details" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Academic Details</h4>  
                </div>  
                <div class="modal-body" id="academic_details">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
 
</body>

</html>

 <script>  
 $(document).ready(function(){  
      
      $(document).on('click', '.view_personal_details', function(){  
           var hsc_roll = $(this).attr("id");  
           if(hsc_roll != '')  
           {  
                $.ajax({  
                     url:"select-personal-info.php",  
                     method:"POST",  
                     data:{hsc_roll:hsc_roll},  
                     success:function(data){  
                          $('#personal_details').html(data);  
                          $('#dataModal_personal_details').modal('show');  
                     }  
                });  
           }            
      }); 
     
     $(document).on('click', '.view_academic_details', function(){  
           var hsc_roll = $(this).attr("id");  
           if(hsc_roll != '')  
           {  
                $.ajax({  
                     url:"select-academic-info.php",  
                     method:"POST",  
                     data:{hsc_roll:hsc_roll},  
                     success:function(data){  
                          $('#academic_details').html(data);  
                          $('#dataModal_academic_details').modal('show');  
                     }  
                });  
           }            
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