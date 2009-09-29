<div class="Dashboard">
	<div class="dashboardItem SiteInfo">
		<h2>Your site</h2>
		<p>At a glance:</p>
		<% if SiteInfo %><ul>
			<% control SiteInfo %><li>$Number $Item</li><% end_control %>
		</ul><% end_if %>
	</div>
	<div class="dashboardItem SSNews">
		<h2>Silverstripe news</h2>
		<ul>
			<% control LatestSSNews %><li>
				<strong>$Title</strong><br/>
				$Description.Summary(20)...<br/>
				<a href='$Link' target="_blank">Read More</a>
			</li><% end_control %>
			<li><a href="http://www.silverstripe.org/blog/" target="_blank">View more stories</a></li>
		</ul>
	</div>
</div>