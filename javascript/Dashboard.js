var GB_ANIMATION = true;

jQuery(document).ready(function(){
	// perform initial resize of main content area
	resizeWindow();
	
	// If the User resizes the window, adjust the #container height
	jQuery(window).bind("resize", resizeWindow);
	
	// Create popup window for links with class 'popup'
	jQuery("a.popup").click(function(){
		var t = this.title || this.innerHTML || this.href;
		GB_show(t,this.href,390,560);
		return false;
	});
	
	// Generate conformation box for delete lists
	jQuery("a.delete").click(function(){
		toDelete = confirm('Are you sure you wish to delete this item?');
		
		if(toDelete == true) {
			jQuery(this).load(
				jQuery(this).attr('href'),
				null,
				function(){
					window.location.reload(true);
				}
			);
			return false;
		} else
			return false;
		
	});
	
		
	// Add show hide buttons to each header
	jQuery(".Dashboard h2").each(function() {
		jQuery(this).html('<span class="floatright showHide"> +</span>' + jQuery(this).html());
		jQuery(this).children('span.showHide').click(function() {
			jQuery(this).parent().next().slideToggle();
			if(jQuery(this).text() == '-')
				jQuery(this).html('+');
			else
				jQuery(this).html('-');
		});
	});
	
	if(!(jQuery("div.Alerts div.Alert").html()))
		jQuery("div.Alerts").hide();
});

// Resizes main content window to match browser height
function resizeWindow( e ) {
	var RightHeight	= (parseInt(jQuery('#right').height()) - 20);
	jQuery("#right .Dashboard").css("height", RightHeight );
}