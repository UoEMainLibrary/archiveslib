<?php
$id = $_GET['id'];
$row = 1;
$handle = fopen("test.csv", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    //echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    //for ($c=0; $c < $num; $c++) {
     //   echo $data[$c] . "<br />\n";
    //}
		if ($data[0] == $id) { ?>
		<table summary="" width="100%" border="1">

<tr><td>ID</td><td><?php echo $data[0]; ?></td></tr>
<tr><td>Reference Code</td><td><?php echo $data[1]; ?></td></tr>
<tr><td>Creator</td><td><?php echo $data[2]; ?></td></tr>
<tr><td>Title</td><td><?php echo $data[3]; ?></td></tr>

</table>
		
	<?	}
}
fclose($handle);
?> 