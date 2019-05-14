<?php

$query="SELECT * FROM message where status=0;";
$run=mysqli_query($conn,$query);
?>
<a href="message.php">
    <div class="right-sidebar">

<div class="panel panel-blue">

<div class="panel-heading"><h5>Messages</h5>
</div>

</div>

<div class="panel">

<div class="info-stats green-two">

<div class="icon-type pull-left"><i class="icon-announcement"></i>
</div>

<div class="sale-num"><h4><?php echo mysqli_num_rows($run);?></h4>

<p>New Messages</p>
</div>
</div>
</div>
</div>
    
</a>