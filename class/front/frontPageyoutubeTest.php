<?php
class frontPageyoutubeTest extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		require_once 'util/youtubexml.class.php';
	
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		//$this->importCSS('youtubewidget.front');
		//$this->importJS('defaultFront');
		$modelSettings = new modelSettings();
		$youtubexml = new youtubexml();
		
		$iCount = $modelSettings->getCountDb();
		$aSetting = $modelSettings->getSetting();
		
			
			
		$aList = $youtubexml->videoList('most_discussed',true);
		
	
		$this->loopFetch($aList);
	
		//var_dump($aList);
		
		
	
	}
	
	
}