<% if GenericSnippetList %>
	<ul><% control GenericSnippetList %>
		<li>
			<a class="edit <% if Top.EditPopup %>popup<% end_if %>" title="Edit $Title" href="$Top.EditLink/$ID/edit"><span>Edit</span></a>
			<a href="$Link">$Title</a> <span class="addition">$LastEdited.Ago</span>
		</li>
	<% end_control %></ul>
<% else %>
	<p><em>$NullMessage</em></p>
<% end_if %>