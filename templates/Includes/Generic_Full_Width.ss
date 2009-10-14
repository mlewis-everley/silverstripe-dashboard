<% if GenericFullWidth %>
  	<ul>
	   <% control GenericFullWidth %>
		  <li class="dotted <% if Even %>snLeft<% end_if %>">
  			<% if Author %>By <strong>$Author</strong>;<% end_if %>
			<% if URL %>Website: <a href="$URL">$URL</a>;<% end_if %><br/>
			<% if Title %><strong>$Title</strong>:<% end_if %>
  			<% if Content %><em>"$Content"</em><br/><% end_if %>
  			<% if Date %><span class="addition">Date $Date.Ago</span><% end_if %>
		  </li>
    </ul>
	<% end_control %>
<% else %>
	<p><em>$NullMessage</em></p>
<% end_if %>

