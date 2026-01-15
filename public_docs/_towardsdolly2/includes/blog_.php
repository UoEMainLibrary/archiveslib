<table summary="" align="right" width="400" cellpadding="0" border="0">

<tr>
<td width="15"></td>
<td>

    <!-- ++Begin Dynamic Feed Wizard Generated Code++ -->
  <!--
  // Created with a Google AJAX Search and Feed Wizard
  // http://code.google.com/apis/ajaxsearch/wizards.html
  -->

  <!--
  // The Following div element will end up holding the actual feed control.
  // You can place this anywhere on your page.
  -->
  <div id="feed-control">
    <span style="color:#676767;font-size:11px;margin:10px;padding:4px;">Loading...</span>
  </div>

  <!-- Google Ajax Api
  -->
  <script src="http://www.google.com/jsapi?key=notsupplied-wizard"
    type="text/javascript"></script>

  <!-- Dynamic Feed Control and Stylesheet -->
  <script src="http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.js"
    type="text/javascript"></script>
  <style type="text/css">
    @import url("http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.css");
  </style>

  <script type="text/javascript">
    function LoadDynamicFeedControl() {
      var feeds = [
	{title: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View our Project Blog&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
	 url: 'http://towardsdolly.wordpress.com/wp-rss2.php'
	}];
      var options = {
        stacked : true,
        horizontal : false,
        title : "  "
      }

      new GFdynamicFeedControl(feeds, 'feed-control', options);
    }
    // Load the feeds API and set the onload callback.
    google.load('feeds', '1');
    google.setOnLoadCallback(LoadDynamicFeedControl);
  </script>
<!-- ++End Dynamic Feed Control Wizard Generated Code++ -->


</td>
</tr>
</table>
