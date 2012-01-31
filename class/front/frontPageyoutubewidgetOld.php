<?php
class frontPageyoutubewidgetOld extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		require_once 'util/youtubexml.class.php';

		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		$this->importCSS('youtubewidget.front');
		$this->importJS('defaultFront');


		$sHtml = '<div id="pg_simpleyoutube_holder"></div>';
		$this->assign('youtubewidget',$sHtml);

	}

}
