<ul>
    <% if LatestSSNews %>
	    <% control LatestSSNews %><li>
	        <strong>$Title</strong><br/>
	        $Description.Summary(20)...<br/>
	        <a href='$Link' target="_blank">Read More</a>
	    </li>
	    <% end_control %>
	    <% if rss_link %>
			<li><a href="$rss_link" target="_blank"><% _t('Dashboard.GenericViewMore') %></a></li>
		<% end_if %>

    <% else %>
    	<li><% _t('Dashboard.LatestNewsNoStories') %></li>
    <% end_if %>
</ul>
