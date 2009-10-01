/**
 * This file overwrites the default behaviour for the left hand pane under "Site Content",
 * allowing for AJAX requests to the URL admin/cms as apposed to just admin
 */

/* ---------------------------------------------------------- */

// Overwrite main Ajax scripts for site tree
if(typeof SiteTreeHandlers == 'undefined') SiteTreeHandlers = {};
SiteTreeHandlers.parentChanged_url	= 'admin/cms/ajaxupdateparent';
SiteTreeHandlers.orderChanged_url	= 'admin/cms/ajaxupdatesort';
SiteTreeHandlers.loadPage_url		= 'admin/cms/getitem';
SiteTreeHandlers.loadTree_url		= 'admin/cms/getsubtree';
SiteTreeHandlers.showRecord_url = 'admin/cms/show/';
SiteTreeHandlers.controller_url = 'admin/cms/';

/* ---------------------------------------------------------- */

// Overwrite version history Ajax links
SidePanel.prototype = {
	initialize : function() {
		this.body = this.getElementsByTagName('div')[0];
	},
	destroy: function() {
		this.body = null;		
	},
	onshow : function() {
		this.onresize();
		this.body.innerHTML = '<p>loading...</p>';
		this.ajaxGetPanel(this.afterPanelLoaded);
	},
	onresize : function() {
		fitToParent(this.body);
	},
	ajaxGetPanel : function(onComplete) {
		fitToParent(this.body);
		new Ajax.Updater(this.body, this.ajaxURL(), {
			onComplete : onComplete ? onComplete.bind(this) : null,
			onFailure : this.ajaxPanelError
		});
	},
	
	ajaxPanelError : function (response) {
		errorMessage("error getting side panel", response);
	},
	
	ajaxURL : function() {
		var srcName = this.id.replace('_holder','');				
		var id = $('Form_EditForm').elements.ID;
		if(id) id = id.value; else id = "";
		
		// This assumes that admin/cms/ refers to CMSMain
		var url = 'admin/cms/' + srcName + '/' + id + '?ajax=1';
		if($('Form_EditForm_Locale')) url += "&locale=" + $('Form_EditForm_Locale').value;
		return url;
	},
	
	afterPanelLoaded : function() {
	},
	onpagechanged : function() {
	}
}

VersionList.prototype = {
	initialize : function() {
		this.mode = 'view';
		this.SidePanel.initialize();
	},
	destroy: function() {
		this.SidePanel = null;
		this.onclose = null;
	},
	
	ajaxURL : function() {
		return this.SidePanel.ajaxURL() + '&unpublished=' + ($('versions_showall').checked ? 1 : 0);
	},
	afterPanelLoaded : function() {
		this.idLoaded = $('Form_EditForm').elements.ID.value;
		VersionItem.applyTo('#' + this.id + ' tbody tr');
	},
	
	select : function(pageID, versionID, sourceEl) {
		if(this.mode == 'view') {
			sourceEl.select();
			var url = 'admin/cms/getversion/' + pageID + '/' + versionID;
			if($('Form_EditForm_Locale')) url += "?locale=" + $('Form_EditForm_Locale').value;
			$('Form_EditForm').loadURLFromServer(url);
			$('viewArchivedSite').style.display = '';
			$('viewArchivedSite').getVars = '?archiveDate=' + sourceEl.getElementsByTagName('td')[1].className;
			
		} else {
			$('viewArchivedSite').style.display = 'none';

			if(this.otherVersionID) {
				sourceEl.select();
				this.otherSourceEl.select(true);
				statusMessage('Loading comparison...');
				var url = 'admin/cms/compareversions/' + pageID + '/?From=' + this.otherVersionID + '&To=' + versionID;
				if($('Form_EditForm_Locale')) url += "&locale=" + $('Form_EditForm_Locale').value;
				$('Form_EditForm').loadURLFromServer(url);
			} else {
				sourceEl.select();
			}
		}
		this.otherVersionID = versionID;
		this.otherSourceEl = sourceEl;
	},
	onpagechanged : function() {
		if(this.idLoaded != $('Form_EditForm').elements.ID.value) {
			this.body.innerHTML = '<p>loading...</p>';
			this.ajaxGetPanel(this.afterPanelLoaded);
		}
	},
	refresh : function() {
		this.ajaxGetPanel(this.afterPanelLoaded);
	},
	onclose : function() {
		if(this.idLoaded) {
			$('Form_EditForm').getPageFromServer(this.idLoaded);
		}
		$('viewArchivedSite').style.display = 'none';
	}
}

/* ---------------------------------------------------------- */

// Overwrite ajax scripts for site reports
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
		var url = 'admin/cms/sidereport/' + this.selector.value;
		if($('LangSelector')) url += "?locale=" + $('LangSelector').value;
		return url;
	}
}