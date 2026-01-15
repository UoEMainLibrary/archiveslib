<?php include "../includes/top_header.shtml"; ?>
<title>Edinburgh University Archives: Gallery</title>
<?php include "../includes/l_head_gal.shtml";  
	 include "../includes/gallery_menu.shtml"; 
	 $self = "gallery.php";
	 $view = $_GET['view'];
	 $id = $_GET['id'];
	 if (!isset ($view)) { 
	 
 $row = 1;
$handle = fopen("test.csv", "r");
echo "<table border=0 cellpadding=5 width=100%>";
echo "<tr><td width='150'><b>Reference code</b></td><td><b>Creator</b></td><td><b>Title</b></td></tr>";
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    //echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
		echo "<tr>";
    echo "<td>".$data[1]."</td><td>".$data[2]."</td><td><a href='".$self."?view=item&amp;id=".$data[0]."'>".$data[3]."</a></td>";
    echo "</tr>";
}
echo "</table>";
fclose($handle);
 
 
 } else if ($view == "item") { 

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

 }  ?>
 
 

<?php include "../includes/footer_gal.shtml"; ?>
