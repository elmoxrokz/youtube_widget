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
			$result = $getModel->execSave($aArgs);
		}else{
			$getModel->execDelete();	
			$result = $getModel->execSave($aArgs);
		}
			
		if($result !== false){
       		usbuilder()->message('Saved succesfully', 'success');
		}else{
			usbuilder()->message('Save failed','warning');	
		}
      
		$sUrl = usbuilder()->getUrl('adminPageSetting');
        $sJsMove = usbuilder()->jsMove($sUrl);
        $this->writeJS($sJsMove);	
	}
	
}