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
	
	public function execUpdate($aArgs)
	{
		$sSql = "UPDATE youtubewidget_settings SET width = $aArgs[iHolderWidth] WHERE idx = '$aArgs[idx]'";
		return $this->query($sSql);
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
	
}