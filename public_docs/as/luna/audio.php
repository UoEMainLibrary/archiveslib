<?php 

$file = $_GET['file']; ?>

<div>


<audio controls>
  <source src="<?php echo $file; ?>" type="audio/mp3">
  Your browser does not support the audio tag.
</audio>

</div>

