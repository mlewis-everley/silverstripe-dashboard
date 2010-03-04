<ul>
    <% if LatestSSNews %>
    <% control LatestSSNews %><li>
        <strong>$Title</strong><br/>
        $Description.Summary(20)...<br/>
        <a href='$Link' target="_blank">Read More</a>
    </li>
    <% end_control %>
    <li><a href="http://www.silverstripe.org/blog/" target="_blank">View more stories</a></li>
    
    <% else %>
    <li>Unable to find any news stories.</li>
    <% end_if %>
</ul>
