<?php

include 'includes/session.php';
$message=+1;
include 'includes/head.php';
	
?>
<?php
if(isset($_POST['send'])){
    require '../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '298nads@gmail.com';                 // SMTP username
$mail->Password = '@@gravity298';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($_POST['recipient_email']);
$mail->addAddress($_POST['recipient_email']);     // Add a recipient              // Name is optional
$mail->addReplyTo($_POST['recipient_email']);
    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Reply From Admin';
$mail->Body    = $_POST['message'];
    
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script language="javascript">';
                        echo 'alert("Message has been sent")';
                        echo '</script>';
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

<div class="page-title"><h4>Messages</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>All Messages</h4>
</div>

<div class="panel-body">
   
    <div class="table-responsive">
        
                                <table class="table  table-bordered" id="basicExample">
                                    <thead>
                                        <tr class="info">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Message</th>
                                            <th>View & Reply</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$cnt=1;                              
$sql = "SELECT * from message ORDER BY id DESC";
$run=mysqli_query($conn,$sql);               
                
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$id=$row['id'];
								$date=$row['date'];
								$message=$row['message'];
								$status=$row['status'];
    ?>                                       
                                        <tr class="odd gradeX <?php if($status==0){echo "warning";}?>">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($date);?></td>
                                            <td class="center"><?php echo htmlentities($message);?></td>
                                            
                                             <td><input type="button"  value="Open" id="<?php echo $id;?>" class="btn btn-info btn-xs open" /></td>
                                            
                                            
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


 <div data-backdrop="static" data-keyboard="false" id="msg_details_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
               <form method="post" >
                <div class="modal-header">    
                     <h4 class="modal-title">Message</h4>  
                </div>  
                <div class="modal-body">  
                    <label class="control-label">Date:
                            </label><br><span id="date"></span><br><br>
                            <label class="control-label">Message: 
                            </label><br><span id="message"></span><br><br>
                       
                          <div class="form-group">
                            <label for="recipient-nameq" class="control-label">Recipient:
                            </label>
                            <input type="text" class="form-control" name="recipient_email" id="recipient_email">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label" required>Reply:
                                </label>
                                <textarea class="form-control" name="message" id="" rows="5">
                                </textarea>
                            </div>
                       
                </div>  
                <div class="modal-footer">  
                     <input class="btn btn-success pull-left" type="submit" name="send" value="Send">  
                     <a href="message.php" class="btn btn-danger" >Cancel</a>  
                </div>  
                </form>
           </div>  
      </div>  
 </div> 
</body>

</html>
 <script>  
 $(document).ready(function(){ 
      $(document).on('click', '.open', function(){  
           var msg_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_msg.php",  
                method:"POST",  
                data:{msg_id:msg_id},  
                dataType:"json",  
                success:function(data){  
                     $('#date').html(data.date); 
                     $('#recipient_email').val(data.sender_email); 
                     $('#message').html(data.message); 
                     $('#msg_details_Modal').modal('show');
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

<script>

</script>
