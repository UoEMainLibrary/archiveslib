<?php header('Content-Type: text/html; charset=utf-8');

##call database connection
include "../../mgt_config/sql.php";
$atype = $_GET['atype'];
if ($_GET['atype'] == "EUA") {
$prefix1 = "EUA";
$prefix2 = "Acc";
} elseif ($_GET['atype'] == "MS") {
$prefix1 = "AMS";
$prefix2 = "E";
} elseif ($_GET['atype'] == "RBP") {
$prefix1 = "RBP";
$prefix2 = "acc";
}


$sql_str="SELECT * FROM cms_accessions WHERE acc_type LIKE '$atype' ORDER BY year, accession";
	 
	 $acc_search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	
	 
	## echo "<textarea>";
	 echo "\"accession_number_1\",\"accession_number_2\",\"accession_number_3\",\"accession_number_4\",\"accession_title\",\"accession_accession_date\",\"date_1_begin\",\"date_1_end\",\"date_1_expression\",\"date_1_type\",\"dates_1_date_type\",\"dates_1_label\",\"date_2_begin\",\"date_2_end\",\"date_2_expression\",\"date_2_type\",\"date_2_label\",\"extent_container_summary\",\"extent_dimensions\",\"extent_number\",\"extent_physical_details\",\"extent_portion\",\"extent_type\",\"accession_access_restrictions\",\"accession_access_restrictions_note\",\"accession_acknowledgement_sent\",\"accession_acknowledgement_sent_date\",\"accession_acquisition_type\",\"accession_agreement_received\",\"accession_agreement_received_date\",\"accession_agreement_sent\",\"accession_agreement_sent_date\",\"accession_cataloged\",\"accession_cataloged_date\",\"accession_cataloged_note\",\"accession_condition_description\",\"accession_content_description\",\"accession_disposition\",\"accession_general_note\",\"accession_inventory\",\"accession_processed\",\"accession_processed_date\",\"accession_processing_estimate\",\"accession_processing_hours_total\",\"accession_processing_plan\",\"accession_processing_priority\",\"accession_processing_started_date\",\"accession_processing_status\",\"accession_processing_total_extent\",\"accession_processing_total_extent_type\",\"accession_processors\",\"accession_provenance\",\"accession_publish\",\"accession_resource_type\",\"accession_restrictions_apply\",\"accession_retention_rule\",\"accession_rights_determined\",\"accession_rights_transferred\",\"accession_rights_transferred_date\",\"accession_rights_transferred_note\",\"accession_use_restrictions\",\"accession_use_restrictions_note\",\"agent_contact_address_1\",\"agent_contact_address_2\",\"agent_contact_address_3\",\"agent_contact_city\",\"agent_contact_country\",\"agent_contact_email\",\"agent_contact_fax\",\"agent_contact_name\",\"agent_contact_post_code\",\"agent_contact_region\",\"agent_contact_salutation\",\"agent_contact_telephone\",\"agent_contact_telephone_ext\",\"agent_name_authority_id\",\"agent_name_dates\",\"agent_name_description_citation\",\"agent_name_description_note\",\"agent_name_description_type\",\"agent_name_fuller_form\",\"agent_name_name_order\",\"agent_name_number\",\"agent_name_prefix\",\"agent_name_primary_name\",\"agent_name_qualifier\",\"agent_name_rest_of_name\",\"agent_name_rules\",\"agent_name_sort_name\",\"agent_name_source\",\"agent_name_subordinate_name_1\",\"agent_name_subordinate_name_2\",\"agent_name_suffix\",\"agent_role\",\"agent_type\",\"subject_source\",\"subject_term\",\"subject_term_type\",\"user_defined_boolean_1\",\"user_defined_boolean_2\",\"user_defined_date_1\",\"user_defined_date_2\",\"user_defined_integer_1\",\"user_defined_integer_2\",\"user_defined_real_1\",\"user_defined_real_2\",\"user_defined_string_1\",\"user_defined_string_2\",\"user_defined_string_3\",\"user_defined_text_1\",\"user_defined_text_2\",\"user_defined_text_3\",\"user_defined_text_4\",\"user_defined_text_5\"\r\n";

