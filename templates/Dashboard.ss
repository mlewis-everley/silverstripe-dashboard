<div id="Dashboard" class="tab">
	<h1 id="DashboardTitle"><% _t('DASHBOARD', 'Site Content') %></h1>
	<div class="dashboardItem SiteInfo">
		<h2>Your site at a glance:</h2>
		<p>$SiteInfo</p>
	</div>
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
				<h3>Recently Edited</h3>
				<p>Your sites 10 most recently edited pages.</p>
				<ul><% control RecentPages %>
					<li>
						<a class="edit" title="edit" href="admin/show/$ID"><span>Edit</span></a>
						<a href="$Link">$Title</a> <span class="addition">$LastEdited.Ago</span>
					</li>
				<% end_control %></ul>
			</div>
			<div class="snippet">
				<h3>
					<a href="admin/comments/" class="floatright">View All</a>
					Recent Files
				</h3>
				<p>Your sites 10 most recently uploaded/edited files</p>
				<ul><% control RecentFiles %>
					<li>
						<a class="edit" title="edit" href="admin/assets/EditForm/field/Files/item/$ID/edit" target="_blank"><span>Edit</span></a>
						<a href="$Link">$Title</a> <span class="addition">$LastEdited.Ago</span>
					</li>
				<% end_control %></ul>
			</div>
		</div>
		
		<div class="dashboardItem Comments">
			<h2>
				<a href="admin/comments/" class="floatright">View All</a>
				<% _t('UMODCOMMENTS', 'Unmoderated comments') %>
			</h3>
			<ul><% control CommentUMod %>
				<li class="dotted <% if Even %>snLeft<% end_if %>">
					By <strong>$Name</strong> at <% if CommenterURL %><a href="$CommenterURL">$CommenterURL</a><% end_if %> for page/post: <% control Parent %><a href="$Link">$Title</a><% end_control %><br/>
					<em>"$Comment"</em><br/>
					<span class="addition">Written $Created.Ago</span>
				</li>
			<% end_control %>
			</ul>
		</div>
	</div>
</div>