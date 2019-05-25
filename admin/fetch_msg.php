 <?php  
 //fetch.php  
 include 'includes/db.php';  
 if(isset($_POST["msg_id"]))  
 {  
      $update_query = "UPDATE `message` SET `status` = '1' WHERE `message`.`id` = '".$_POST["msg_id"]."'"; 
     mysqli_query($conn, $update_query);
      $query = "SELECT * FROM message WHERE id = '".$_POST["msg_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>