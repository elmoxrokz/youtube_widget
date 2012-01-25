<?php
class frontPageyoutubeTest2 extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';

		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		
		$modelSettings = new modelSettings();
	
		
		$iCount = $modelSettings->getCountDb();
		$aSetting = $modelSettings->getSetting();
		
		$aTab = explode(",",$aSetting['tab_order']);
		foreach($aTab as $key => $val){
			
		$tab_order[$key]['aOrder'] = $val;
		}
		
		//var_dump($tab_order);
		$this->loopFetch($tab_order);
		
		
		
	
	}
	
	
}