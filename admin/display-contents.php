<?php

include 'includes/session.php';
$display_contents=+1;
include 'includes/head.php';
	
?>
<?php

if(isset($_POST['update']))
{
                                $fb=$_POST['fb'];
								$twitter=$_POST['twitter'];
								$linkedin=$_POST['linkedin'];
								$google_plus=$_POST['google_plus'];
								$youtube=$_POST['youtube'];
								$address=$_POST['address'];
								$email=$_POST['email'];
								$mobile=$_POST['mobile'];
$sql = "UPDATE `display_content` SET `fb` = '$fb', `twitter` = '$twitter', `linkedin` = '$linkedin', `google_plus` = '$google_plus', `youtube` = '$youtube', `address` = '$address', `email` = '$email', `mobile` = '$mobile' WHERE `display_content`.`id` = 1";
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
<?php
if(isset($_POST["slide_update"])){
    
    $slide_id=$_GET["slide_id"];
    
    $title=$_POST["title"];
    
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];
     if(!empty($_FILES['image']['name'])){
        $sql = "UPDATE `slides` SET `title` = '$title', `image` = '$image' WHERE `slides`.`id` = $slide_id";
        if (mysqli_query($conn, $sql)) {
						$path="../media/slides/$image";
						if(move_uploaded_file($image_tmp,$path)){
							copy($path,"$path");
                            echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0; url=display-contents.php");
						}
					}
                else{
                   echo '<script language="javascript">';
                        echo 'alert("Failed")';
                        echo '</script>'; 
                        header("Refresh:0; url=display-contents.php"); 
                }
                    
    }
    else
    {
        $sql = "UPDATE `slides` SET `title` = '$title' WHERE `slides`.`id` = $slide_id";
        if (mysqli_query($conn, $sql)) {
                            echo '<script language="javascript">';
                        echo 'alert("Updated")';
                        echo '</script>'; 
                        header("Refresh:0; url=display-contents.php");
						}
					
                else{
                   echo '<script language="javascript">';
                        echo 'alert("Failed")';
                        echo '</script>'; 
                        header("Refresh:0; url=display-contents.php"); 
                }
    }
    
                }
				

?>
<?php
if(isset($_POST["add"])){
    $title=$_POST["title"];
    
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];
    
    $sql = "INSERT INTO `slides` (`title`, `image`) VALUES ('$title', '$image');";

    if (mysqli_query($conn, $sql)) {
						$path="../media/slides/$image";
						if(move_uploaded_file($image_tmp,$path)){
							copy($path,"$path");
                            header("Location:display-contents.php");
						}
					}
                else
                    $add_error="Failed To Add Slide";
                    header("Location:display-contents.php");
                }
				

