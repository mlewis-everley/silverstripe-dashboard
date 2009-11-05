<div class="Dashboard tab">
	<% if get_plugins(alerts) %><div class="Alerts">
		<% control get_plugins(alerts) %>$Plugin<% end_control %>
	</div><% end_if %>

	<h1 id="DashboardTitle">
		<% _t('DASHBOARD','Dashboard') %>
		<% if visit_site_link %>
			<a class="revealLink" href="$visit_site_link" title="<% _t('VISIT SITE','Visit Site') %>">&raquo;<span><% _t('VISIT SITE','Visit Site') %></span></a>
		<% end_if %>
	</h1>

	<div class="DashboardItem Snippets">
		<% control get_plugins(snippet) %>
			<div class="Snippet <% if EvenOdd = odd %>snLeft<% end_if %>">
				<% control Plugin %>
					<h2 {$IconCSS}>
						$Title
						<% if Link %><a href="$Link" title="View all" class="revealLink">&raquo;<span>$LinkText</span></a><% end_if %>
					</h2>
				<% end_control %>
				<div class="Plugin">
					<p>$Plugin.Caption</p>
					$Plugin
				</div>
			</div>
			<% if EvenOdd = even %><div class="clear"></div><% end_if %>
		<% end_control %>

	</div>
		
	<% control get_plugins(full_width) %>
  		<div class="DashboardItem FullWidth $Class">
  			<% control Plugin %>
				<h2 {$IconCSS}>
					$Title
					<% if Link %><a href="$Link" title="View all" class="revealLink">&raquo;<span>$LinkText</span></a><% end_if %>
				</h2>
			<% end_control %>
			<div class="Plugin">$Plugin</div>
		</div>
	<% end_control %>

</div>