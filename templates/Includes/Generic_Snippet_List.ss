<% if GenericSnippetList %>
	<ul><% control GenericSnippetList %>
		<li>
			<% if Top.EditLink %>
				<a class="edit <% if Top.EditPopup %>popup<% end_if %>" title="Edit <% if Title %>$Title<% end_if %>" href="$Top.EditLink/<% if ID %>$ID/edit<% end_if %>">
					<span>Edit</span>
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