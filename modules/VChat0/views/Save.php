<?
GLOBAL $adb;
$sql2 = "insert into vtiger_attachments(attachmentsid, name, description, type, path) values(?,?,?,?,?)";
$params2 = array($current_id, $filename, "description", $filetype, $upload_file_path);
$result = $adb->pquery($sql2, $params2);
			
?>