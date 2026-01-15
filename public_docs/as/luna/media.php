<?php  $view = $_GET['view'];

include "includes/uhead.php";



 ?>


<!-- <div style="background-color: #cccccc; height: 30; padding:15px">Examples: <a href="media.php?view=pdf&file=https://collections.ed.ac.uk/archivemedia/record/101974/5/EUA-IN14-4-Cywicki-Zbigniew.pdf">PDF</a> | <a href="media.php?view=iiif&manifest=https://images.is.ed.ac.uk/luna/servlet/iiif/m/UoEgal~5~5~150406~162876/manifest">IIIF</a> | <a href="media.php?view=audio&file=https://collections.ed.ac.uk/archivemedia/record/47228/1/0071013s.mp3">Audio</a> | <a href="media.php?view=movie&file=https://www.youtube.com/embed/0_-LW7rNiCg">Movie</a></div>
</div> -->



<!-- specifics start -->

<?php 

// echo "<p>View: ".$view."</p>";

$inc = $view.".php";

include $inc; 

include "includes/foot.php"; ?>
