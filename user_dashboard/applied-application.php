<?php 
include 'includes/session.php';
$admission=+1;
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

<div class="page-title"><h4>Admission</h4>
</div>

</div>

<div class="main-container">


<div class="row gutter">

<?php include 'includes/profile.php';?>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Applied Application</h4>
<?php if(isset($_SESSION['apply_success'])&& !empty($_SESSION['apply_success']))
    {?>
<span class="pull-right" style="color:green"><?php echo htmlentities($_SESSION['apply_success']);?></span>
<?php echo htmlentities($_SESSION['apply_success']="");
    }
    ?>
    
</div>

<div class="panel-body">
   

            <?php
    $query="SELECT * FROM applied_application WHERE student_hsc_roll='$session_hsc_roll'";
    $program_name=array();
                $run=mysqli_query($conn,$query);
    if(mysqli_num_rows($run)>0){
        
							while($row=mysqli_fetch_array($run)){
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
								$session_yeare=$row['session_year'];
								$amount=$row['amount'];
								$payment_status=$row['payment_status'];
    
    ?>
				<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Registration No</th>
					<th>Program</th>
					<th>Registration Date</th>
					<th>Session</th>
					<th>Amount</th>
					<th>payment_status</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $registration_id;?></td>									
					<td><?php echo implode(",",$program_name);?></td>									
					<td><?php echo $registration_date;?></td>																
					<td><?php echo $session_name." ".$session_yeare;?></td>																
					<td><?php echo $amount;?></td>									
					<td><?php echo $payment_status;?></td>									
				</tr>
				
			</tbody>
			</table>
			<?php
                            }
        if($payment_status=="pending"){
                echo "<p style='color:red; text-align: center;'> <strong>Pay registration fee by bkash with counter no. 1 and Registration no. as reference </strong></p>";
            }
    else if($payment_status=="paid"){
        $admit_card_query="SELECT admit_card.id,programs.program_name from admit_card join programs on programs.program_id=admit_card.program_id WHERE admit_card.student_hsc_roll=$session_hsc_roll";
        $admit_card_query_run=mysqli_query($conn,$admit_card_query);
        if(mysqli_num_rows($admit_card_query_run)>0){
            while($admit_card_row=mysqli_fetch_array($admit_card_query_run)){
                $admit_card_id=$admit_card_row['id'];
                $program_name=$admit_card_row['program_name'];
                
                echo "<center><a class='btn btn-success' href='../admit-card.php?admit_card_id=$admit_card_id'>Click here to print admit card of $program_name program</a></center><br>";
            }
        }
        
        else
            echo "<p style='color:orange; text-align: center;'> <strong>No admit card generated yet!</strong></p>";
    }else if($payment_status=="unclear"){
            echo "<p style='color:red; text-align: center;'> <strong>Your Payment is not Clear</strong></p>";
        }
                        }
                    else
                    {
                        echo '<center><p style="color:red;">No Application</p></center>';
                        echo '<center><a class="btn btn-success" href="admission-form.php">Apply Now</a></center>';
                    }
            ?>
        
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