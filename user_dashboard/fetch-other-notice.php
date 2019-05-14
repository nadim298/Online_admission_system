 <?php   
 include 'includes/db.php';  
 if(isset($_POST["other_notice_id"]))  
 {  
      $query = "SELECT * FROM other_notice WHERE id = '".$_POST["other_notice_id"]."'";  
      $result = mysqli_query($conn, $query);  
        $output='';  
      if($row = mysqli_fetch_array($result))  
      {  
           $output .= '<h4><center>'.$row["title"].'</center></h4> </br> <p><center>'.$row["details"].'</center></p>';  
      }
     
      echo $output;  
 }  
 ?>