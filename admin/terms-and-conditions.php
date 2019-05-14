<?php

include 'includes/session.php';
$terms_and_conditions=+1;
include 'includes/head.php';
	
?>
<?php

if(isset($_POST['update']))
{
                                $hsc_year_difference=$_POST['hsc_year_difference'];
								$pass_mark=$_POST['pass_mark'];
								
$sql = "UPDATE `terms_and_condition` SET `hsc_year_difference` = '$hsc_year_difference', `pass_mark` = '$pass_mark' WHERE `terms_and_condition`.`id` = 1";
if(mysqli_query($conn,$sql)){
                    echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0");
                }
                else
                {
                    echo '<script language="javascript">';
                        echo 'alert("Failed")';
                        echo '</script>'; 
                        header("Refresh:0");
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

<div class="page-title"><h4>Terms & Conditions</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">

<div class="panel panel-light">
<div class="panel-heading"><h4>Edit Terms & Conditions</h4>
</div>


<div class="panel-body">


   <?php
                $query="SELECT * FROM terms_and_condition where id=1";
						$run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$hsc_year_difference=$row['hsc_year_difference'];
								$pass_mark=$row['pass_mark'];
								
                            }
                        }
                ?>
    <form method="post">
                            <div class="form-group">
                            <label>Hsc Year Difference:</label>
                            <input class="form-control" type="text" name="hsc_year_difference" value="<?php echo "$hsc_year_difference";?>" />
                            </div>
                            <div class="form-group">
                            <label>Pass Mark</label>
                            <input class="form-control" type="text" name="pass_mark" value="<?php echo "$pass_mark";?>"  />
                            </div>
                            
                            
                            <button type="submit" name="update" class="btn btn-info">Update </button>
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