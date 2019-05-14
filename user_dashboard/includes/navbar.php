
    <nav class="navbar navbar-default">

<div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

<span class="sr-only">Toggle navigation
</span> 

<span class="icon-bar">
</span> 

<span class="icon-bar">
</span> 

<span class="icon-bar">
</span></button>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li class="<?php if($user_dashboard==1){echo "active";}?>"><a href="user-dashboard.php"><i class="icon-home2"></i>Dashboard</a></li>
<li class="<?php if($personal_information==1){echo "active";}?>"><a href="personal-information.php"><i class="icon-assignment_ind"></i>Personal Information 
</a></li>
<li class="<?php if($academic_details==1){echo "active";}?>"><a href="academic-details.php"><i class="icon-open-book"></i>Academic Information 
</a></li>
<li class="dropdown <?php if($admission==1){echo "active";}?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-chrome_reader_mode"></i>Admission<span class="caret"></span></a>

<ul class="dropdown-menu">
<li><a href="admission-form.php">Apply</a></li>
<li><a href="applied-application.php">Applied Application</a></li>
</ul></li>
<li class="<?php if($result==1){echo "active";}?>"><a href="result.php"><i class="icon-assignment"></i>Result</a></li>
</ul>
</div></nav>
