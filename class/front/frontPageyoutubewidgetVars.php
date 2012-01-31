<?php
class frontPageyoutubewidgetVars extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		require_once 'util/youtubexml.class.php';
	
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
				
		$this->assign('devArea1', 'offline');
		$this->assign('devArea2', 'online');
		
		
		
	
		
	
	}
	
	
}