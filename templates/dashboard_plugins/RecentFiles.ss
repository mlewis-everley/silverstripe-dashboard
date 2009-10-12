<h3>
	<a href="admin/assets/" title="View all files" class="floatright">View All</a>
	Recent Files
</h3>
<p>Your site's most recently uploaded/edited files</p>
<% if RecentFiles %>
	<ul><% control RecentFiles %>
		<li>
			<a class="edit popup" title="Edit file" href="admin/assets/EditForm/field/Files/item/$ID/edit" target="_blank"><span>Edit</span></a>
			<a href="$Link">$Title</a> <span class="addition">$LastEdited.Ago</span>
		</li>
	<% end_control %></ul>
<% else %>
	<p><em>Your site currently has no files</em></p>
<% end_if %>
