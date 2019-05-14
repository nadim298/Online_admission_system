<?php

include 'includes/session.php';
$admin_dashboard=+1;
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

<div class="page-title"><h4>Dashboard</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Overview</h4>
</div>


<div class="panel-body">


<ul class="visitor-stats clearfix">
<?php 
    $query="SELECT * FROM student_login_info";
                $run=mysqli_query($conn,$query);
    ?>
<li><h5 class="visitor-title">Registered Students 

</h5><h2 class="num-stats"><?php echo mysqli_num_rows($run);?></h2>

</li>
<?php 
    $query="SELECT * FROM programs";
                $run=mysqli_query($conn,$query);
    ?>
<li><h5 class="visitor-title">Total Programs 

</h5><h2 class="num-stats"><?php echo mysqli_num_rows($run);?></h2>

</li>
<?php 
    $query="SELECT * FROM applied_application where archive=0";
                $run=mysqli_query($conn,$query);
    ?>
<li><h5 class="visitor-title">Applied Application for this session 

</h5><h2 class="num-stats"><?php echo mysqli_num_rows($run);?></h2>

</li>

<li><h5 class="visitor-title">Registration Duration for this session

</h5><h6 class="num-stats">
<?php 
    $query="SELECT * FROM admission_notices WHERE end_date >=now() and start_date<=now()";
                
    $run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
         echo "From ".$row['start_date']." To ".$row['end_date'];
    }
                        }
    else
        echo "Registration doesnt start yet!";
    ?>
</h6>

</li>

</ul>
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