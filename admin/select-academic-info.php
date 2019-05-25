<?php  
 if(isset($_POST["hsc_roll"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "admin", "admin", "online_admission_system");  
      $query = "SELECT * FROM student_academic_info WHERE hsc_roll = '".$_POST["hsc_roll"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table style="width:100%">';  
      if($row = mysqli_fetch_array($result))  
      {  
           $output .= ' 
                <tr>
                    <td align="center"><label>SSC Details</label></td>
              </tr>
                <tr>  
                     <td width="30%"><label>SSC Roll</label></td>  
                     <td width="70%">'.$row["ssc_roll"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>SSC Registration</label></td>  
                     <td width="70%">'.$row["ssc_registration"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>SSC Group</label></td>  
                     <td width="70%">'.$row["ssc_group"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>SSC Board</label></td>  
                     <td width="70%">'.$row["ssc_board"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>SSC Passing Year</label></td>  
                     <td width="70%">'.$row["ssc_passing_year"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>SSC GPA</label></td>  
                     <td width="70%">'.$row["ssc_gpa"].' Year</td>  
                </tr>
                <tr>  
                     <td align="center"><label>HSC Details</label></td>
                </tr>
                <tr>  
                     <td width="30%"><label>HSC Roll</label></td>  
                     <td width="70%">'.$row["hsc_roll"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>HSC Registration</label></td>  
                     <td width="70%">'.$row["hsc_registration"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>HSC Group</label></td>  
                     <td width="70%">'.$row["hsc_group"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>HSC Board</label></td>  
                     <td width="70%">'.$row["hsc_board"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>HSC Passing Year</label></td>  
                     <td width="70%">'.$row["ssc_passing_year"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>HSC GPA</label></td>  
                     <td width="70%">'.$row["hsc_gpa"].' Year</td>  
                </tr>
                
           ';  
      }
     else
      $output .= '
                <tr>  
                     <td width="30%"><label>Not yet submitted</label></td>
                </tr>
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>