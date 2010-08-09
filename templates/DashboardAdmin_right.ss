<div class="Dashboard tab">
    <% if EditMode %>
        $EditForm
    <% else %>
        <% control Dashboard %>
            $HalfWidthWidgets
        <% end_control %>
    <% end_if %>
</div>