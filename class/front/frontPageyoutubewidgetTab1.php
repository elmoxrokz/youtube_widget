<?php
class frontPageyoutubewidgetTab1 extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		require_once 'util/youtubexml.class.php';
	
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		$this->importCSS('youtubewidget.front');
		//$this->importJS('defaultTest');
		$modelSettings = new modelSettings();
		$youtubexml = new youtubexml();
		
		$iCount = $modelSettings->getCountDb();
		$aSetting = $modelSettings->getSetting();
		
			
			
		$aList1 =  $youtubexml->videoList('most_recent', true);
			

	
		$this->loopFetch($aList1);
		
		if(count($aList1) <= 0){
		
			$this->fetchClear();
		}
		
		
		
	
		
	
	}
	
	
}