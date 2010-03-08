<% if GenericSnippetList %>
	<ul><% control GenericSnippetList %>
		<li>
			<% if DeleteLink %><a class="delete" title="<% _t('Dashboard.GenericDelete') %> <% if Title %>$Title<% end_if %>" href="$DeleteLink"><span><% _t('Dashboard.GenericDelete') %></span></a><% end_if %>
			<% if EditLink %>
				<a class="edit <% if EditPopup %>popup<% end_if %>" title="<% _t('Dashboard.GenericEdit') %> <% if Title %>$Title<% end_if %>" href="$EditLink">
					<span><% _t('Dashboard.GenericEdit') %></span>
				</a>
			<% end_if %>
			<% if Title %>
				<% if URL %><a href="$URL">$Title</a>
				<% else %>$Title<% end_if %>
			<% end_if %>
			<% if Date %><span class="addition">$Date.Ago</span><% end_if %>
		</li>
	<% end_control %></ul>
<% else %>
	<p><em>$NullMessage</em></p>
<% end_if %>