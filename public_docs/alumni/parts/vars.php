<?php	## define all variables 
	
				$datatitle1= "Students of Medicine, 1762-1826";
				$datatitle2= "Students of Medicine (sample of 205), 1833-1846";
				$datatitle3= "Graduates in Veterinary Medicine, 1911-1955";
				$datatitle4= "Students at New College, 1843-1943";
				$datatitle5= "First Matriculations, 1890-1899";
				$datatitle6= "Laureation &amp; Degrees, 1587-1809";
				$datatitle7= "Awards to Women students, 1876-1894";
				$datatitle8= "Early Veterinary Graduates, 1825-1865";
				$datatitle9= "Extra Academical students, 1887-1922";
				
				## identify valid date for Data Protection
				$timestamp = getdate();
				$validyear = ($timestamp["year"]-75);
		
		## variables from forms		
				$view = isset($_GET['view']) ? $_GET['view'] : null;
				$data = isset($_GET['data']) ? $_GET['data'] : null;
				$id = isset($_GET['id']) ? $_GET['id'] : null;
				$surname = isset($_GET['surname']) ? $_GET['surname'] : null;
				$forename = isset($_GET['forename']) ? $_GET['forename'] : null;
				$gender = isset($_GET['gender']) ? $_GET['gender'] : null;
  				
				$mdedin_var = isset($_GET['mdedin']) ? $_GET['mdedin'] : null;				
 				if ($mdedin_var == 'on') {
					$mdedin = 1;
				}

				$frcs_var = isset($_GET['frcs']) ? $_GET['frcs'] : null;
				if ($frcs_var == 'on') {
					$frcs = 1;
				}

				$arcs_var = isset($_GET['arcs']) ? $_GET['arcs'] : null;
				if ($arcs_var == 'on') {
					$arcs = 1;
				}

				$drcs_var = isset($_GET['drcs']) ? $_GET['drcs'] : null;
				if ($drcs_var == 'on') {
					$drcs = 1;
				}

				$ramc_var = isset($_GET['ramc']) ? $_GET['ramc'] : null;
				if ($ramc_var == 'on') {
					$ramc = 1;
				}

				$rms_var = isset($_GET['rms']) ? $_GET['rms'] : null;
				if ($rms_var == 'on') {
					$rms = 1;
				}

				$ims_var = isset($_GET['ims']) ? $_GET['ims'] : null;
				if ($ims_var == 'on') {
					$ims = 1;
				}

				$navy_var = isset($_GET['navy']) ? $_GET['navy'] : null;
				if ($navy_var == 'on') {
					$navy = 1;
				} ?>
