<?php 
	include_once(dirname(__FILE__)."/../../lib/session_manager.php");
	include_once(dirname(__FILE__)."/../../database/config.php");
	include_once(dirname(__FILE__)."/../../database/mcat_db.php");
	include_once(dirname(__FILE__)."/../../lib/utils.php");
	
	// - - - - - - - - - - - - - - - - -
	// On Session Expire Load ROOT_URL
	// - - - - - - - - - - - - - - - - -
	CSessionManager::OnSessionExpire();
	// - - - - - - - - - - - - - - - - -
	
	$user_id = CSessionManager::Get(CSessionManager::STR_USER_ID);
	
	$objDB = new CMcatDB();
	
	if(isset($_POST['batch_ids']))
	{
		$batch_ary = explode(",", $_POST['batch_ids']);
		
		echo json_encode($objDB->PrepareCandidateListByBatch($user_id, $batch_ary));
	}
	else if(isset($_POST['batch_id']))
	{
		$objDB->PopulateCandidates($user_id, $_POST['time_zone'], $_POST['batch_id']);
	}
?>