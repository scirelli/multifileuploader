<?PHP

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DOTs Transfer</title>
        <meta name="description" content="Transfer files">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="js/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <noscript>This page requires Javascript.</noscript>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="page-header">
                <h1>DOTs Transfer</h1>
            </div>
            <div class="row">
                <!-- Column 1 -->
                <div class="col-md-6 col1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload</div>
                        <div class="panel-body">
                            <div class="menu">
                                <button id="add-upload-file" class="btn btn-success">Add</button>
                                <button id="submit-files" class="btn btn-primary">Upload</button>
                            </div>
                            <div class="content-list">
                                <ul id="ul_fileuploads" class="">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="col-md-6 col2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Download <div id="download-loading" class="title-loading-icon"></div></div>
                        <div class="panel-body">
                            <div class="content-list">
                                <ul id="ul_filedownloads" class="">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span id="download-button-template" class="hidden">
            <button class="btn btn-default download-file" data-url="{{url}}" title="{{title}}">{{file_name}}</button>
        </span>
        <span id="file-upload-template" class="hidden">
            <form role="form" method="POST" action="act_uploadFiles.php" enctype="multipart/form-data">
                <div class="form-group">
                    <button class="btn btn-xs btn-danger remove">-</button> 
                    <input type="file" name="{{input_id}}" id="{{input_id}}"/>
                </div>
            </form>
        </span>
        <!-- Funkiness for crappy IE -->
        <span id="frame-file-upload-template" class="hidden">
            <div class="div-frame form-group">
                <div class="title-loading-icon"></div>
                <button class="btn btn-xs btn-danger remove-frame">-</button> 
                <iframe src="fileuploadform.html" class="frame-file-upload" data-id="{{frame_id}}"></iframe>
            </div>
        </span>
        <script src="js/vendor/jquery-1.10.2.min.js"></script>
        <script src="js/vendor/q.js"></script>
        <script src="js/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/extras-string.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
