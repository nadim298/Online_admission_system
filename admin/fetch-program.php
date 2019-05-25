 <?php
 include 'includes/db.php';  
 if(isset($_POST["program_id"]))  
 {  
      $query = "SELECT * FROM programs WHERE program_id = '".$_POST["program_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);
      echo json_encode($row);  
 }  
 ?>