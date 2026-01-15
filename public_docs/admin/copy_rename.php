<?
echo "<p>Hrello</p>";

$oldfilepath = "/data/d4/archives/public_docs/cwdata/eac";
$newfilepath = "/data/d4/archives/catalogue_source_docs/authorities/eacxml";

if ($handle = opendir($oldfilepath)) {
   while (false !== ($oldfile = readdir($handle))) {
       if ($oldfile != "." && $oldfile != "..") {
	   
	   $oldfile_str = $oldfilepath."/".$oldfile;
	   echo $oldfile_str." &gt; ";
	   
	   $newfile = str_replace ("p", "", $oldfile);
	   
	   $newfile_str = $newfilepath."/".$newfile;
	   echo $newfile_str."<br>";
	   
	   if (!copy($oldfile_str, $newfile_str)) {
  	  echo "failed to copy $oldfile_str to $newfile_str<br>";
	} else {
	echo "Copied $oldfile_str to $newfile_str<br>";
	   }
	   }
	 }
	}