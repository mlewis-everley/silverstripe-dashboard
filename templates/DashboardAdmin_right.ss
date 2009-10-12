<div class="Dashboard tab">
	<% if get_plugins(alerts) %><div class="Alerts">
		<% control get_plugins(alerts) %>$Plugin<% end_control %>
	</div><% end_if %>

	<h1 id="DashboardTitle"><% _t('DASHBOARD','Dashboard') %></h1>

	<div class="DashboardItem Snippets">
		<% control get_plugins(snippet) %>
			<div class="Snippet <% if EvenOdd = odd %>snLeft<% end_if %>">
				<% control Plugin %>
					<h2 {$IconCSS}>
						<% if Link %><a href="$Link" title="View comments" class="floatright">$LinkText</a><% end_if %>
						$Title
					</h2>
					<p>$Caption</p>
				<% end_control %>
				$Plugin
			</div>
			<% if EvenOdd = even %><div class="clear"></div><% end_if %>
		<% end_control %>

	</div>
		
	<% control get_plugins(full_width) %>
  		<div class="DashboardItem FullWidth $Class">
  			<% control Plugin %>
				<h2 {$IconCSS}>
					<% if Link %><a href="$Link" title="View comments" class="floatright">$LinkText</a><% end_if %>
					$Title
				</h2>
			<% end_control %>
			$Plugin
		</div>
	<% end_control %>

</div>