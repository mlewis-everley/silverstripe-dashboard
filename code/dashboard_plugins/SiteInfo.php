<?php

class SiteInfo extends DashboardPlugin {
	static $position = "left";
	static $sort = 0;
	static $title = "Site info";
	static $icon = "dashboard/images/22/blackbox.png";

	/**
	 * SiteInfo gets a quick summary of all items in SiteTree, all Files (excluding folders) and members.
	 * 
	 * @return DataObjectSet
	 */
	public function Site() {
		$output = new DataObjectSet();

		$pages		= DataObject::get('SiteTree');
		$pages		= $pages ? $pages->Count() : 0;
		$pagesStr	= ($pages == 1) ? 'page' : 'pages';
		$output->push(new ArrayData(array(
			'Number' => $pages,
			'Item' => $pagesStr
		)));

		$files		= DataObject::get('File', "ClassName <> 'Folder'");
		$files		= $files ? $files->Count() : 0;
		$filesStr	= ($files == 1) ? 'file' : 'files';
		$output->push(new ArrayData(array(
			'Number' => $files,
			'Item' => $filesStr
		)));
		
		$members	= DataObject::get('Member');
		$members	= $members ? $members->Count() : 0;
		$membersStr	= ($members == 1) ? 'member' : 'members';
		$output->push(new ArrayData(array(
			'Number' => $members,
			'Item' => $membersStr
		)));
		
		return $output;
	}
}