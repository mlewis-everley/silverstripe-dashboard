/* Greybox Redux
 * Required: http://jquery.com/
 * Written by: John Resig
 * Based on code by: 4mir Salihefendic (http://amix.dk)
 * License: LGPL (read more in LGPL.txt)
 */

var GB_DONE = false;
var GB_HEIGHT = 400;
var GB_WIDTH = 400;

function GB_show(caption, url, height, width) {
	try {
  GB_HEIGHT = height || 400;
  GB_WIDTH = width || 400;
  if(!GB_DONE) {
    jQuery("body")
      .append("<div id='GB_overlay'></div><div id='GB_window'><div id='GB_caption'></div>"
        + "<div class=\"close\">Close</div></div>");
    jQuery("#GB_window div.close").click(GB_hide);
    jQuery("#GB_overlay").click(GB_hide);
    jQuery(window).resize(GB_position);
    GB_DONE = true;
  }

  jQuery("#GB_frame").remove();
  jQuery("#GB_window").append("<iframe id='GB_frame' src='"+url+"'></iframe>");

  jQuery("#GB_caption").html(caption);
  jQuery("#GB_overlay").show();
  GB_position();

  if(GB_ANIMATION)
    jQuery("#GB_window").slideDown("slow");
  else
    jQuery("#GB_window").show();
	} catch(e) {
		alert( e );
	}
}

function GB_hide() {
  jQuery("#GB_window,#GB_overlay").hide();
  window.location.reload(true);
}

function GB_position() {
  var de = document.documentElement;
  var w = self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	jQuery("#GB_window").css({width:GB_WIDTH+"px",height:GB_HEIGHT+"px",
    left: ((w - GB_WIDTH)/2)+"px" });
  jQuery("#GB_frame").css("height",GB_HEIGHT - 32 +"px");
}
