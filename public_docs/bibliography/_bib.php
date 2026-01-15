<?php

## echo "<div><div>";

 $url = "http://catalogue.lib.ed.ac.uk/vwebv/holdingsInfo?bibId=".$bibresults['voyagerId'];
## $url = "http://catalogue.lib.ed.ac.uk/vwebv/holdingsInfo?bibId=39982";
$homepage = file_get_contents($url);

$a = strstr($homepage, "<div class=\"bibTags\">");

$b = strstr($a, "<div class=\"holdingsLabel\">");

$c = str_replace($b, '', $a);

$d = str_replace('search?', 'http://catalogue.lib.ed.ac.uk/vwebv/search?', $c)."<a href='http://catalogue.lib.ed.ac.uk/vwebv/holdingsInfo?bibId=".$bibresults['voyagerId']."'>View full catalogue record</a></li></ul>";

$e = str_replace('bibTags', 'abc', $d);

echo $e;

echo "</div>";
?>