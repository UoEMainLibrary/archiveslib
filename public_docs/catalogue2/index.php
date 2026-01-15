<?php	include "includes/top_header.php";
echo "<title>Godfrey H. Thomson</title>";
		include "includes/lower_header.php"; ?>

<div class="search">
  <h2 class="front">SEARCH THE CATALOGUES</h2>
  <div class="holder">
  <form method="get" action="cs/searchcat.pl">
  <input name="term" type="text" size="45" maxlength="60" /></div>
  
  <div class="holder"><select name="results">
    <option value="10">10 results per page </option>
    <option value="25">25 results per page</option> 
    <option selected="selected" value="50">50 results per page</option> 
    <option value="100">100 results per page</option> 
    </select>
    </div>
    <div class="holder"><select name="mode"><option value="and">All of these words</option> 
    
   <option value="or">Any of these words</option> </select>
   <input value="Clear" type="reset">
&nbsp;&nbsp;
<input value="Search" type="submit">
   </form>
   
   </div>
   
   <div class="holder2"><a href="#"><img src="images/search.png" width="123" height="34" border="0" alt="Search" /></a><br />
    <a class="clear" href="#">clear</a></div>
   <div class="holder">or browse by authority terms:</div>
  <div class="browse"><ul id="base">
<li id="base1"><a href="http://www.archives.lib.ed.ac.uk/catalogue2/subj/a">Subject</a></li>
<li id="base3"><a href="http://www.archives.lib.ed.ac.uk/catalogue2/geog/a/">Geographic name</a></li>
<li id="base4"><a href="http://www.archives.lib.ed.ac.uk/catalogue2/pers/a/">Personal name</a></li>
<li id="base5"><a href="http://www.archives.lib.ed.ac.uk/catalogue2/corp/a/">Corporate name</a></li>
</ul></div> 
</div><div class="pict"><img src="images/gif.gif" alt="animated images from the collection" width="439" height="319" /></div><div class="clear"></div>



	<?	include "includes/footer.php"; ?>