<?php include "/data/d4/archives/mgt_config/sql.php";

$authstore = "/data/d4/archives/authstore";

 	 $sql_str="SELECT * FROM cms_auth_geog";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 while ($results = mysql_fetch_array($termsearch)):
	 
	 $FileName = $authstore . "/geog/" . $results['id'] . ".txt";
	 $FileContent = $results['term']." ".$results['island']." ".$results['city']." ".$results['territory']." ".$results['county']." ".$results['country']." ".$results['continent'];
	 
	 echo $FileName . "<br>";
	 
$FileHandle = fopen($FileName, 'w') or die("can't open file");

fwrite($FileHandle, $FileContent); 

fclose($FileHandle);

	 
	 endwhile;
	 
	  	 $sql_str="SELECT * FROM cms_auth_subj";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 while ($results = mysql_fetch_array($termsearch)):
	 
	 $FileName = $authstore . "/subj/" . $results['id'] . ".txt";
	 $FileContent = $results['term'];
	 
	 echo $FileName . "<br>";
	 
$FileHandle = fopen($FileName, 'w') or die("can't open file");

fwrite($FileHandle, $FileContent); 

fclose($FileHandle);

	 
	 endwhile;
	 
 	 $sql_str="SELECT * FROM cms_auth_pers";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 while ($results = mysql_fetch_array($termsearch)):
	 
	 $FileName = $authstore . "/pers/" . $results['id'] . ".txt";	 
	 
	 if ($results['given_name'] <> '') { $given_name_str = " | ".$results['given_name']; } else { $given_name_str = ''; }
if ($results['terms_of_address'] <> '') { $terms_of_address_str = " | ".$results['terms_of_address']; } else { $terms_of_address_str = ''; }
if ($results['date'] <> '') { $date_str = " | ".$results['date']; } else { $date_str = ''; }
if ($results['description'] <> '') { $description_str = " | ".$results['description']; } else { $description_str = ''; }

$nca_str = $results['family_name'] . $given_name_str . $terms_of_address_str . $date_str . $description_str;

if ($results2['given_name'] <> '') { $given_name_str2 = " | ".$results2['given_name']; } else { $given_name_str2 = ''; }
if ($results2['terms_of_address'] <> '') { $terms_of_address_str2 = " | ".$results2['terms_of_address']; } else { $terms_of_address_str2 = ''; }
if ($results2['date'] <> '') { $date_str2 = " | ".$results2['date']; } else { $date_str2 = ''; }
if ($results2['description'] <> '') { $description_str2 = " | ".$results2['description']; } else { $description_str2 = ''; }

$nca_str2 = $results2['family_name'] . $given_name_str2 . $terms_of_address_str2 . $date_str2 . $description_str2;

if ($results3['given_name'] <> '') { $given_name_str3 = " | ".$results3['given_name']; } else { $given_name_str3 = ''; }
if ($results3['terms_of_address'] <> '') { $terms_of_address_str3 = " | ".$results3['terms_of_address']; } else { $terms_of_address_str3 = ''; }
if ($results3['date'] <> '') { $date_str3 = " | ".$results3['date']; } else { $date_str3 = ''; }
if ($results3['description'] <> '') { $description_str3 = " | ".$results3['description']; } else { $description_str3 = ''; }

$nca_str3 = $results3['family_name'] . $given_name_str3 . $terms_of_address_str3 . $date_str3 . $description_str3;

	 $FileContent = $nca_str;
	 
	 echo $FileName . "<br>";
	 
$FileHandle = fopen($FileName, 'w') or die("can't open file");

fwrite($FileHandle, $FileContent); 

fclose($FileHandle);

	 
	 endwhile;
	 
	  	 $sql_str="SELECT * FROM cms_auth_corp";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 while ($results = mysql_fetch_array($termsearch)):
	 
	 $FileName = $authstore . "/corp/" . $results['id'] . ".txt";	 
	 
## construct NCA rules version of a name

unset($secondary_name_str, $date_str, $description_str, $location_str, $secondary_name_str2, $date_str2, $description_str2, $location_str2, $secondary_name_str3, $date_str3, $description_str3, $location_str3);

if ($results['secondary_name'] <> '') { $secondary_name = " | ".$results['secondary_name']; }
if ($results['date'] <> '') { $date_str = " | ".$results['date']; }
if ($results['description'] <> '') { $description_str = " | ".$results['description']; }
if ($results['location'] <> '') { $location_str = " | ".$results['location']; }

$nca_str = $results['primary_name'] . $secondary_name_str . $date_str . $description_str . $location_str;

if ($results2['secondary_name'] <> '') { $secondary_name2 = " | ".$results2['secondary_name']; }
if ($results2['date'] <> '') { $date_str2 = " | ".$results2['date']; }
if ($results2['description'] <> '') { $description_str2 = " | ".$results2['description']; }
if ($results2['location'] <> '') { $location_str2 = " | ".$results2['location']; }

$nca_str2 = $results2['primary_name'] . $secondary_name_str2 . $date_str2 . $description_str2 . $location_str2;

if ($results3['secondary_name'] <> '') { $secondary_name3 = " | ".$results3['secondary_name']; }
if ($results3['date'] <> '') { $date_str3 = " | ".$results3['date']; }
if ($results3['description'] <> '') { $description_str3 = " | ".$results3['description']; }
if ($results3['location'] <> '') { $location_str3 = " | ".$results3['location']; }

$nca_str3 = $results3['primary_name'] . $secondary_name_str3 . $date_str3 . $description_str3 . $location_str3;



	 $FileContent = $nca_str;
	 
	 echo $FileName . "<br>";
	 
$FileHandle = fopen($FileName, 'w') or die("can't open file");

fwrite($FileHandle, $FileContent); 

fclose($FileHandle);

	 
	 endwhile;
?>