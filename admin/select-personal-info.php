<?php  
 if(isset($_POST["hsc_roll"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "admin", "admin", "online_admission_system");  
      $query = "SELECT * FROM student_personal_info WHERE hsc_roll = '".$_POST["hsc_roll"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      if($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Fathers Name</label></td>  
                     <td width="70%">'.$row["father_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Mothers Name</label></td>  
                     <td width="70%">'.$row["mother_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Mobile</label></td>  
                     <td width="70%">'.$row["mobile"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Parent Mobile</label></td>  
                     <td width="70%">'.$row["parent_mobile"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Permanent Address</label></td>  
                     <td width="70%">'.$row["permanent_address"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Present Address</label></td>  
                     <td width="70%">'.$row["present_address"].' Year</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%">'.$row["gender"].' Year</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Religion</label></td>  
                     <td width="70%">'.$row["religion"].' Year</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Marital Status</label></td>  
                     <td width="70%">'.$row["marital_status"].' Year</td>  
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