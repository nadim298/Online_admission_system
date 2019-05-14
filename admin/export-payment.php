<?php  
include 'includes/db.php';
 //export.php  
 if(!empty($_FILES["payment_excel_file"]))  
 {    $payment_count=0;
           include("../PHPExcel/IOFactory.php");  
            $file_array = explode(".", $_FILES["payment_excel_file"]["name"]);  
      if($file_array[1] == "xlsx")  
      {  
           $object = PHPExcel_IOFactory::load($_FILES["payment_excel_file"]["tmp_name"]);  
           foreach($object->getWorksheetIterator() as $worksheet)  
           {  
                $highestRow = $worksheet->getHighestRow();  
                for($row=2; $row<=$highestRow; $row++)  
                {  
                     $registration_id = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());  
                     $amount = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                     $paid_query = "  
                     UPDATE `applied_application` SET `payment_status` = 'paid' WHERE `applied_application`.`registration_id` = $registration_id AND `applied_application`.`amount`<=$amount
                     ";
                    $unclear_query="  
                     UPDATE `applied_application` SET `payment_status` = 'unclear' WHERE `applied_application`.`registration_id` = $registration_id AND `applied_application`.`amount`>$amount
                     ";
                     mysqli_query($conn, $paid_query);  
                     mysqli_query($conn, $unclear_query);  
                    $payment_count++;
                      
                }  
           }  
              echo $payment_count."<span style='color:green;'>Student's payment inserted. Go to <a style='color:blue;' href='applied-application.php'>Applied Application</a> page to see</span>";
        }  
      else  
      {  
           echo '<label class="text-danger">Invalid File</label>';  
      } 
 }  
 ?>  