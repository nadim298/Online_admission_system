
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
<li class="<?php if($admin_dashboard==1){echo "active";}?>"><a href="admin-dashboard.php"><i class="icon-home2"></i>Dashboard</a></li>
<li class="<?php if($programs==1){echo "active";}?>"><a href="programs.php"><i class="icon-storage"></i>Programs</a></li>
<li class="<?php if($applied_application==1){echo "active";}?>"><a href="applied-application.php"><i class="icon-paper"></i>Applied Application</a></li>
<li class="<?php if($all_students==1){echo "active";}?>"><a href="all-students.php"><i class="icon-accessibility"></i>All Students</a></li>
<li class="<?php if($generate_admit==1){echo "active";}?>"><a href="generate-admit.php"><i class="icon-printer"></i>Generate Admit Card</a></li>
<li class="<?php if($upload_excel==1){echo "active";}?>"><a href="upload-excel.php"><i class="icon-file_upload"></i>Upload Excel File</a></li>
<li class="dropdown <?php if($notice==1){echo "active";}?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-browser"></i>Notices<span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="admission-notice.php">Admission Start/End Notice</a></li>
<li><a href="other-notice.php">Others Notice</a></li>
</ul></li>
<li class="<?php if($display_contents==1){echo "active";}?>"><a href="display-contents.php"><i class="icon-desktop_windows"></i>Home page contents</a></li>
<li class="<?php if($message==1){echo "active";}?>"><a href="message.php"><i class="icon-chat2"></i>Messages</a></li>
<li class="<?php if($all_result==1){echo "active";}?>"><a href="all-result.php"><i class="icon-assignment"></i>All Results</a></li>
<li class="<?php if($terms_and_conditions==1){echo "active";}?>"><a href="terms-and-conditions.php"><i class="icon-write"></i>Terms & Conditions</a></li>
</ul>
</div></nav>