?>
<?php
			if(isset($_GET['delete_id'])){
				$delete_id=$_GET['delete_id'];
                if($_SESSION['username']=='Admin'){
                    $delete_query="DELETE FROM `slides` WHERE `slides`.`id` = $delete_id";
				if(mysqli_query($conn,$delete_query)){
                    $delete_msg="Succesfully Deleted Program";   
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

<div class="page-title"><h4>Home Page Contents</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4><?php if(isset($_GET["slide_id"])){echo "Update Slide";} else {echo "Add Slide";}?></h4>
</div>


<div class="panel-body">


   <?php
    if(isset($_GET["slide_id"])){
        $slide_id=$_GET["slide_id"];
        $query="SELECT * FROM slides where id=$slide_id";
                $run=mysqli_query($conn,$query);
         
      $row = mysqli_fetch_array($run);
        
    }
    ?> 
<form method="post" enctype="multipart/form-data">
       
<div class="form-group">

<div class="row gutter">

        <div class="col-md-4">
        <label class="control-label">Slide Title:</label>
        <input type="text" class="form-control" name="title" value="<?php if(isset($_GET["slide_id"])){echo $row['title'];}?>" required>
        
        </div>

        <div class="col-md-4">
        <label class="control-label">Slide Image:</label>
        <input type="file" class="form-control" name="image"  value="<?php if(isset($_GET["slide_id"])){echo $row['image'];}?>" >
        
        </div>

        <div class="col-md-4">
        <button style="margin-top:23px;" type="submit" name="<?php if(isset($_GET["slide_id"])){echo "slide_update";} else {echo "add";}?>" class="btn btn-success"><?php if(isset($_GET["slide_id"])){echo "Update";} else {echo "Add";}?></button>
        </div>
</div>
</div>
<div class="panel-heading"><h4>All Slides</h4>
</div>
<br>
</form>

				<table class="table table-bordered table-striped table-hover" id="basicExample">
			       <thead>
				<tr>
					<th>Slide Title</th>
					<th>Slide Image</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			
			<?php                
                $query="SELECT * FROM slides";
                $run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$id=$row['id'];
								$title=$row['title'];
								$image=$row['image'];
    ?>    

        <tbody>
				<tr>				
					<td><?php echo $title;?></td>					
					<td> <img style="height:75px; width:75px;" src="<?php echo '../media/slides/'.$image;?>" alt=""> </td>									
					<td><a class="btn btn-primary" href="display-contents.php?slide_id=<?php echo $id;?>" >Edit</a></td>					
					<td><a href="programs.php?delete_slide_id=<?php echo $id;?>" class="btn btn-block btn-danger" onclick="return confirm('Are you sure you want to remove this slide?');">Delete</a></td>					
				</tr>
			</tbody>
			<?php
                            }
                        }
    else
    {
        ?>
        <tbody>
        <tr><p style="color:red;">No slide has been added yet!</p></tr>
        </tbody>

   <?php
    
    }
    
    ?>
			</table>
</div>
<div class="panel-heading"><h4>Other Contents</h4>
</div>


<div class="panel-body">


   <?php
                $query="SELECT * FROM display_content where id=1";
						$run=mysqli_query($conn,$query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){
								$fb=$row['fb'];
								$twitter=$row['twitter'];
								$linkedin=$row['linkedin'];
								$google_plus=$row['google_plus'];
								$youtube=$row['youtube'];
								$address=$row['address'];
								$email=$row['email'];
								$mobile=$row['mobile'];
                            }
                        }
                ?>
    <form method="post">
                            <div class="form-group">
                            <label>Facebook Link:</label>
                            <input class="form-control" type="text" name="fb" value="<?php echo "$fb";?>" autocomplete="off" />
                            </div>
                            <div class="form-group">
                            <label>Twitter Link:</label>
                            <input class="form-control" type="text" name="twitter" value="<?php echo "$twitter";?>" autocomplete="off" />
                            </div>
                            <div class="form-group">
                            <label>Linkedin Link:</label>
                            <input class="form-control" type="text" name="linkedin" value="<?php echo "$linkedin";?>"  autocomplete="off" />
                            </div>
                            <div class="form-group">
                            <label>Google Plus Link:</label>
                            <input class="form-control" type="text" name="google_plus" value="<?php echo "$google_plus";?>"  autocomplete="off" />
                            </div>
                            <div class="form-group">
                            <label>Youtube Link:</label>
                            <input class="form-control" type="text" name="youtube" value="<?php echo "$youtube";?>"  autocomplete="off" />
                            </div>
                            <div class="form-group">
                            <label>Address:</label>
                            <input class="form-control" type="text" name="address" value="<?php echo "$address";?>"  autocomplete="off" />
                            </div>
                            <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" type="text" name="email" value="<?php echo "$email";?>"  autocomplete="off" />
                            </div>
                            <div class="form-group">
                            <label>Mobile:</label>
                            <input class="form-control" type="text" name="mobile" value="<?php echo "$mobile";?>"  autocomplete="off" />
                            </div>
                            
                            <button type="submit" name="update" class="btn btn-success">Update </button>
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