<?php

class adminExecSave extends Controller_AdminExec
{
	protected function run($aArgs)
	{
		require_once('builder/builderInterface.php');
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		$getModel = new modelSettings();
	
		
		if($getModel->getCountDb() == 0){
		$getModel->execSave($aArgs);
		}else{
		$getModel->execDelete();	
		$getModel->execSave($aArgs);
		}
       	usbuilder()->message('Saved succesfully', 'success');
       	
		$sUrl = usbuilder()->getUrl('adminPageSetup');
        $sJsMove = usbuilder()->jsMove($sUrl);
        $this->writeJS($sJsMove);
		
	}
	
}