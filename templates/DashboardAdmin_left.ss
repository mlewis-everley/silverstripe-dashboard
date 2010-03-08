<div class="Dashboard">
	<% control get_plugins(left) %>
		<div class="DashboardItem $Class">
			<% control Plugin %>
				<h2 {$IconCSS}>
					<% if Link %><a href="$Link" title="$LinkText" class="floatright">$LinkText</a><% end_if %>
					$Title
				</h2>
			<% end_control %>
			<div class="Plugin">$Plugin</div>
		</div>
	<% end_control %>
</div>