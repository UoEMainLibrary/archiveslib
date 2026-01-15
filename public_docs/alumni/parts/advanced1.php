<h1><?php echo $pagetitle; ?></h1>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
<input type="hidden" name="view" value="results1" />
<table summary="" width="80%" cellpadding="5">
<tr><td class="label">Surname</td><td><input type="text" name="surname" value="<?php echo $surname ?>" /></td><td class="help">All or  beginning of surname</td></tr>
<tr><td class="label">Forename(s)</td><td><input type="text" name="forename" /></td><td class="help">All or  beginning of forename</td></tr>
<tr><td class="label">MD (Edin.)</td><td><input type="checkbox" name="mdedin" /></td><td class="help">Select to restrict to University of Edinburgh graduates (MD)</td></tr>
<tr><td class="label">FRCS</td><td><input type="checkbox" name="frcs" /></td><td class="help">Select to restrict to  Fellows of the Royal College of Surgeons of Edinburgh</td></tr>
<tr><td class="label">ARCS</td><td><input type="checkbox" name="arcs" /></td><td class="help">Select to restrict to Apprentices of the Royal College of Surgeons of Edinburgh</td></tr>
<tr><td class="label">DRCS</td><td><input type="checkbox" name="drcs" /></td><td class="help">Select to restrict to Diplomates (Licentiates) of the Royal College of Surgeons of Edinburgh</td></tr>
<tr><td class="label">RAMC</td><td><input type="checkbox" name="ramc" /></td><td class="help">Select to restrict to those who joined the Royal Army Medical Service</td></tr>
<tr><td class="label">RMS</td><td><input type="checkbox" name="rms" /></td><td class="help">Select to restrict to  members of the Royal Medical Society</td></tr>
<tr><td class="label">IMS</td><td><input type="checkbox" name="ims" /></td><td class="help">Select to restrict to  those who joined the Indian Medical Service</td></tr>
<tr><td class="label">Royal Navy</td><td><input type="checkbox" name="navy" /></td><td class="help">Select to restrict to  those who joined the Royal Navy</td></tr>
<tr><td class="label"></td><td><input type="submit" value="Search" /></td></tr>
</table>
</form>