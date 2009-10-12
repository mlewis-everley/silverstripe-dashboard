var GB_ANIMATION = true;

jQuery(document).ready(function(){
	resizeWindow();
	
	//If the User resizes the window, adjust the #container height
	jQuery(window).bind("resize", resizeWindow);
	
	jQuery("a.popup").click(function(){
		var t = this.title || this.innerHTML || this.href;
		GB_show(t,this.href,390,560);
		return false;
	});
});

function resizeWindow( e ) {
	var RightHeight	= (parseInt(jQuery('#right').height()) - 20);
	jQuery("#right .Dashboard").css("height", RightHeight );
}