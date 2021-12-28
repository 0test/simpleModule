<?php
if(IN_MANAGER_MODE!='true' && !$modx->hasPermission('exec_module')) die('ERROR');

include_once(MODX_BASE_PATH . 'assets/snippets/DocLister/lib/DLTemplate.class.php');
$DLTemplate = DLTemplate::getInstance($modx);
$DLTemplate->setTemplatePath('assets/modules/simpleModule/templates/');
$DLTemplate->setTemplateExtension('tpl');
$editRowTpl = '@FILE: editRowTpl';
$itemTpl = '@FILE: itemTpl';
$bigAction = $modx->db->escape( $_GET['a'] );
$moduleId = (int)$_GET['id'];
$myUrl = 'index.php?a=112&id=' . $modx->db->escape( $_GET['id'] ) . '&';

$SiteContentTable = $modx->getFullTableName('site_content');

$lang = $modx->config['manager_language'];
if (file_exists( dirname(__FILE__) .  '/lang/'.$lang.'.php')){
	include_once(dirname(__FILE__) .  '/lang/'.$lang.'.php');
}else{
	include_once(dirname(__FILE__) .  '/lang/english.php');
}

$data = array (
	'moduleurl' => $myUrl, 
	'manager_theme' => $modx->config['manager_theme'],
	'manager_path' => $modx->getManagerPath(),
	'base_url' => $modx->config['base_url'],
	'moduleId' => $moduleId,
	'interface' => $interface,
);
$act = !isset($_REQUEST['action']) ? 'default' : $modx->db->escape($_REQUEST['action']) ;
$data['work'] = '';
switch($act){
	case 'default':
		$section = $params['sectionId'];
		$result = $modx->db->select('id,pagetitle,introtext', $SiteContentTable, 'parent='.$section, '', 30);
		
		if($modx->db->getRecordCount($result) >= 1){
			while($row = $modx->db->getRow( $result )){
				$data['work'] .= $DLTemplate->parseChunk($itemTpl, [
					'id' => $row["id"],
					'pagetitle' => $row["pagetitle"],
					'introtext' => $row["introtext"],
					'moduleId' => $moduleId,
					'bigAction' => $bigAction,
					'interface' => $interface,
				], true);
			}

		}
		$tpl = '@FILE: mainPage';
	break;

	case 'edit':
		if($_POST){
			$fields = array(
				"pagetitle" => $modx->db->escape($_POST["pagetitle"]),
				"introtext" => $modx->db->escape($_POST["introtext"])
			);
			$result = $modx->db->update($fields, $SiteContentTable, "id=" . $modx->db->escape( $_GET['editDoc']) );
			if($result){
				$data['work'] =  $interface['save_success'];
			}
			else{
				$data['work'] =  $interface['save_error'];
			}
		}
		else{
			$result = $modx->db->select('id,pagetitle,introtext', $SiteContentTable, 'id='.$modx->db->escape($_GET['editDoc']));
			if($modx->db->getRecordCount($result)>= 1){
				while($row = $modx->db->getRow( $result )){
					$data['work'] .= $DLTemplate->parseChunk($editRowTpl, [
						'id' => $row["id"],
						'pagetitle' => $row["pagetitle"],
						'introtext' => $row["introtext"],
						'interface' => $interface,
					], true);
				}
			}
		}
		$tpl = '@FILE: editPage';
	break;
}
$out = $DLTemplate->parseChunk($tpl, $data, true);
echo $out;
?>
