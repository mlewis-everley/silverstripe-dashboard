<div class="Dashboard tab">
	<h1 id="DashboardTitle"><% _t('DASHBOARD', 'Dashboard') %></h1>
	<% control Alerts %>
		<div class="alert">$Content</div>
	<% end_control %>
	<% control Notices %>
		<div class="notice">$Content</div>
	<% end_control %>
	<div class="Items">
		<div class="dashboardItem Activity">
			<h2><% _t('RECENTACTIVITY', 'Recent Activity') %></h2>
			<div class="snippet snLeft">
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
			</div>
			<div class="snippet">
				<h3>
					<a href="admin/assets/" title="View all files" class="floatright">View All</a>
					Recent Files
				</h3>
				<p>Your site's most recently uploaded/edited files</p>
				<% if RecentFiles %>
					<ul><% control RecentFiles %>
						<li>
							<a class="edit" title="edit" href="admin/assets/EditForm/field/Files/item/$ID/edit" target="_blank"><span>Edit</span></a>
							<a href="$Link">$Title</a> <span class="addition">$LastEdited.Ago</span>
						</li>
					<% end_control %></ul>
				<% else %>
					<p><em>Your site currently has no files</em></p>
				<% end_if %>
			</div>
		</div>
		
		<div class="dashboardItem Comments">
			<h2>
				<a href="admin/comments/" title="View comments" class="floatright">View All</a>
				<% _t('UMODCOMMENTS', 'Unmoderated comments') %>
			</h3>
			<% if CommentMod %>
				<ul><% control CommentUMod %>
					<li class="dotted <% if Even %>snLeft<% end_if %>">
						By <strong>$Name</strong> at <% if CommenterURL %><a href="$CommenterURL">$CommenterURL</a><% end_if %> for page/post: <% control Parent %><a href="$Link">$Title</a><% end_control %><br/>
						<em>"$Comment"</em><br/>
						<span class="addition">Written $Created.Ago</span>
					</li>
				<% end_control %>
			<% else %>
				<p><em>Your site currently has no unmoderated comments</em></p>
			<% end_if %>
			</ul>
		</div>
	</div>
</div>