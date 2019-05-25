<?php
include 'includes/session.php';

$program_id="6";
if(isset($_POST["update"])){
    
    $program_name=$_POST["program_name"];
    
    $required_gpa=$_POST["required_gpa"];
    $registration_fee=$_POST["registration_fee"];
    $sql = "UPDATE `programs` SET `program_name` = '$program_name', `required_gpa` = '$required_gpa', `registration_fee` = '$registration_fee' WHERE `programs`.`program_id` = $program_id";

    if(mysqli_query($conn,$sql)){
                    $add_msg="Succesfully Added Program";   
                }
                else
                    $add_error="Failed To Add Program";
                }
?>