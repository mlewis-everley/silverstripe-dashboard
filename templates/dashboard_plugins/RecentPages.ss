<h3>
	<a href="admin/cms/" title="View all pages" class="floatright">View All</a>
	Recently Edited
</h3>
<p>Your site's most recently edited pages.</p>
<% if RecentPages %>
	<ul><% control RecentPages %>
		<li>
			<a class="edit" title="edit" href="admin/cms/show/$ID"><span>Edit</span></a>
			<a href="$Link">$Title</a> <span class="addition">$LastEdited.Ago</span>
		</li>
	<% end_control %></ul>
<% else %>
	<p><em>You site currently has no pages</em></p>
<% end_if %>
