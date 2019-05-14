<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="shortcut icon" href="img/favicon.ico">
<title>Admin Panel
</title>

<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

<link href="css/main.css" rel="stylesheet" media="screen">

<link href="css/style.css" rel="stylesheet" media="screen">

<link href="fonts/icomoon/icomoon.css" rel="stylesheet">

<link href="css/heatmap/cal-heatmap.css" rel="stylesheet">

<link href="css/c3/c3.css" rel="stylesheet">

<link rel="stylesheet" href="css/datepicker.css">

<link href="css/datatables/dataTables.bs.min.css" rel="stylesheet">

<link href="css/datatables/autoFill.bs.min.css" rel="stylesheet">

<link href="css/datatables/fixedHeader.bs.css" rel="stylesheet">

<link href="css/datatables/buttons.bs.css" rel="stylesheet">
<script>
function lettersOnly(input) {
    var regex = /[^a-z ]/gi;
    input.value = input.value.replace(regex, "");
}
            function numbersOnly(input) {
    var regex = /[^0-9]/gi;
    input.value = input.value.replace(regex, "");
}
            
            function ppd() {
  var password = $("#password").val();
  var confirm_password = $("#confirm").val();

  if (password != confirm_password) {
    $("#confirm").css('border-color', "#c80000");
    $("#textboxid").css({
      "background-color": "#fee2e2"
    });
  }
}
</script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	 <script src="js/jquery-1.11.2.js"></script>
	 
</head>