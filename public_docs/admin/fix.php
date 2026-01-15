<?php
if ($handle = opendir('/data/d4/archives/source_docs/isad_initial')) {
   while (false !== ($file = readdir($handle))) {
       if ($file != "." && $file != "..") {
           echo "$file";
					
					$output_dir = "../../source_docs/isad_fixed/";
					$output_file = $output_dir.$file;
echo "<p>Processing ".$file." . . .";
$str = file_get_contents('/data/d4/archives/source_docs/isad_initial/'.$file); 
echo " . . .";
$str2 = preg_replace('/\s\s+/', ' ', $str); 
echo " . . .";
$fh=fopen($output_file,"w+"); 
echo " . . .";
fwrite($fh,$str2); 
echo " . . .";
fclose($fh);
echo "</p><hr />";
       }
   }
   closedir($handle);
}
?> 
