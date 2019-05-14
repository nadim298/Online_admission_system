<?php
include 'includes/db.php';
ob_start();
session_start();
$this_page="contact";
?>
<?php
if(isset($_POST['send'])){									
					
    $sender_name=$_POST['sender_name'];
    $sender_email=$_POST['sender_email'];
    $message=$_POST['message'];
    $sql = "INSERT INTO `message` (`sender_name`, `sender_email`, `message`) VALUES ('$sender_name', '$sender_email', '$message')";
    if(mysqli_query($conn, $sql)){
        echo '<script language="javascript">';
echo 'alert("Your Feedback Successfully Sent")';
echo '</script>';
    }
    else{
        echo '<script language="javascript">';
echo 'alert("Falied.. Try again!")';
echo '</script>';
    }
}
                    
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<!-- Mirrored from demo.esmeth.com/universe/Red/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Jan 2019 10:10:02 GMT -->
<head>
    <?php include 'includes/head.php';?> 
</head>
  <body>
   <?php include 'includes/header.php'; ?>    
    
    <div class="container">
        <div class="row">

            <div class="col-md-5">
                <div class="contact-map">
                    <div class="google-map-canvas"  style="height: 542px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.0807390077466!2d90.40624741498125!3d23.74450008459231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b88bfd0133c5%3A0xfde0a96bf5fecf99!2sStamford+University+Bangladesh!5e0!3m2!1sen!2sbd!4v1557382554672!5m2!1sen!2sbd" width="100%" height="542px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div> <!-- /.col-md-5 -->
            
            <div class="col-md-7">
                <div class="contact-page-content">
                    <div class="contact-heading">
                        <h3>Our Contact Details</h3>
                        <hr>
                        <p>For any kind of information you are welcomed !</p>
                    </div>
                    <div class="contact-form clearfix">
                        <p class="full-row">
                            <span class="contact-label">
                                <label for="name-id">Contact No:</label>
                            </span>
                            <label ><?php echo $mobile;?></label>
                        </p>
                        <p class="full-row"> 
                            <span class="contact-label">
                                <label for="surname-id">Address:</label>
                            </span>
                            <label ><?php echo $address;?></label>
                        </p>
                        <p class="full-row">
                            <span class="contact-label">
                                <label for="email-id">E-mail:</label>
                            </span>
                            <label ><?php echo $email;?></label>
                        </p>
                        
                    </div>
                </div>
                
                <div class="contact-page-content">
                    <div class="contact-heading">
                        <h3>Feedback</h3>
                        <hr>
                    </div>
                    <div class="contact-form clearfix">
                        <form action="" method="post">
                            <p class="full-row">
                            <span class="contact-label">
                                <label for="name-id">Name:</label>
                                <span class="small-text">Put your fullname here</span>
                            </span>
                            <input type="text" id="name-id" name="sender_name">
                        </p>
                        <p class="full-row">
                            <span class="contact-label">
                                <label for="email-id">E-mail:</label>
                                <span class="small-text">Type email address</span>
                            </span>
                            <input type="text" id="email-id" name="sender_email">
                        </p>
                        <p class="full-row">
                            <span class="contact-label">
                                <label for="message">Message:</label>
                                <span class="small-text">Type your feedback</span>
                            </span>
                            <textarea name="message" id="message" rows="6"></textarea>
                        </p>
                        <p class="full-row">
                            <input class="mainBtn" type="submit" name="send" value="Send Message">
                        </p>
                        </form>
                    </div>
                </div>
            </div> <!-- /.col-md-7 -->

        </div> <!-- /.row -->
    </div>
    
<?php include 'includes/footer.php';?>


</body>

</html>
<script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/custom.js"></script>
