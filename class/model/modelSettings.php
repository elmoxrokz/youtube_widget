<?php
class modelSettings extends Model
{
	
	
	public function getSetting()
	{
		$sSql = "SELECT * FROM youtubewidget_settings";
		return $this->query($sSql,"row");
	}
	
	public function getCountDb()
	{
		$sQuery = "SELECT count(*) as count FROM youtubewidget_settings";
		$mResult = $this->query($sQuery);
		return $mResult[0]['count'];
	}
	
	public function execSave($aData)
	{
		$sSql = "INSERT INTO youtubewidget_settings (category,tab_order) VALUES('$aData[pg_simpleyoutube_cat_sel]','$aData[pg_simpleyoutube_hidden_order]')";
		return $this->query($sSql);
	}
	
	public function execDelete()
	{
		$sSql = "DELETE FROM youtubewidget_settings";
		return $this->query($sSql);
	}
	/*
	//exec
	public function saveSetting($aData)
	{
	
		
		$sSql = "INSERT INTO {$this->YOUTUBEWIDGET_SETTINGS} (pss_pm_idx, pss_width, pss_template, pss_category, pss_tab_order) VALUES({$aData['pss_pm_idx']}, '{$aData['pss_width']}', {$aData['pss_template']}, '{$aData['pss_category']}', '{$aData['pss_tab_order']}');";
		return $this->query($sSql);
	}
	
	public function deleteSetting($iIdx)
	{
		
	
		$sSql = "DELETE FROM {$this->YOUTUBEWIDGET_SETTINGS} WHERE pss_pm_idx = {$iIdx}";
	
		return $this->query($sSql);
	}
	
	
	
	
	public function init()
	{
		$this->PG_SIMPLEYOUTUBE_MAIN = 'PG_Simpleyoutube_main';
		$this->PG_SIMPLEYOUTUBE_SETTING = 'PG_Simpleyoutube_setting';
		$this->utilDb = new utilDb();
	}
	}
	/*
	*/
}