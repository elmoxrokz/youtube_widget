<?php
class frontPageyoutubeTest2 extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';

		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		$this->importCSS('youtubewidget.front');
		$this->importJS('defaultTest');
		
		$modelSettings = new modelSettings();
	
		
		$iCount = $modelSettings->getCountDb();
		$aSetting = $modelSettings->getSetting();
		
	
		
		if($iCount>0) {
		
			$sCtgry = $aSetting['category'];
			$sOrder = $aSetting['tab_order'];
		} else {
		
			$sCtgry = "Movies";
			$sOrder = "latest,popular,category";
		}
		
		
		$aOrder = array();
		$_aOrder = explode(",", $sOrder);
		
		$iCtr = 0;
		foreach($_aOrder as $o) {
			if($o == "latest") {
				$sCl = $iCtr == 0 ? "on" : "off";
				$aOrder[] = array(
						'alt' => $o,
						'text' => "Most Recent",
						'cl' => $sCl,
						'id' => 'pg_sy_tab_' . $o
				);
			} else if($o == "popular") {
				$sCl = $iCtr == 0 ? "on" : "off";
				$aOrder[] = array(
						'alt' => $o,
						'text' => "Most Popular",
						'cl' => $sCl,
						'id' => 'pg_sy_tab_' . $o
				);
			} else {
				$sCl = $iCtr == 0 ? "on" : "off";
				$aOrder[] = array(
						'alt' => $o,
						'text' => "By Category",
						'cl' => $sCl,
						'id' => 'pg_sy_tab_' . $o
				);
			}
			$iCtr++;
		}
		
		$sMode = $aOrder[0]['alt'];
		
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
		
		
		

		$this->loopFetch($aOrder);
		
				
	
	}
	
	
}