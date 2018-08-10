<?php

	$file = FALSE;
	//$name = (!empty($_GET['name'])) ? $_GET['name'] : 'print_image';
	if (isset($_GET['id'])){
		$file = '../Uploads/' . $_GET['id'];

		if (!file_exists($file) OR (!is_file($file))){
		$file = FALSE;
		}
	}

	if (!$file){
		$file= 'Images/unavailable.png';
		 
	}
	//$file_info = finfo_open(FILEINFO_MIME_TYPE);
	//finfo_file($file_info,$file);
	//$info = ($image);

	$fs = filesize($file);

	//send content info
	//header("Content-Type: " . $info['mime'] ."\n");
	//header("Content-Disposition: inline; filename=" . $name.  "\n");
	/*header("Content-Type: application/pdf");
	header("Content-Disposition: inline; filename=$file");
	$fs = filesize($file);
	header("Content-Length: " . $fs .  "\n");
*/

	//Send file
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
	
?>
