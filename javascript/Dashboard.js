jQuery(document).ready(function(){
	resizeWindow();
	
	//If the User resizes the window, adjust the #container height
	jQuery(window).bind("resize", resizeWindow);
}); 

function resizeWindow( e ) {
	var RightHeight	= (parseInt(jQuery('#right').height()) - 20);
	jQuery("#right .Dashboard").css("height", RightHeight );
}