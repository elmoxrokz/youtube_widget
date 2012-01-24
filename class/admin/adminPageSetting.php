<?php
class adminPageSetting extends Controller_Admin
{
	protected function run($aArgs)
	{
		require_once('builder/builderInterface.php');
		require_once('util/youtubexml.class.php');
		
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		$this->importJS('defaultAdmin');
		
		$youtubexml = new youtubexml();
		
		$modelSettings = new modelSettings();
		
		$this->display($aArgs,$youtubexml,$modelSettings);
		$this->save();
		
		$this->view(__CLASS__);
	}
	
	
	
	public function display($aArgs,$youtubexml,$modelSettings)
	{

		$aList = $youtubexml->categoryList();
		$iCount = $modelSettings->getCountDb();
	
		$aSetting = $modelSettings->getSetting();
		
		if($iCount > 0) {
			$sCategory = $aSetting['category'];
			$sOrder = $aSetting['tab_order'];
		
		} else {
			$sCategory = "Movies";
			$sOrder = "latest,popular,category";
		
		}
	
		$aOrder = array();
		$_aOrder = explode(",", $sOrder);
		
		

		foreach($_aOrder as $o) {
			if($o == "latest") {
				$aOrder[] = array(
						'alt' => $o,
						'text' => "Most Recent"
				);
			} else if($o == "popular") {
				$aOrder[] = array(
						'alt' => $o,
						'text' => "Most Popular"
				);
			} else {
				$aOrder[] = array(
						'alt' => $o,
						'text' => "By Category"
				);
			}
		}
		
		
		$this->assign('aList', $aList);
		$this->assign('sCategory', $sCategory);
		$this->assign('aOrder', $aOrder);
		
		$this->assign('aCount',$iCount);
		
		
	

	}
	
	public function save()
	{
		
		$sFormScript = usbuilder()->getFormAction('youtubewidgetSave', 'adminExecSave');
        $this->writeJs($sFormScript);
	}
	
	
}