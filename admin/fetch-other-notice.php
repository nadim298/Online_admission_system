 <?php   
 include 'includes/db.php';  
 if(isset($_POST["notice_id"]))  
 {  
      $query = "SELECT * FROM other_notice WHERE id = '".$_POST["notice_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>