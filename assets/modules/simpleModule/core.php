<?php
if(IN_MANAGER_MODE!='true' && !$modx->hasPermission('exec_module')) die('ERROR');

include_once(MODX_BASE_PATH . 'assets/snippets/DocLister/lib/DLTemplate.class.php');
$DLTemplate = DLTemplate::getInstance($modx);
$DLTemplate->setTemplatePath('assets/modules/simpleModule/templates/');
$DLTemplate->setTemplateExtension('tpl');

$bigAction = $_GET['a'];
$moduleId = $_GET['id'];
$myUrl = 'index.php?a=112&id=' . $_GET['id'] . '&';

$FullTableName = $modx->getFullTableName('site_content');

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

		
switch($_REQUEST['action']){
	default:	// Действия при загрузке модуля
		$section=$params['sectionId'];	// Получаем из конфига id раздела
		$result = $modx->db->select('id,pagetitle,introtext', $FullTableName, 'parent='.$section, '', 30);
		if($modx->db->getRecordCount($result)>= 1){
			while($row = $modx->db->getRow( $result )){
				if($class){$class="gridAltItem";}else{$class="gridItem";}		
				$data['work'] .='<tr class="'.$class.'">';
				$data['work'].='<td >'.$row["id"].'</td>';
				$data['work'] .='<td>'.$row["pagetitle"].'</td>';
				$data['work'] .='<td >'.$row["introtext"].'</td>';
				$data['work'] .='<td ><a href="index.php?&a=' . $bigAction. '&id='.$moduleId . '&editDoc='. $row['id'].'&action=edit" data-id="'.$row["id"].'">'.$interface['edit'].'</a></td>';
				$data['work'] .='</tr>';
			}
		}
		else{
			$data['work'] = '';
		}
		$tpl = '@FILE: main';	
		
		

		
	break;
		
	case 'edit':
		if($_POST){
			$fields = array(
				"pagetitle" => $modx->db->escape($_POST["pagetitle"]),
				"introtext" => $modx->db->escape($_POST["introtext"])
			);
			$result = $modx->db->update($fields, $FullTableName, "id=" . $modx->db->escape( $_GET['editDoc']) );
			if($result){
				$data['work'] =  $interface['save_success'];
			}
			else{
				$data['work'] =  $interface['save_error'];
			}
		}
		else{
			$result = $modx->db->select('id,pagetitle,introtext', $FullTableName, 'id='.$modx->db->escape($_GET['editDoc']));
			if($modx->db->getRecordCount($result)>= 1){
				while($row = $modx->db->getRow( $result )){
					if($class){$class="gridAltItem";}else{$class="gridItem";}			
					$data['work'] .='<tr class="'.$class.'">';
					$data['work'] .='<td>'.$interface['header'] .'</td>';
					$data['work'] .='<td><input name="pagetitle" type="text" maxlength="255" value="'.$row["pagetitle"].'" class="inputBox" onchange="documentDirty=true;" spellcheck="true"></td>';
					$data['work'] .='</tr>';
					$data['work'] .='<tr class="'.$class.'">';
					$data['work'] .='<td>'.$interface['table_header2'] .'</td>';
					$data['work'] .='<td><textarea id="introtext" name="introtext" class="inputBox" rows="3" cols="" onchange="documentDirty=true;">'.$row["introtext"].'</textarea></td>';				
					$data['work'] .='</tr>';
				}
			}
		}
		$tpl = '@FILE: edit';
	break;
}
$out = $DLTemplate->parseChunk($tpl,$data,true);
echo $out;
?>
