<?php

include 'includes/session.php';
$admit_card_count=0;
$program_id=$_POST['program_id'];
$exam_date=$_POST['exam_date'];
$exam_time=$_POST['exam_time'];
$session_name=$_POST['session_name'];
$session_year=$_POST['session_year'];
$venue=$_POST['venue'];

$select_query="SELECT * FROM applied_application WHERE program_id LIKE '%$program_id%' AND payment_status='paid' AND session_name='$session_name' AND session_year='$session_year'";
	$run=mysqli_query($conn,$select_query);
						if(mysqli_num_rows($run)>0){
							while($row=mysqli_fetch_array($run)){					
					$registration_id=$row['registration_id'];
					$student_hsc_roll=$row['student_hsc_roll'];
                          
                                $insert_query = "INSERT INTO admit_card (registration_id,student_hsc_roll,program_id,exam_date,exam_time,session_name,session_year,venue)
					VALUES ('$registration_id','$student_hsc_roll','$program_id','$exam_date','$exam_time','$session_name','$session_year','$venue')";
					mysqli_query($conn, $insert_query);
                                $admit_card_count++;
                                
                    }
                          $_SESSION['msg']=$admit_card_count." New admit card generated";
                        header("Location:generate-admit.php?search_session_name=$session_name&search_session_year=$session_year");  
                    }
else{
    $_SESSION['error']="No application applied for this program";
                        header("Location:generate-admit.php");
}
?>
