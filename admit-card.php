<?php 
include 'user_dashboard/includes/session.php';
if($session_image==""){
    $_SESSION['image_restricted']="You dont upload your photo yet! Upload Your photo then try again!";
    header("Location:user_dashboard/edit-profile.php");
}
if(isset($_GET['admit_card_id'])){
    $admit_card_id=$_GET['admit_card_id'];
    $query="SELECT admit_card.exam_date,admit_card.exam_time,admit_card.registration_id,admit_card.venue,admit_card.session_name,admit_card.session_year,programs.program_name,student_personal_info.father_name from admit_card join programs on programs.program_id=admit_card.program_id join student_personal_info on admit_card.student_hsc_roll=student_personal_info.hsc_roll WHERE id=$admit_card_id";
                $run=mysqli_query($conn,$query);
                $row=mysqli_fetch_array($run);
    $exam_date=$row['exam_date'];
    $exam_time=$row['exam_time'];
    $registration_id=$row['registration_id'];
    $venue=$row['venue'];
    $session_name=$row['session_name'];
    $session_year=$row['session_year'];
    $program_name=$row['program_name'];
    $father_name=$row['father_name'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Admit Card</title>
        <link rel="stylesheet" href="css/hlw.css">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/printPreview.js"></script>
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
    </head>
    <body>
       
<input name="b_print" type="button" class="ipt btn btn-success" onClick="printdiv('div_print');" value=" Print this page ">
        <div class="main-container" id="div_print">
            
        <header>

            <div class="contain">
                <h2 class="spc">Registration ID: <?php echo $registration_id;?></h2>
            <div class="box">
                <img src="media/student_images/<?php echo htmlentities($session_image);?>" alt="applicant-image">
            </div>
            </div>

        </header>

        <section id= "showcase">

            <div class="atLeft">
                <h3> Date: </h3>
                <p><?php echo $exam_date;?></p>
                <h3> Time: </h3>
                <p><?php echo date('h:i A', strtotime($exam_time));?></p>
                <h3> Venue: </h3>
                <p><?php echo $venue;?></p>
                <h3> Session: </h3>
                <p><?php echo htmlentities($session_name.' '.$session_year);?></p>
                <h3>Program: </h3>
                <p><?php echo $program_name;?></p>
            </div>
            <div class="atRight">
                <h3> Student's Name: </h3>
                <p><?php echo $session_first_name." ".$session_last_name;?></p>
                <h3> Student's HSC Roll: </h3>
                <p><?php echo $session_hsc_roll;?></p>
                <h3> Fathers Name: </h3>
                <p><?php echo $father_name;?></p>
            </div>
        </section>

        <section id="sig">
            <div class="hold">

                <div class="box1">
                    <p>Signature of Examiner </p>
                </div>

                <div class="box1">
                    <p>Signature of Applicant </p>
                </div>
            </div>
        </section>
        <footer>
            <h3><u>Instruction:</u> </h3>
            <p>1.Instruction one</p>
                <p>2.Instruction two</p>
                <p>3.Instruction three</p>
                <p>4.Instruction four</p>
                <p>5.Instruction five</p>

        </footer>
        </div>
    </body>
</html>
