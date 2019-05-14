 <?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "admin", "admin", "online_admission_system");  
 if(isset($_POST["msg_id"]))  
 {  
      $update_query = "UPDATE `message` SET `status` = '1' WHERE `message`.`id` = '".$_POST["msg_id"]."'"; 
     mysqli_query($connect, $update_query);
      $query = "SELECT * FROM message WHERE id = '".$_POST["msg_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>