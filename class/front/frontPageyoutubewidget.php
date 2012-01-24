<?php
class frontPageyoutubewidget extends Controller_front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		require_once 'util/youtubexml.class.php';
		
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		$this->importCSS('youtubewidget.front');
		$this->importJS('defaultFront');
		$modelSettings = new modelSettings();
		$youtubexml = new youtubexml();

		$this->display($aArgs,$modelSettings,$youtubexml);
		
	}

	public function display($aArgs,$modelSettings,$youtubexml)
	{	
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

		$aList = $youtubexml->videoList($sCategory, $fStndrd);
		
		
$sHtml .= '				

		<div id="pg_simpleyoutube_holder">
			<div class="pg_simpleyoutube_maincontent">
				<ul class="pg_simpleyoutube_tabs">';
		
				foreach($aOrder as $val){
					$sHtml .= '<li class="'.$val['cl'].'"><a href="#" id="'.$val['id'].'" id2="'.$val['alt'].'" class="pg_sy_tab" onclick="frontPageyoutubewidget.tab_change(this);"><span>'.$val['text'].'</span></a></li>';
				}
				
				$sHtml .= '</ul>
				
				<div class="pg_simpleyoutube_list">
					<ul class="pg_simpleyoutube_popular">';
					if(count($aList) > 0){
						foreach($aList as $key => $val)
						{
					
							$sHtml .= '<li class="pg_simpleyoutube_item">
							<div class="pg_simpleyoutube_preview"><a href="'.$val['watch'].'" target="_blank"><img src="'.$val['thumbnail'].'" alt="thumbnail" width="108" height="65"/><p class="pg_sy_time">'.$val['length'].'</p></a></div>
							<p class="pg_simpleyoutube_item_title"><a href="'.$val['watch'].'" >'.$val['title'].'</a></p>
							<p class="pg_simpleyoutube_item_author">by'.$val['author'].'</p>	
							<p class="pg_simpleyoutube_item_views"> '.$val['views'].' views</p>
							</li>';
						}
					}else{
					$sHtml .= '<li id="no_vids_avail">Sorry, the videos for this category are not available at the moment. You may change the category in the admin settings.</li>';
					}
					$sHtml .= '</ul>
				</div>
				<div id="pg_simpleyoutube_init_front" />
					<input type="hidden" name="pg_simpleyoutube_pluginurl" id="pg_simpleyoutube_pluginurl" value="" />
					<input type="hidden" name="pg_simpleyoutube_ajaxurl" id="pg_simpleyoutube_ajaxurl" value="/youtubeJson.php" />
					<input type="hidden" name="pg_simpleyoutube_ctgry_category" id="pg_simpleyoutube_ctgry_category" value="'.$sCtgry.'" />
				</div>
			</div>
  
</div>					
					';

					
		$this->assign('youtubewidget',$sHtml);
	}
	
}
