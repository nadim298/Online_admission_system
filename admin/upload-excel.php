<?php

include 'includes/session.php';
$upload_excel=+1;
include 'includes/head.php';
	
?>

<style>


table {
  border-collapse: collapse;
}

td {
  height: 50px;
}
</style>
<body>

<div id="loading-wrapper">

<div id="loader">
</div>
</div>

<?php include 'includes/header.php';?>
<div class="container-fluid">

<div class="dashboard-wrapper">

<?php include 'includes/navbar.php';?>
<div class="top-bar clearfix">

<div class="page-title"><h4>Excel Files</h4>
</div>


</div>

<div class="main-container">

<div class="row gutter">

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Registration fee payment sheet</h4>
</div>

<div class="panel-body">
<h3 align="center">Upload Payment Excel File To Update Payment Status</h3>  
                <br /><br />  
                <br /><br />
    <div align="center">
        <form mehtod="post" id="payment_sheet_form" enctype="multipart/form-data">  
                    <table>
                        <tr>
                            <td><label>Select Excel:</label></td>
                            <td><input type="file" name="payment_excel_file" id="payment_excel_file" required/></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" class="btn btn-success" name="payment_excel_file_submit" id="payment_excel_file_submit" />
                            </td>
                            <td id="payment_file_status"></td>
                        </tr>
                    </table>
                    </form>
    </div>
                  
                <br />  
                <br />  
                <div id="result">  
                </div>

</div>
</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="panel panel-light">

<div class="panel-heading"><h4>Result sheet</h4>
</div>

<div class="panel-body">
<h3 align="center">Upload Result Excel File To Publish Result</h3>  
                <br /><br />  
                <br /><br /> 
                <div align="center"> 
                    <form role="form" id="result_sheet_form" mehtod="post" enctype="multipart/form-data"> 
                       <table>
                           <tr>
                               <td><label>Select Excel:</label></td>
                               <td><input type="file" name="result_excel_file" id="result_excel_file"  required /></td>
                           </tr>
                           <tr>
                               <td><label>Select Session: </label></td>
                               <td>
                                   <div class="col-md-6">
                                       <select class="form-control" name="session_name" id="session_name" onchange="checkAvailability()" required>
                                    <option value="">--Select Session--</option>
                                    <option value="Spring">Spring</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Fall">Fall</option>
                                    </select>
                                   </div>
                                   <div class="col-md-6">
                                       <select class="form-control"  name="session_year" id="session_year" onchange="checkAvailability()"  required>
   
                                    <option value="">--Select Year--</option>
                                   <?php
                                        $end= 1900;
                                        $start = date("Y");
                                       for( $year = $start ; $year >=$end; $year--){
                                          echo "<option value='$year'>$year</option>";
                                        }
                                       ?>
                                   </select>
                                   </div>
                                    
                               </td>
                               
                           </tr>
                           <tr>
                               <td><input type="submit" class="btn btn-success" name="result_excel_file_submit" id="result_excel_file_submit" /></td>
                               <td id="result_file_status"></td>
                           </tr>
                       </table>


                          

                    </form> 
                </div> 
                <br />  
                <br />  
                <div >  
                </div>

</div>
</div>
</div>
</div>
</div>
<?php include 'includes/footer.php';?>
</div>
<?php include 'includes/sidebar.php';?>
</div>
<?php include 'includes/bottom-scripts.php';?>
</body>

</html>

 <script>
 $('#payment_excel_file').change(function (e){
     var file=e.target.files[0];
     var extension=file.name.replace(/^.*\./,"");
     console.log(extension);
     if(extension=='xls'|| extension=="xlsx"){
         $('#payment_file_status').html("<p style='color:green'>File is valid.</p>");
         $('#payment_excel_file_submit').prop('disabled',false);
     } else{
         $('#payment_file_status').html("<p style='color:red'>Invalid file. Select xls or xlsx file.</p>");
         $('#payment_excel_file_submit').prop('disabled',true);
     }
 }); 
     $(document).ready(function(){  
      $('#payment_excel_file_submit').submit(function(){  
           $('#payment_sheet_form').submit();  
      });  
      $('#payment_sheet_form').on('submit', function(event){  
           event.preventDefault();  
           $.ajax({  
                url:"export-payment.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                success:function(data){  
                     $('#payment_file_status').html(data);  
                     $('#payment_excel_file').val('');  
                }  
           });  
      });  
 });
     
 </script> 
 <script>
 $('#result_excel_file').change(function (e){
     var file=e.target.files[0];
     var extension=file.name.replace(/^.*\./,"");
     console.log(extension);
     if(extension=='xls'|| extension=="xlsx"){
         $('#result_file_status').html("<p style='color:green'>File is valid.</p>");
         $('#result_excel_file_submit').prop('disabled',false);
     } else{
         $('#result_file_status').html("<p style='color:red'>Invalid file. Select xls or xlsx file.</p>");
         $('#result_excel_file_submit').prop('disabled',true);
     }
 }); 
     $(document).ready(function(){  
      $('#result_excel_file_submit').submit(function(){  
           $('#result_sheet_form').submit();  
      });  
      $('#result_sheet_form').on('submit', function(event){  
           event.preventDefault();  
           $.ajax({  
                url:"publish-result.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                success:function(data){  
                     $('#result_file_status').html(data);  
                     $('#result_excel_file').val('');  
                }  
           });  
      });  
 });
     
 </script> 
 <script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "publish-result.php",
data:{session_year: $("#session_year").val(), session_name: $("#session_name").val()},
type: "POST",
success:function(data){
$("#result_file_status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script> 