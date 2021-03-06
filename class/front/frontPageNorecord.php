<?php
class frontpageNorecord extends Controller_front
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
		
		$iCount = $modelSettings->getCountDb();
		$aSetting = $modelSettings->getSetting();
		
			
		
		if($iCount>0) {
		
			$sCtgry = $aSetting['category'];
			$sOrder = $aSetting['tab_order'];
		} else {
		
			$sCtgry = "Movies";
			$sOrder = "latest,popular,category";
		}
		
		
	
		$_aOrder = explode(",", $sOrder);
		
		
		$sMode = $_aOrder[0];
		
		switch($sMode) {
			case 'latest':
				$sCategory = "most_recent";
				$fStndrd = true;
				break;
			case 'popular':
				$sCategory = "most_popular";
				$fStndrd = true;
				break;
			default:
				$sCategory = $sCtgry;
				$fStndrd = false;
		}
		
		
		 $aList =  $youtubexml->videoList($sCategory, $fStndrd);

		if(count($aList) > 0){
			$this->fetchClear();
		}
		
		
		
	
	}
	
	
}