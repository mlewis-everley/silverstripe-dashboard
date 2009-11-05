<% if GenericFullWidth %>
	<ul>
		<% control GenericFullWidth %>
			<li class="dotted <% if Even %>snLeft<% end_if %>">
				<% if Author %>By <strong>$Author</strong>;<% end_if %>
				<% if URL %>Website: <a href="$URL">$URL</a>;<% end_if %><br/>
				<% if Title %><strong>$Title</strong>:<% end_if %>
				<% if Content %><em>"$Content"</em><br/><% end_if %>
				<% if Date %><span class="addition">Date $Date.Ago</span><% end_if %>
				<% if DeleteLink %><a class="delete" title="Delete <% if Title %>$Title<% end_if %>" href="$DeleteLink"><span>Delete</span></a><% end_if %>
				<% if EditLink %><a class="edit <% if Top.EditPopup %>popup<% end_if %>" title="Edit <% if Title %>$Title<% end_if %>" href="$EditLink"><span>Edit</span></a><% end_if %>
			</li>
			<% if EvenOdd = even %><li class="clear"></li><% end_if %>
		<% end_control %>
	</ul>
<% else %>
	<p><em>$NullMessage</em></p>
<% end_if %>