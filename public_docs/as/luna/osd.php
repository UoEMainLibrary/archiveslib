<?php 

$manifest= $_GET['manifest'];

## echo $manifest;
$manurl = "https://images.is.ed.ac.uk/luna/servlet/iiif/".$manifest."/info.json";

$manurl2 = "https://images.is.ed.ac.uk/luna/servlet/iiif/m/".$manifest."/manifest";

$j = 0;
        $manifestarray = array();
        $hasalma = false;
      //  while ($j < $imagecount)
      //  {
            $jobj = '';
            $json = file_get_contents($manurl2);
            $jobj = json_decode($json, true);
            $error = json_last_error();
            if ($jobj !== '')
            {
                if ($j == 0) {
                    $attribution = $jobj['attribution'];
                    $context = $jobj['@context'];
                    $label1 = $jobj['label'];
										echo "<title>".$label1."</title>";
                    $related = str_replace('iiif/m', 'detail', $manifestlist[$j]);
                    $related = str_replace('/manifest', '', $related);
                    $rand_no = bin2hex(openssl_random_pseudo_bytes(12));
										
										$thumb = $jobj['sequences'][0]['canvases'][0]['thumbnail']['@id'];
										echo "<img src='".$thumb."' alt='".$label."' height='0' width='0'/>";
										
                    foreach ($jobj['sequences'][0]['canvases'][0]['metadata'] as $metadatapair) {
                        $label = $metadatapair['label'];
                        $value = $metadatapair['value'];
												
												if ($label == "Shelfmark") {
                        $shelfmark = $value;												
											  }												
												if ($label == "Catalogue Number") {
                        $catnum = $value;												
											  }		
												if ($label == "Description") {
                        $desc = $value;												
											  }
												if ($label == "Licence") {
                        $licence = $value;												
											  }		
												if ($label == "Reference") {
                        $reference = $value;												
											  }									
												if ($label == "Catalogue Entry") {
                        $catlink = $value;	
												$catlink = str_replace ('<span>', '', $catlink);	
												$catlink = str_replace ('</span>', '', $catlink);											
											  }
												if ($label == "Media Group") {
                        $dolink = $value;	
												$dolink = str_replace ('<span>', '', $catlink);	
												$dolink = str_replace ('</span>', '', $catlink);											
											  }
                    }
                }
                $manifestarray[] = $jobj['sequences'][0]['canvases'][0];
            }
						
						 
						
            $j++;
						
						include "includes/lhead.php";
						echo "<h1>".$label1."</h1>";

 ?>
 



<div id="openseadragon1" style="width: 90%; border-width: thick; border-color: #000; background-color:#000000 "></div>
<script src="https://openseadragon.github.io/openseadragon/openseadragon.min.js"></script>
<script type="text/javascript">
    OpenSeadragon({
        id: "openseadragon1",
        prefixUrl: "https://librarylabs.ed.ac.uk/assets/openseadragon/images/",
        zoomPerScroll:1,
        tileSources: [
            "<?php echo $manurl; ?>"
    ]
    });
</script>


<br/>

<div align="left">

<?php echo "<p>".$refcode."</p>"; 

echo "<p><a href='".$catlink."'>".$catnum."</a>: ".$desc."</p>";

echo "<p><a href='".$dolink."'>".$reference."</a></p>";

echo "<p>".$licence."</p>";

echo "<p><a target='_blank' href='".$manurl2."'>View IIIF</a></p>";

// echo "<hr/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";

$man2 = file_get_contents($manurl2);

// echo "<textarea cols='150' rows='20'>";

 // echo $man2;

// echo "</textarea>";

 ?>
 </div>