<?php
class frontPageyoutubeTest3 extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';

		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		$this->importCSS('youtubewidget.front');
		$this->importJS('defaultTest');
		
		$modelSettings = new modelSettings();
	
		
		$aSetting = $modelSettings->getSetting();
		
		$this->assign('category', $aSetting[category]);
		
	}
}
		