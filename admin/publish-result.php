<?php  
include 'includes/db.php';
 //export.php  
if(!empty($_POST["session_year"]) && !empty($_POST["session_name"])) {
	$session=$_POST['session_name']." ".$_POST['session_year'];
	
		$sql ="SELECT * FROM result WHERE session='$session'";
        $run=mysqli_query($conn,$sql);
if(mysqli_num_rows($run)>0)
{
echo "<span style='color:red'> Session already exists .</span>";
 echo "<script>$('#result_excel_file_submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Session available for publish .</span>";
 echo "<script>$('#result_excel_file_submit').prop('disabled',false);</script>";
}

}

$pass_mark_query="select * from terms_and_condition where id='1'";
	
	$pass_mark_run=mysqli_query($conn,$pass_mark_query);
	$pass_mark_row=mysqli_fetch_array($pass_mark_run);
					$pass_mark=$pass_mark_row['pass_mark'];

 if(!empty($_FILES["result_excel_file"]))  
 {  
       $session=$_POST['session_name']." ".$_POST['session_year'];
       $result_count=0;
     $file_array = explode(".", $_FILES["result_excel_file"]["name"]);  
      if($file_array[1] == "xlsx")  
      { 
           include("../PHPExcel/IOFactory.php");  
            
           $object = PHPExcel_IOFactory::load($_FILES["result_excel_file"]["tmp_name"]);  
           foreach($object->getWorksheetIterator() as $worksheet)  
           {  
                $highestRow = $worksheet->getHighestRow();  
                for($row=2; $row<=$highestRow; $row++)  
                {  
                     $hsc_roll = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());  
                     $english = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                     $math = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                     $gk = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                     $total = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                     $position = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    if($total>$pass_mark){
                       $status=1;
                        
                    }
                    else{
                        $status=0;
                        $position=NULL;
                    }
                     $query = "  
                     INSERT INTO `result` (`hsc_roll`, `session`, `english`, `math`, `gk`, `total`, `position`, `status`) VALUES ('$hsc_roll', '$session', '$english', '$math', '$gk', '$total', '$position', '$status')";  
                     mysqli_query($conn, $query);  
                     $result_count++;
                }  
           } 
     echo $result_count." Student's results published ! Go to <a style='color:blue;' href='all-result.php'>Results</a> page";
             
        }  
      else  
      {  
           echo '<label class="text-danger">Invalid File</label>';  
      } 
      
 }
 ?>  