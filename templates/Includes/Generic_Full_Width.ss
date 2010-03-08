<% if GenericFullWidth %>
	<ul>
		<% control GenericFullWidth %>
			<li class="dotted <% if Even %>snLeft<% end_if %>">
				<% if Author %><% _t('Dashboard.GenericAuthorBy') %> <strong>$Author</strong>;<% end_if %>
				<% if URL %><% _t('Dashboard.GenericWebsite') %>: <a href="$URL">$URL</a>;<% end_if %><br/>
				<% if Title %><strong>$Title</strong>:<% end_if %>
				<% if Content %><em>"$Content"</em><br/><% end_if %>
				<% if Date %><span class="addition"><% _t('Dashboard.GenericDate') %> $Date.Ago</span><% end_if %>
				<% if DeleteLink %><a class="delete" title="<% _t('Dashboard.GenericDelete') %> <% if Title %>$Title<% end_if %>" href="$DeleteLink"><span><% _t('Dashboard.GenericDelete') %></span></a><% end_if %>
				<% if EditLink %><a class="edit <% if Top.EditPopup %>popup<% end_if %>" title="<% _t('Dashboard.GenericEdit') %> <% if Title %>$Title<% end_if %>" href="$EditLink"><span><% _t('Dashboard.GenericEdit') %></span></a><% end_if %>
			</li>
			<% if EvenOdd = even %><li class="clear"></li><% end_if %>
		<% end_control %>
	</ul>
<% else %>
	<p><em>$NullMessage</em></p>
<% end_if %>