##echo "accession_number_1,accession_number_2,accession_number_3,accession_number_4,accession_title,accession_accession_date,date_1_begin,date_1_end,date_1_expression,date_1_type,dates_1_date_type,dates_1_label,date_2_begin,date_2_end,date_2_expression,date_2_type,date_2_label,extent_container_summary,extent_dimensions,extent_number,extent_physical_details,extent_portion,extent_type,accession_access_restrictions,accession_access_restrictions_note,accession_acknowledgement_sent,accession_acknowledgement_sent_date,accession_acquisition_type,accession_agreement_received,accession_agreement_received_date,accession_agreement_sent,accession_agreement_sent_date,accession_cataloged,accession_cataloged_date,accession_cataloged_note,accession_condition_description,accession_content_description,accession_disposition,accession_general_note,accession_inventory,accession_processed,accession_processed_date,accession_processing_estimate,accession_processing_hours_total,accession_processing_plan,accession_processing_priority,accession_processing_started_date,accession_processing_status,accession_processing_total_extent,accession_processing_total_extent_type,accession_processors,accession_provenance,accession_publish,accession_resource_type,accession_restrictions_apply,accession_retention_rule,accession_rights_determined,accession_rights_transferred,accession_rights_transferred_date,accession_rights_transferred_note,accession_use_restrictions,accession_use_restrictions_note,agent_contact_address_1,agent_contact_address_2,agent_contact_address_3,agent_contact_city,agent_contact_country,agent_contact_email,agent_contact_fax,agent_contact_name,agent_contact_post_code,agent_contact_region,agent_contact_salutation,agent_contact_telephone,agent_contact_telephone_ext,agent_name_authority_id,agent_name_dates,agent_name_description_citation,agent_name_description_note,agent_name_description_type,agent_name_fuller_form,agent_name_name_order,agent_name_number,agent_name_prefix,agent_name_primary_name,agent_name_qualifier,agent_name_rest_of_name,agent_name_rules,agent_name_sort_name,agent_name_source,agent_name_subordinate_name_1,agent_name_subordinate_name_2,agent_name_suffix,agent_role,agent_type,subject_source,subject_term,subject_term_type,user_defined_boolean_1,user_defined_boolean_2,user_defined_date_1,user_defined_date_2,user_defined_integer_1,user_defined_integer_2,user_defined_real_1,user_defined_real_2,user_defined_string_1,user_defined_string_2,user_defined_string_3,user_defined_text_1,user_defined_text_2,user_defined_text_3,user_defined_text_4,user_defined_text_5";

