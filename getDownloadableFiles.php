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

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

// Open a known directory, and proceed to read its contents
if (is_dir($downloadFolder)){
	if ($dh = opendir($downloadFolder)){
        while (($file = readdir($dh)) !== false){
            $localFile = $downloadFolder . $file;
            if( is_file($localFile) ){
                $last_modified = filemtime($localFile);
                if($last_modified !== false ){
                    $last_modified = date('m/d/Y H:i:s',$last_modified);
                }else{
                    $last_modified = 'Unknown';
                }
                $output[] = array(
                    'url'           => $baseURL . $user . '/' . $file,
                    'last_modified' => $last_modified,
                    'size'          => human_filesize(filesize($localFile))
                );
            }
        }
		closedir($dh);
	}
}
echo json_encode($output);
?>
