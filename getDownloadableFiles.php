<?php
header('Content-type: application/json');

$config         = json_decode(file_get_contents('./config.json'));
$output         = array();
$baseFolder     = $config->folders->base;
$baseURL        = $config->folders->baseURL;
$user           = 'steve.cirelli';
$downloadFolder = $baseFolder     . $user . DIRECTORY_SEPARATOR;
$uploadFolder   = $downloadFolder . $config->folders->upload . DIRECTORY_SEPARATOR;

function gfe($filename){
    $pathinfo = pathinfo($filename);
    return strtolower($pathinfo['extension']);
}

// Open a known directory, and proceed to read its contents
if (is_dir($downloadFolder)){
	if ($dh = opendir($downloadFolder)){
        while (($file = readdir($dh)) !== false){
            if( is_file($downloadFolder . $file) ){
                $output[] = $baseURL . $user . '/' . $file;
            }
        }
		closedir($dh);
	}
}
echo json_encode($output);
?>
