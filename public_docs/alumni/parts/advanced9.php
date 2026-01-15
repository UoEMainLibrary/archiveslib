<h1><?php echo $pagetitle; ?></h1>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
<input type="hidden" name="view" value="results9" />
<table summary="" width="80%" cellpadding="5">
<tr><td class="label">Surname</td><td><input type="text" name="surname" value="<?php echo $surname ?>" /></td><td class="help">All or  beginning of surname</td></tr>
<tr><td class="label">Forename(s)</td><td><input type="text" name="forename" value="<?php echo $forename ?>" /></td><td class="help">All or  beginning of forename</td></tr>
<tr><td class="label"></td><td><input type="submit" value="Search" /></td></tr>
</table>
</form>