<?php
class frontPageyoutubewidget extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';

		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		$this->importCSS('youtubewidget.front');
		$this->importJS('defaultFront');
		
		$modelSettings = new modelSettings();
	
		$iCount = $modelSettings->getCountDb();
		$aSetting = $modelSettings->getSetting();
		
	
		if($iCount>0) {
			$sOrder = $aSetting['tab_order'];
		} else {
			$sOrder = "latest,popular,category";
		}
		
		
		$aOrder = array();
	
		$_aOrder = explode(",", $sOrder);
		
		foreach($_aOrder as $key => $val)
		{
			if($val == "latest"){
				$aOrder[] = array('title' => "Most Recent", 'text' => $val);	
			}elseif($val == "popular"){
				$aOrder[] = array('title' => "Most Popular", 'text' => $val);
			}else{
				$aOrder[] = array('title' => "By Category", 'text' => $val);
			}
		}
			
		$this->loopFetch($aOrder);
		
		
				
	
	}
	
	
}