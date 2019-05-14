
<div class="right-sidebar">

<div class="panel panel-blue">

<div class="panel-heading"><h5>Notices</h5>
</div>
</div>
<?php 
    
    $admission_notice_query="SELECT * FROM admission_notices WHERE end_date >=now() and status=1 ";
	$admission_notice_run=mysqli_query($conn,$admission_notice_query);
						if(mysqli_num_rows($admission_notice_run)>0){
							while($admission_notice_row=mysqli_fetch_array($admission_notice_run)){
                                $admission_notice_id=$admission_notice_row['id'];
                                $session_name=$admission_notice_row['session_name'];
                                $session_year=$admission_notice_row['session_year'];
    ?>
<div class="panel">

<div class="info-stats green-two">

<div class="icon-type pull-left">

<div class="day" style="color:white;"><b><?php echo date("d",strtotime($admission_notice_row['notice_date']));?></b></div>
<div class="month" style="color:white;"><b><?php echo date("M",strtotime($admission_notice_row['notice_date']));?></b></div>
</div>

<div class="sale-num"><a href="#" id="<?php echo $admission_notice_id; ?>" class="view_admission_notice"><h4>View</h4></a>

<p>Admission Notice for <?php echo $session_name." ".$session_year;?></p>
</div>
</div>

</div>
<?php
                            }
                        }
    ?>
    
    <?php 
    
    $other_notice_query="SELECT * FROM other_notice";
	$other_notice_run=mysqli_query($conn,$other_notice_query);
						if(mysqli_num_rows($other_notice_run)>0){
							while($other_notice_row=mysqli_fetch_array($other_notice_run)){
                                $other_notice_id=$other_notice_row['id'];
                                $other_notice_title=$other_notice_row['title'];
                                
                                ?>
<div class="panel">

<div class="info-stats green-two">

<div class="icon-type pull-left">
<div class="day" style="color:white;"><b><?php echo date("d",strtotime($other_notice_row['date']));?></b></div>
<div class="month" style="color:white;"><b><?php echo date("M",strtotime($other_notice_row['date']));?></b></div>
</div>

<div class="sale-num"><h4><a href="#" id="<?php echo $other_notice_id; ?>" class="view_other_notice">View</a></h4>

<p><?php echo $other_notice_title; ?></p>
</div>
</div>

</div>
<?php
                            }
                        }
    ?>
</div>


<div id="notice_details_div" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Notice</h4>  
                </div>  
                <div class="modal-body" id="notice_details">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
 
 <script>  
 $(document).ready(function(){   
     
     $(document).on('click', '.view_admission_notice', function(){  
           var admission_notice_id = $(this).attr("id");   
                $.ajax({  
                     url:"fetch-admission-notice.php",  
                     method:"POST",  
                     data:{admission_notice_id:admission_notice_id},  
                     success:function(data){  
                          $('#notice_details').html(data);  
                          $('#notice_details_div').modal('show');  
                     }  
                });  
                     
      });
     
     $(document).on('click', '.view_other_notice', function(){  
           var other_notice_id = $(this).attr("id");   
                $.ajax({  
                     url:"fetch-other-notice.php",  
                     method:"POST",  
                     data:{other_notice_id:other_notice_id},  
                     success:function(data){  
                          $('#notice_details').html(data);  
                          $('#notice_details_div').modal('show');  
                     }  
                });  
                     
      });
 });  
 </script>