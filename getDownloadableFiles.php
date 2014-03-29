<?php
$dir    = "./";
$output = array();

function gfe($filename){
    $pathinfo = pathinfo($filename);
    return strtolower($pathinfo['extension']);
}

// Open a known directory, and proceed to read its contents
if (is_dir($dir)){
	if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
			if( gfe($file) == ".mov" && gfe($file) == "avi" )
				echo "<a href=\"$file\">$file</a>\n";
        }
		closedir($dh);
	}
}
?>
