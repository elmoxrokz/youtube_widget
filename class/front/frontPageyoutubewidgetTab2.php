<?php
class frontPageyoutubewidgetTab2 extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		require_once 'util/youtubexml.class.php';
	
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		$this->importCSS('youtubewidget.front');
		
		$modelSettings = new modelSettings();
		$youtubexml = new youtubexml();
		
	
		$aSetting = $modelSettings->getSetting();
		
			
		$aList2 =  $youtubexml->videoList('most_popular', true);
			
				
		$this->loopFetch($aList2);
		 
		if(count($aList2) <= 0){
		
			$this->fetchClear();
		}
		
		
		
	
		
	
	}
	
	
}