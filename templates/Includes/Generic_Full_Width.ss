<% if GenericFullWidth %>
  	<ul>
	   <% control GenericFullWidth %>
		  <li class="dotted <% if Even %>snLeft<% end_if %>">
  			By <strong>$Name</strong> at <% if CommenterURL %><a href="$CommenterURL">$CommenterURL</a><% end_if %> for page/post: <% control Parent %><a href="$Link">$Title</a><% end_control %><br/>
  			<em>"$Comment"</em><br/>
  			<span class="addition">Written $Created.Ago</span>
		  </li>
    </ul>
	<% end_control %>
<% else %>
	<p><em>$NullMessage</em></p>
<% end_if %>

