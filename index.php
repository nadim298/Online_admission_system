<?php
include 'includes/db.php';
ob_start();
session_start();
$this_page="home";
?>
<?php
if(isset($_POST['send'])){									
					
    $sender_name=$_POST['sender_name'];
    $sender_email=$_POST['sender_email'];
    $message=$_POST['message'];
    $sql = "INSERT INTO `message` (`sender_name`, `sender_email`, `message`) VALUES ('$sender_name', '$sender_email', '$message')";
    if(mysqli_query($conn, $sql)){
        $_SESSION['send_msg']="Message Sent!";
    }
    else{
        $_SESSION['failed_msg']=" Message sending failed! Try again..";
        header("Location:index.php");
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
            <div class="col-md-8">
                <div class="main-slideshow">
                    <div class="flexslider">
                        <ul class="slides">
                           <?php 
    
    $slide_query="SELECT * FROM slides";
	$slide_query_run=mysqli_query($conn,$slide_query);
						if(mysqli_num_rows($slide_query_run)>0){
							while($slide_query_row=mysqli_fetch_array($slide_query_run)){
                                $slide_id=$slide_query_row['id'];
                                $slide_title=$slide_query_row['title'];
                                $slide_image=$slide_query_row['image'];
                                
                                ?>
                            <li>
                                <img style="height:392px; width:738px;" src="media/slides/<?php echo htmlentities($slide_image);?>" />
                                <div class="slider-caption">
                                    <h2 style="color:white;"><?php echo htmlentities($slide_title);?></h2>
                                </div>
                            </li>
                            <?php
                            }
                        }
    ?>
                        </ul> <!-- /.slides -->
                    </div> <!-- /.flexslider -->
                </div> <!-- /.main-slideshow -->
            </div> <!-- /.col-md-12 -->
            
            <div class="col-md-4">
                <div class="widget-item">
                    <div class="request-information">
                        <h4 class="widget-title">Request Information</h4>
                        <form method="post" class="request-info clearfix"> 
                            

                            <div class="full-row">
                                <label>Full Name: 
                                <?php if(isset($_SESSION['send_msg'])&& !empty($_SESSION['send_msg']))
                                    {?>
                                <span class="pull-right" style="color:green"><?php echo htmlentities($_SESSION['send_msg']);?></span>
                                <?php echo htmlentities($_SESSION['send_msg']="");
                                    }
                                    ?>
                                    <?php if(isset($_SESSION['failed_msg'])&& !empty($_SESSION['failed_msg']))
                                    {?>
                                <span class="pull-right" style="color:red"><?php echo htmlentities($_SESSION['failed_msg']);?></span>
                                <?php echo htmlentities($_SESSION['failed_msg']="");
                                    }
                                    ?>
                                </label>
                                <input type="text" id="sender_name" class="form-control" name="sender_name">
                            </div> <!-- /.full-row -->

                            <div class="full-row">
                                <label>Email Address:</label>
                                <input type="text" id="sender_email" class="form-control" name="sender_email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                            </div> <!-- /.full-row -->
                            
                            <div class="full-row">
                                <label for="question">Question:</label>
                                <textarea type="text" id="message" class="form-control" name="message" cols="39" rows="5"></textarea>
                            </div> <!-- /.full-row -->
                            
                            <div class="full-row">
                                <div class="submit_field">
                                    <input class="mainBtn pull-right" type="submit" name="send" value="Submit Request">
                                </div> <!-- /.submit-field -->
                            </div> <!-- /.full-row -->


                        </form> <!-- /.request-info -->
                    </div> <!-- /.request-information -->
                </div> <!-- /.widget-item -->
            </div> <!-- /.col-md-4 -->
        </div>
    </div>


    <div class="container">
        <div class="row">
            
            <!-- Here begin Main Content -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget-item">
                            <h2 class="welcome-text">Welcome to Stamford University, Bangladesh</h2>
                            <p><strong>Stamford University, Bangladesh was founded in the city of Dhaka in 1994 and then it as known as Stamford College Group, Bangladesh. It was upgraded as a private university with the permission of the Government of Bangladesh in 2002 and emerged as Stamford University, Bangladesh. Stamford College Group, Bangladesh began its journey in 1994 as a full-fledged educational institution with a promise of providing an international standard education. Stamford University, Bangladesh belongs to globally recognized Stamford University & College Group that has 160 campuses now in Asia, Europe, Africa, Australia and America. This institution has been established with a view to making significant contribution to the development of education in the country. Since its beginning this institution has been continuing its educational programs in Bangladesh with great success and fame. More than 12,000 students have successfully completed their degrees from this university and most of them are now engaged in different national and multinational organizations. More than 12,000 students are studying under undergraduate and graduate programs.</p>
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->

                <div class="row">
                    
                    <!-- Show Latest Blog News -->
                    <div id="notices" class="col-md-6">
                        <div class="widget-main">
                            <div class="widget-main-title">
                                <h4 class="widget-title">Admission Start/End Notice</h4>
                            </div> <!-- /.widget-main-title -->
                            <div class="widget-inner">
                               <?php 
    
    $admission_notice_query="SELECT * FROM admission_notices WHERE end_date >=now() and status=1 ";
	$admission_notice_run=mysqli_query($conn,$admission_notice_query);
						if(mysqli_num_rows($admission_notice_run)>0){
							while($admission_notice_row=mysqli_fetch_array($admission_notice_run)){
                                $admission_notice_id=$admission_notice_row['id'];
                                $start_date=$admission_notice_row['start_date'];
                                $end_date=$admission_notice_row['end_date'];
                                $session_name=$admission_notice_row['session_name'];
                                $session_year=$admission_notice_row['session_year'];
    ?>
                                <div class="event-small-list clearfix">
                                    <div class="calendar-small">
                                        <span class="s-month"><?php echo date("M",strtotime($admission_notice_row['notice_date']));?></span>
                                        <span class="s-date"><?php echo date("d",strtotime($admission_notice_row['notice_date']));?></span>
                                    </div>
                                    <div class="event-small-details">
                                        <h5 class="event-small-title">Admission of <?php echo $session_name." ".$session_year;?> is going on</h5>
                                        <p style="color:black" class="event-small-meta small-text">Start from <?php echo $start_date;?> and will be end at <?php echo $end_date;?> </p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                                else {
                                    echo "<h5 style='color:red' class='event-small-meta small-text'>Admission doesnt start yet!</h5>";
                                }
    ?>
                            </div>
                             <!-- /.widget-inner -->
                        </div> <!-- /.widget-main -->
                    </div> <!-- /col-md-6 -->
                    
                    <!-- Show Latest Events List -->
                    <div class="col-md-6">
                        <div class="widget-main">
                            <div class="widget-main-title">
                                <h4 class="widget-title">Others Notices</h4>
                            </div> <!-- /.widget-main-title -->
                            <div class="widget-inner">
                               <?php 
    
    $other_notice_query="SELECT * FROM other_notice";
	$other_notice_run=mysqli_query($conn,$other_notice_query);
						if(mysqli_num_rows($other_notice_run)>0){
							while($other_notice_row=mysqli_fetch_array($other_notice_run)){
                                $other_notice_id=$other_notice_row['id'];
                                $other_notice_title=$other_notice_row['title'];
                                $other_notice_details=$other_notice_row['details'];
                                
                                ?>
                                <div class="event-small-list clearfix">
                                    <div class="calendar-small">
                                        <span class="s-month"><?php echo date("M",strtotime($other_notice_row['date']));?></span>
                                        <span class="s-date"><?php echo date("d",strtotime($other_notice_row['date']));?></span>
                                    </div>
                                    <div class="event-small-details">
                                        <h5 class="event-small-title"><a href="event-single.html"><?php echo $other_notice_title;?></a></h5>
                                        <p style="color:black" class="event-small-meta small-text"><?php echo $other_notice_details;?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                                else {
                                    echo "<h5 style='color:red' class='event-small-meta small-text'>No record found!</h5>";
                                }
    ?>
                            </div> <!-- /.widget-inner -->
                        </div> <!-- /.widget-main -->
                    </div> <!-- /.col-md-6 -->
                    
                </div> <!-- /.row -->
                

            </div> <!-- /.col-md-8 -->
            
            <!-- Here begin Sidebar -->
            <div class="col-md-4">

                <div class="widget-main">
                    <div class="widget-main-title">
                        <h4 class="widget-title">Authorities</h4>
                    </div>
                    <div class="widget-inner">
                        <div class="prof-list-item clearfix">
                           <div class="prof-thumb">
                                <img src="media/authorities/Founder.jpg" alt="Prof. Dr. M. A. Hannan Feroz">
                            </div> <!-- /.prof-thumb -->
                            <div class="prof-details">
                                <h5 class="prof-name-list">Prof. Dr. M. A. Hannan Feroz</h5>
                                <p class="small-text">Founder</p>
                            </div> <!-- /.prof-details -->
                        </div> <!-- /.prof-list-item -->
                        <div class="prof-list-item clearfix">
                           <div class="prof-thumb">
                                <img src="media/authorities/Chairman.jpg" alt="Fatinaaz Feroz">
                            </div> <!-- /.prof-thumb -->
                            <div class="prof-details">
                                <h5 class="prof-name-list">Fatinaaz Feroz</h5>
                                <p class="small-text">Chairman, Board of Trustees</p>
                            </div> <!-- /.prof-details -->
                        </div> <!-- /.prof-list-item -->
                        <div class="prof-list-item clearfix">
                           <div class="prof-thumb">
                                <img src="media/authorities/vc.png" alt="Prof. Mohammad Ali Naqi">
                            </div> <!-- /.prof-thumb -->
                            <div class="prof-details">
                                <h5 class="prof-name-list">Prof. Mohammad Ali Naqi</h5>
                                <p class="small-text">Vice-Chancellor</p>
                            </div> <!-- /.prof-details -->
                        </div> <!-- /.prof-list-item -->
                    </div> <!-- /.widget-inner -->
                </div> <!-- /.widget-main -->

                <div class="widget-main">
                    <div class="widget-main-title">
                        <h4 class="widget-title">Professors & Others</h4>
                    </div>
                    <div class="widget-inner">
                        <div id="slider-testimonials">
                            <ul>
                                <li>
                                    <center><h4><strong class="dark-text">430 Faculties</strong></h4></center>
                                    <p>260 Plus Full Time & also have part time Faculties.</p>
                                </li>
                                <li>
                                    <center><h4><strong class="dark-text">27500 Alumnis</strong></h4></center>
                                    <p>Who stand testament to the positive mark the university has made in their lives.</p>
                                </li>
                                <li>
                                    <center><h4><strong class="dark-text">31 Degrees</strong></h4></center>
                                    <p>Providing 31 well structured degrees to cater the needs of students and their ambitions.</p>
                                </li>
                                <li>
                                    <center><h4><strong class="dark-text">20 Professors</strong></h4></center>
                                    <p>With years of teaching experience while holding degrees from the best institutions.</p>
                                </li>
                            </ul>
                            <a class="prev fa fa-angle-left" href="#"></a>
                            <a class="next fa fa-angle-right" href="#"></a>
                        </div>
                    </div> <!-- /.widget-inner -->
                </div> <!-- /.widget-main -->

            </div>
        </div>
    </div>

    <!-- begin The Footer -->
    
<?php include 'includes/footer.php';?>


</body>

<!-- Mirrored from demo.esmeth.com/universe/Red/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Jan 2019 10:11:04 GMT -->
</html>