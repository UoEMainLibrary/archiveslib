<?php  $view = $_GET['view']; ?>

<html>
<head>
	<title>Image viewer</title>
</head>

<body>
<div>
<img src="https://archives.collections.ed.ac.uk/assets/uoeLogo.gif"/><img src="https://archives.collections.ed.ac.uk/assets/uoe/archivesspace.png"/>
<div style="background-color: #cccccc; height: 30; padding:15px">Examples: <a href="image.php?view=pdf&file=https://collections.ed.ac.uk/archivemedia/record/101974/5/EUA-IN14-4-Cywicki-Zbigniew.pdf">PDF</a> | <a href="image.php?view=iiif&manifest=https://images.is.ed.ac.uk/luna/servlet/iiif/m/UoEgal~5~5~150406~162876/manifest">IIIF</a> | <a href="image.php?view=stream&file=https://www.youtube.com/embed/0_-LW7rNiCg">Movie</a></div>
</div>
<div align="center"> 


<!-- specifics start -->

<?php 

echo "<p>View: ".$view."</p>";

$inc = $view.".php";

include $inc; 




?>
<!-- specifics end -->

</div>

<div>
  Footer text here  
</div>
</body>
</html>
