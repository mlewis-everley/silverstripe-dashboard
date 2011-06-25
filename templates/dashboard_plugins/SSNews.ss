<ul>
    <% if LatestSSNews %>
        <% control LatestSSNews %><li>
            <strong>$Title</strong><br/>
            $Description.Summary(20)...<br/>
            <a href='$Link' target="_blank">Read More</a>
            </li>
        <% end_control %>
    
        <% if RssLink %>
            <li><a href="$RssLink" target="_blank"><% _t('Dashboard.GenericViewMore', 'View More') %></a></li>
        <% end_if %>

    <% else %>
        <li><% _t('Dashboard.LatestNewsNoStories','Unable to find any articles') %></li>
    <% end_if %>
</ul>
