<?php
class apiContentsInit extends Controller_Api
{
	protected function post($aArgs)
	{
		require_once 'builder/builderInterface.php';
		require_once 'util/youtubexml.class.php';
		
		$modelSettings = new modelSettings();
		$youtubexml = new youtubexml();
		
		$iCount = $modelSettings->getCountDb();
		$aSetting = $modelSettings->getSetting();
		
		if($iCount>0) {
		
			$aArgs['sCtgry'] = $aSetting['category'];
			$sOrder = $aSetting['tab_order'];
		} else {
		
			$aArgs['sCtgry'] = "Movies";
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
				$sCategory = $aArgs['sCtgry'];
			$fStndrd = false;
		}
		
		$aArgs['aOrder'] = $aOrder;
		$aArgs['aList'] =  $youtubexml->videoList($sCategory, $fStndrd);
		
		return $aArgs;
	}
	
}