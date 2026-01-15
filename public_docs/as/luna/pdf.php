<?php 

$file = $_GET['file']; ?>

<div>
<object data="<?php echo $file; ?>" type="application/pdf" width="80%" height="80%">
<p>Your browser is not displaying the embedded file - Please <a href="<?php echo $file; ?>">Download PDF file here</a>.</p>
</object>
</div>

