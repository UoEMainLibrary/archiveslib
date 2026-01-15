<?php	include "includes/top_header.php";
echo "<title>Archives and Manuscripts catalogue</title>";
		include "includes/cat_header.php";
		include "includes/lower_header.php"; ?>

<div class="searchform">
<table summary="" border="0" class="searchform" cellpadding="10" width="600">
<form method="get" action="cs/searchcat.pl">
<tr>
<td class="label">
Search for:
</td>
<td>
<input type="text"
name="term" maxlength="60" size="45" value=""></td>
<td>
<select name="mode">
<option value="and">All of these words</option>
<option value="or">Any of these words</option>
</select></td>
</tr>
<tr>
<td class="label"></td>
<td>
<select name="results">
<option value="10">10 results per page</option>
<option value="25">25 results per page</option>
<option value="50" selected="yes">50 results per page</option>
<option value="100">100 results per page</option>
</select></td>
<td>
<input type="reset" value="Clear">
&nbsp;&nbsp;
<input type="submit" value="Search"></td>
</tr>
</form>
<tr>
<td class="label">
Browse by authority terms:
</td>
<td colspan="2" class="content">
<a href="subj/a/">Subject</a> | <a href="genr/a/">Genre</a> | <a href="geog/a/">Geographic name</a> | <a href="pers/a/">Personal name</a> | <a href="corp/a/">Corporate name</a> | <a href="fami/a/">Family name</a>
<p>Please note that not all collection catalogues have yet been indexed by authority terms.  <br/>This browse facility will ONLY locate those where this work has been done.</p>

<!--<p>Browse by <a href="collections.php">collection</a>.  Note these are University Archives only, not (as yet) our other collections of manuscripts and archives.</p>-->
</td>
</tr>
<tr><td class="label" style="height:50px;"></td></tr>
<tr><td class="label"></td><td colspan="2" class="content">
<!--<p style="font-size:smaller"><?php##include "/home/archives/bin/file.txt"; ?>.  Number of descriptions (all levels): <?php##include "includes/countdesc.php" ?>.</p>-->
</td></tr>
</table>
</div>

	<?	include "includes/footer.php"; ?>