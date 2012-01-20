<?php
class youtubexml
{
	
	public function categoryList()
	{
		$aCategories = array();	
			
		$sCatURL = 'http://gdata.youtube.com/schemas/2007/categories.cat';
		
		$sXML = $this->download_page($sCatURL);
	
		$oXML = new SimpleXMLElement($sXML);

		$oXML->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
		$categories = $oXML->xpath('//atom:category');
    
		foreach ($categories as $c) {
			$aCategories[] = array(
				'term' => $c['term'],
				'label' => $c['label']
			);
		}

		return $aCategories;
	}
	
	

	public function videoList($category, $standard_ctgry= true)
	{
		if($standard_ctgry) {
			$feedURL = 'http://gdata.youtube.com/feeds/api/standardfeeds/' . $category;
		} else {
			$feedURL = 'http://gdata.youtube.com/feeds/api/videos/-/' . $category . '/';
		}

		$sXML = $this->download_page($feedURL);
		$oXML = new SimpleXMLElement($sXML);

		$aRecent = array();
		foreach ($oXML->entry as $entry) {
			$media = $entry->children('http://search.yahoo.com/mrss/');

			if($media->group->player) {
				$attrs = $media->group->player->attributes();
				$sWatch = $attrs['url'];
			
				$attrs = $media->group->thumbnail[0]->attributes();
				$sThumbnail = $attrs['url'];

				$yt = $media->children('http://gdata.youtube.com/schemas/2007');
				$attrs = $yt->duration->attributes();
				$iLength = $attrs['seconds']; 
			
				$yt = $entry->children('http://gdata.youtube.com/schemas/2007');
				if($yt->statistics) {
					$attrs = $yt->statistics->attributes();
					$iViewCount = $attrs['viewCount']; 
				} else {
					$iViewCount = 0;
				}

				$gd = $entry->children('http://schemas.google.com/g/2005'); 
				if ($gd->rating) {
					$attrs = $gd->rating->attributes();
					$iRating = $attrs['average']; 
				} else {
					$iRating = 0; 
				}
			} else {
				$sWatch = "http://www.youtube.com";
				$iLength = 0;
				$iViewCount = "?";
				$iRating = "?";
			}

			$sTitle = strval($media->group->title);
			$sTitle = strlen($sTitle) > 25 ? substr($sTitle, 0, 22) . "..." : $sTitle;

			$sAuthor = strval($entry->author->name);
			$sAuthor = strlen($sAuthor) > 15 ? substr($sAuthor,0, 12) . "..." : $sAuthor;
			
			$iLength = intval($iLength);
			$iMins = floor($iLength / 60);
			$iSecs = $iLength % 60;
			$sSecs = $iSecs < 10 ? "0" . $iSecs : $iSecs;
			$sTime = $iMins . ":" . $sSecs;
			
			$aRecent[] = array(
				'title' => $sTitle,
				'author' => $sAuthor,
				'description' => strval($media->group->description),
				'watch' => strval($sWatch),
				'thumbnail' => strval($sThumbnail),			
				'views' => number_format(strval($iViewCount)),
				'length' => $sTime,
				'rating' => strval($iRating)
			);
		}
		return $aRecent;
	}

	public function download_page($path)
	{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$path);
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $retValue = curl_exec($ch);                      
        curl_close($ch);

        return $retValue;
	}
}
?>