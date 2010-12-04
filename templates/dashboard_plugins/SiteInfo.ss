<p><% _t('Dashboard.SiteInfoGlance','At a glance') %>:</p>
<% if Site %><ul>
	<% control Site %><li>$Number $Item</li><% end_control %>
</ul><% end_if %>