##echo "\r\n";
	 
	 while ($results = mysql_fetch_array($acc_search)):
	 
	 
	  if ($results['date'] <> '0000-00-00 00:00:00') {
	 $accession_date = substr($results['date'], 0, 4)."-".substr($results['date'], 5, 2)."-".substr($results['date'], 8, 2);
	 } else {
	 $accession_date = $results['year']."-1-1";
	 }
	 
 ## accession_number_1
 echo "\"".$prefix1."\",";
 ## accession_number_2
 echo "\"".$prefix2."\",";
 ## accession_number_3
 echo "\"".$results['year']."\",";
 ## accession_number_4
 echo "\"".sprintf("%03d",$results['accession'])."\",";
 ## accession_title
 echo "\"".preg_replace( "/\r|\n/", "", substr(utf8_encode(htmlspecialchars($results['description'])), 0, 50))."\",";
 ## accession_accession_date
 echo "\"".$accession_date."\",";
 ## date_1_begin
 echo "\"1500\",";
 ## date_1_end
 echo "\"2014\",";
 ## date_1_expression
 echo "\"1500-2014\",";
 ## dates_1_date_type
 echo "\"bulk\",";
 echo "\"bulk\",";
 ## dates_1_label
 echo "\"other\",";
 ## date_2_begin
 echo "\"\",";
 ## date_2_end
 echo "\"\",";
 ## date_2_expression
 echo "\"\",";
 ## date_2_type
 echo "\"\",";
 ## date_2_label
 echo "\"\",";
 ## extent_container_summary
 echo "\"".utf8_encode(htmlspecialchars($results['extent']))."\",";
 ## extent_dimensions
 echo "\"\",";
 ## extent_number
 echo "\"1\",";
 ## extent_physical_details
 echo "\"\",";
 ## extent_portion
 echo "\"\",";
 ## extent_type
 echo "\"Unquantified Amount\",";
 ## accession_access_restrictions
 if ($results['restrictions'] <> '') { echo "\"1\","; }
 else { echo "\"\","; }
 ## accession_access_restrictions_note
 echo "\"".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['restrictions'])))."\",";
 ## accession_acknowledgement_sent
 echo "\"\",";
 ## accession_acknowledgement_sent_date
 echo "\"\",";
 ## accession_acquisition_type
 echo "\"".utf8_encode(htmlspecialchars($results['type']))."\",";
 ## accession_agreement_received
 echo "\"\",";
 ## accession_agreement_received_date
 echo "\"\",";
 ## accession_agreement_sent
 echo "\"\",";
 ## accession_agreement_sent_date
 echo "\"\",";
 ## accession_cataloged
 echo "\"\",";
 ## accession_cataloged_date
 echo "\"\",";
 ## accession_cataloged_note
 echo "\"\",";
 ## accession_condition_description 
 echo "\"".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['phys_cond'])))."\",";
 ## accession_content_description
 ## accession_title
 echo "\"".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['description'])))."\",";
 ## accession_disposition
 echo "\"\",";
 ## accession_general_note
 echo "\"".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['comments'])))." || ".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['comments2'])))."\",";
 ## accession_inventory
 echo "\"\",";
 ## accession_processed
 echo "\"\",";
 ## accession_processed_date
 echo "\"\",";
 ## accession_processing_estimate
 echo "\"\",";
 ## accession_processing_hours_total
 echo "\"\",";
 ## accession_processing_plan
 echo "\"\",";
 ## accession_processing_priority
 echo "\"\",";
 ## accession_processing_started_date
 echo "\"\",";
 ## accession_processing_status
 echo "\"\",";
 ## accession_processing_total_extent
 echo "\"\",";
 ## accession_processing_total_extent_type
 echo "\"\",";
 ## accession_processors
 echo "\"\",";
 ## accession_provenance
 echo "\"".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['depositor'])))." || ".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['admin_biog'])))."\",";
 ## accession_publish
 echo "\"\",";
 ## accession_resource_type
 echo "\"\",";
 ## accession_restrictions_apply
 echo "\"\",";
 ## accession_retention_rule
 echo "\"\",";
 ## accession_rights_determined
 echo "\"\",";
 ## accession_rights_transferred
 echo "\"\",";
 ## accession_rights_transferred_date
 echo "\"\",";
 ## accession_rights_transferred_note
 echo "\"\",";
 ## accession_use_restrictions
 if ($results['copyright'] <> '') { echo "\"1\","; }
 else { echo "\"\","; }
 ## accession_use_restrictions_note
 echo "\"".utf8_encode(htmlspecialchars($results['copyright']))."\",";
 ## agent_contact_address_1
 echo "\"\",";
 ## agent_contact_address_2
 echo "\"\",";
 ## agent_contact_address_3
 echo "\"\",";
 ## agent_contact_city
 echo "\"\",";
 ## agent_contact_country
 echo "\"\",";
 ## agent_contact_email
 echo "\"\",";
 ## agent_contact_fax
 echo "\"\",";
 ## agent_contact_name
 echo "\"\",";
 ## agent_contact_post_code
 echo "\"\",";
 ## agent_contact_region
 echo "\"\",";
 ## agent_contact_salutation
 echo "\"\",";
 ## agent_contact_telephone
 echo "\"\",";
 ## agent_contact_telephone_ext
 echo "\"\",";
 ## agent_name_authority_id
 echo "\"\",";
 ## agent_name_dates
 echo "\"\",";
 ## agent_name_description_citation
 echo "\"\",";
 ## agent_name_description_note
 echo "\"\",";
 ## agent_name_description_type
 echo "\"\",";
 ## agent_name_fuller_form
 echo "\"\",";
 ## agent_name_name_order
 echo "\"\",";
 ## agent_name_number
 echo "\"\",";
 ## agent_name_prefix
 echo "\"\",";
 ## agent_name_primary_name
 echo "\"\",";
 ## agent_name_qualifier
 echo "\"\",";
 ## agent_name_rest_of_name
 echo "\"\",";
 ## agent_name_rules
 echo "\"\",";
 ## agent_name_sort_name
 echo "\"\",";
 ## agent_name_source
 echo "\"\",";
 ## agent_name_subordinate_name_1
 echo "\"\",";
 ## agent_name_subordinate_name_2
 echo "\"\",";
 ## agent_name_suffix
 echo "\"\",";
 ## agent_role
 echo "\"\",";
 ## agent_type
 echo "\"\",";
 ## subject_source
 echo "\"\",";
 ## subject_term
 echo "\"\",";
 ## subject_term_type
 echo "\"\",";
 ## user_defined_boolean_1
 echo "\"\",";
 ## user_defined_boolean_2
 echo "\"\",";
 ## user_defined_date_1
 echo "\"\",";
 ## user_defined_date_2
 echo "\"\",";
 ## user_defined_integer_1
 echo "\"\",";
 ## user_defined_integer_2
 echo "\"\",";
 ## user_defined_real_1
 echo "\"\",";
 ## user_defined_real_2
 echo "\"\",";
 ## user_defined_string_1
 echo "\"\",";
 ## user_defined_string_2
 echo "\"\",";
 ## user_defined_string_3
 echo "\"\",";
 ## user_defined_text_1
  echo "\"Shelfmark: ".utf8_encode(htmlspecialchars($results['shelfmark']))." || Location: ".utf8_encode(htmlspecialchars($results['location']))." || ".utf8_encode(htmlspecialchars($results['loc_other']))."\",";
 ## user_defined_text_2
 ## user_defined_text_3
  echo "\"Creator/author: ".preg_replace( "/\r|\n/", "", utf8_encode(htmlspecialchars($results['creator'])))."\","; 
 ## user_defined_text_4
  echo "\"Accessioned date: ".utf8_encode(htmlspecialchars($results['acc_date']))."\",";
 ## user_defined_text_5
  echo "\"Accessioned by: ".utf8_encode(htmlspecialchars($results['acc_by']))."\"";



	 
	 echo "\r\n";
	 endwhile;
	  	 
##  echo "</textarea>";
	  ?>