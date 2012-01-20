<?php
class apiContentsYoutubeWidget extends Controller_Api
{
    protected function post($aArgs)
    {
       
        require_once('util/youtubexml.class.php');
        $oYoutube = new youtubexml;
        
       	$sCtgry = $aArgs['category']; 
		$sByCat = $aArgs['ctgry'];

		switch($sCtgry) {
			case 'latest':
				$sCategory = "most_recent";
				$fStndrd = true;
				break;
			case 'popular':
				$sCategory = "most_popular";
				$fStndrd = true;
				break;
			default:
				$sCategory = $sByCat;
				$fStndrd = false;
		}

 		
		return $oYoutube->videoList($sCategory, $fStndrd);

    }
}