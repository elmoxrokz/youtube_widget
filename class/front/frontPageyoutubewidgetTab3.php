<?php
class frontPageyoutubewidgetTab3 extends Controller_front
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
			
		if($iCount>0) {
			$sCtgry = $aSetting['category'];	
		} else {
			$sCtgry = "Movies";	
		}
			
		$aList3 =  $youtubexml->videoList($sCtgry, false);
			
				
		
		/*
		 $aList1 =  $youtubexml->videoList($sCategory, $fStndrd);
		 $aList2 =  $youtubexml->videoList('most_recent', true);
		 $aList3 =  $youtubexml->videoList('most_popular', true);
		*/
		
		 $this->loopFetch($aList3);
		 
		if(count($aList3) <= 0){
			$this->fetchClear();
		}
		
		
		
	
		
	
	}
	
	
}