<?php
$shellscript = "/data/d4/archives/bin/build_repository";

exec($shellscript,$output,$status); 

foreach ($output as $text) {

echo "<p>".$text."</p>";

}

echo "Exit status code of command is $status";
?> 