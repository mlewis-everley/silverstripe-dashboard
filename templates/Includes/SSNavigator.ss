<div id="SilverStripeNavigator">
	<div class="holder">
		<div id="logInStatus">
			<% if CurrentMember %><% control CurrentMember %>
				Logged in as $FirstName - <a href="Security/logout">Log out</a>
			<% end_control %><% else %>
				Not logged in - <a href="Security/login" id="LoginLink">log in</a>
			<% end_if %>
		</div>
		
		<div id="switchView" class="bottomTabs">
			<a href="$adminLink" target="cms">CMS</a>
			<a href="$cmsLink/$ID" target="cms">Edit Page</a>
			<% if DisplayMode == Stage %>
				<a class="current">Draft Site</a>
				<div class="blank" style="width:1em;"> </div>
				<a target="site" style="left : -1px;" href="$Link?stage=Live">Published Site</a>
			<% else_if DisplayMode == Live %>
				<a target="site" style="left : -1px;" href="$Link?stage=Stage">Draft Site</a>
				<div class="blank" style="width:1em;"> </div>
				<a class="current">Published Site</a>
			<% else_if DisplayMode == Archived %>
				<a target="site" style="left : -1px;" href="$Link?stage=Stage">Draft Site</a>
				<div class="blank" style="width:1em;"> </div>
				<a target="site" style="left : -1px;" href="$Link?stage=Live">Published Site</a>
				<div class="blank" style="width:1em;"> </div>
				<a class="current">Archived Site</a>
			<% end_if %>
		</div>
	</div>
</div>
<% if DisplayMode == Stage %>
	<div id="SilverStripeNavigatorMessage" title='Note: this message will not be shown to your visitors'>Draft Site</div>
<% else_if DisplayMode == Live %>
	<div id="SilverStripeNavigatorMessage" title='Note: this message will not be shown to your visitors'>Published Site</div>
<% else_if DisplayMode == Archived %>
	<div id="SilverStripeNavigatorMessage" title='Note: this message will not be shown to your visitors'>Archived Site<br/>$ArDate.Nice</div>
<% end_if %>
		
