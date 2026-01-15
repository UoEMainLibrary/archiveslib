<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php$func = $_POST['func']; 
$file = $_POST['file'];?>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
enctype="multipart/form-data">
<input type="hidden" name="func" value="upload" />
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form>

<?php if ($func == "upload") {


  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	  
	  
require_once('lib/pclzip.lib.php');

$archive = new PclZip("upload/" . $_FILES["file"]["name"]);

if ($archive->extract(PCLZIP_OPT_PATH, dirname(__FILE__).'/zip') == 0) {
    echo "\n error while extract";
} else {
    echo "\n extract ok";
}



	
	
      }
    }

   
  
  
} ?>

</body>
</html>
