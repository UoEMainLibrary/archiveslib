<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php

     $zip = new ZipArchive;
     $res = $zip->open(’/data/d4/archives/public_docs/admin/toolbox/upload/test.zip’);
     if ($res === TRUE) {
         $zip->extractTo(’/data/d4/archives/public_docs/admin/toolbox/upload/’);
         $zip->close();
         echo ‘ok’;
     } else {
         echo ‘failed’;
     }
?>
<body>
</body>
</html>
