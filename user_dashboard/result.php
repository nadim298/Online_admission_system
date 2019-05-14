<?php 
include 'includes/session.php';
$result=+1;
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
    $query="SELECT * FROM result WHERE hsc_roll='$session_hsc_roll'";
    $program_name=array();
                $run=mysqli_query($conn,$query);
    if(mysqli_num_rows($run)>0){
        
							while($row=mysqli_fetch_array($run)){
								
								
    
    ?>
				<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Session</th>
					<th>English</th>
					<th>Math</th>
					<th>General Knowlegde</th>
					<th>Total</th>
					<th>Position</th>
					<th>Merit/Waiting</th>
					<th>Pass/Fail</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $row['session'];?></td>										
					<td><?php echo $row['english'];?></td>										
					<td><?php echo $row['math'];?></td>										
					<td><?php echo $row['gk'];?></td>										
					<td><?php echo $row['total'];?></td>										
					<td><?php echo $row['position'];?></td>
					<td><?php if($row['position']>0 && $row['position']<4){echo "<span style='color:green;'>Merit<span>";} else if($row['position']>4){  echo "<span style='color:yellow;'>Waiting<span>";  } ?></td>										
					<td><?php if($row['status']==1){echo "<p style='background-color:green;text-align:center; color:white;'>Passed</p>";} else{echo "<p style='background-color:red; text-align:center; color:white;'>Failed</p>";}?></td>										
													
				</tr>
				
			</tbody>
			</table>
			<?php
                            }
        
    
                        }
                    else
                    {
                        echo '<center><p style="color:red;">No Result Published!</p></center>';
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