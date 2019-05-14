 <?php   
 include 'includes/db.php';  
 if(isset($_POST["admission_notice_id"]))  
 {  
      $query = "SELECT * FROM admission_notices WHERE id = '".$_POST["admission_notice_id"]."'";  
      $result = mysqli_query($conn, $query);  
        $output='';  
      if($row = mysqli_fetch_array($result))  
      {  
           $output .= 'Admission for <b>'.$row["session_name"].' '.$row["session_year"].'</b> will be started from <b>'.$row["start_date"].'</b> and will be ended at <b>'.$row["end_date"].'</b>. <h5 style="color:red;"><center>Exam date will be annouced later!</center></h5>';  
      }
     
      echo $output;  
 }  
 ?>