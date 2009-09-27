if(typeof SiteTreeHandlers == 'undefined') SiteTreeHandlers = {};
SiteTreeHandlers.parentChanged_url	= 'admin/content/ajaxupdateparent';
SiteTreeHandlers.orderChanged_url	= 'admin/content/ajaxupdatesort';
SiteTreeHandlers.loadPage_url		= 'admin/content/getitem';
SiteTreeHandlers.loadTree_url		= 'admin/content/getsubtree';

SideReports.prototype = {
	initialize: function() {
		this.selector = $('ReportSelector');
		if(this.selector) this.selector.holder = this;
		this.SidePanel.initialize();
	},
	
	destroy: function() {
		if(this.SidePanel) this.SidePanel.destroy();
		this.SidePanel = null;
		if(this.selector) this.selector.holder = null;
		this.selector = null;
	},
	
	onshow: function() {
		if(this.selector.value) this.showreport();
	},

	/**
	 * Retrieve a report via ajax
	 */	
	showreport: function() {
		if(this.selector.value) {
			this.body.innerHTML = '<p>loading...</p>';
			this.ajaxGetPanel(this.afterPanelLoaded);
		} else {
			this.body.innerHTML = "<p>choose a report in the dropdown.</p>";
		}
	},
	afterPanelLoaded : function() {
		SideReportRecord.applyTo('#' + this.id + ' a');
	},
	ajaxURL: function() {
		var url = 'admin/content/sidereport/' + this.selector.value;
		if($('LangSelector')) url += "?locale=" + $('LangSelector').value;
		return url;
	}
}