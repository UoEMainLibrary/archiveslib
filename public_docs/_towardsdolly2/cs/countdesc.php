<?php
function count_deep($folder, $filetype = "basic.html", $count_folders = false) {
	$c = 0;
	$dirs = array($folder);
	while($dir = each($dirs)) {
		foreach(glob($dir[1]."/*", GLOB_ONLYDIR) as $filename) {
			$dirs[] = $filename;
		}
		$c += count(glob($dir[1]."/".$filetype));
	}
	if(!$count_folders && ($filetype == "*")) $c -= (count($dirs)-1);
	return $c;
}

echo count_deep("/home/archives/towardsdolly_catalogue_repository/isad");
?>