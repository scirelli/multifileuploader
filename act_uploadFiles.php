<?PHP
    if( $_FILES["file"]["error"] > 0 ){
        echo "Error: " . $_FILES["file"]["error"];
    }else{
        echo "Uploaded: " . $_FILES["file"]["name"];
        /*
        echo "Type: "   . $_FILES["file"]["type"] . "<br>";
        echo "Size: "   . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Stored in: " . $_FILES["file"]["tmp_name"];
         */
    }
    var_dump($_REQUEST);
?>
