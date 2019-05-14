 <?php   
 include 'includes/db.php';  
session_start();
 if(isset($_GET["program_id"]))  
 {  $count = count($_GET['program_id']);
    $total=0;
    $all_program_id=array();
    $all_program_name=array();
			for($i=0;$i<$count;$i++){
                $query = "SELECT * FROM programs WHERE program_id = '".$_GET['program_id'][$i]."'";
                $result = mysqli_query($conn, $query);
                while($row=mysqli_fetch_array($result)){
                    $program_id=$row['program_id'];
                    $program_name=$row['program_name'];
                    $program_cost=$row['registration_fee'];
                    
                  ?>
                    <tr>
                        <td><center><?php echo"$program_name";?></center></td>
                        <td><center><?php echo"$program_cost";?></center></td>
                    </tr>
                <?php
}
                array_push($all_program_id,$program_id);
                array_push($all_program_name,$program_name);
                $total=$total+$program_cost;
                $_SESSION['total']=$total;
                $_SESSION['all_program_id']=$all_program_id;
                $_SESSION['all_program_name']=$all_program_name;
                
?>
                    
               <?php 
                
            }
  
  ?>
  
                    <tr>
                        <td><b>Total</b></td>
                        <td><center><b><?php echo"$total";?></b></center></td>
                    </tr>
                    <tr>
                        <td>
                        <center>
                        <form action="confirm-application.php"><button type="submit" name="confirm" class="btn btn-primary" >Apply</button></form>
                      </center>
                       </td>
                        </tr>
                    <?php
 }

 ?>
 
 