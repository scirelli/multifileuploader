"use strict";

!function(){
    var g_nFileCount             = 0,
        sFileUploadTemplate      = $('#file-upload-template').html(),
        sFrameFileUploadTemplate = $('#frame-file-upload-template').html(),
        sDownLoadButtonTemplate = $('#download-button-template').html(),
        $ListFileUpload         = $('#ul_fileuploads'),
        $ListFileDownload       = $('#ul_filedownloads'),
        $addFileBtn             = $('#add-upload-file'),
        $uploadFileBtn          = $('#submit-files'),
        $downloadLoadingIcn     = $('#download-loading');

    function addNewFile(){
        var fileListCont = $('div#listOfFiles');
        var subBtn,elemStr;

        g_nFileCount++;
        elemStr = '<div id="cont_File_' + g_nFileCount + '">' + 
                      '<label for="file_' + g_nFileCount + '">Filename:</label>' +
                      '<input type="file" name="file_' + g_nFileCount + '" id="file_' + g_nFileCount + '" accept="image/bmp,image/cis-cod,image/gif,image/ief,image/jpeg,image/pipeg,image/pjpeg,image/png,image/svg+xml,image/tiff,image/x-cmu-raster,image/x-cmx,image/x-icon,image/x-png,image/x-portable-anymap,image/x-portable-bitmap,image/x-portable-graymap,image/x-portable-pixmap,image/x-rgb,image/x-xbitmap,image/x-xpixmap,image/x-xwindowdump" /> </div>';
        fileListCont.append( elemStr );
        subBtn = $('<input type="button" id="ffSub_'+ g_nFileCount +'" name="ffSub_'+ g_nFileCount +'" value="-" />');
        $('#cont_File_'+ g_nFileCount).append(subBtn );
        subBtn .click( removeFile );
    }
    
    function removeFileBtnClick(e){
        alert('clicked');
        e.preventDefault();
        return false;
        $(this).parent().remove();
    }
    function removeFrameFileBtnClick(e){
        $(this).parent().remove();
        e.preventDefault();
        return false;
    }

    function createUploadFile(){
        var id = g_nFileCount++,
            s  = sFileUploadTemplate,
            $itm = null,
            $rmButton = null;

        s = s.replace(/{{input_id}}/g, 'file_' + id);
        $itm = $('<li>' + s + '</li>');
        $rmButton = $itm.find('button.remove');
        $rmButton.click( removeFileBtnClick );
        return $itm;
    }

    function createFrameUploadFile(){
        var id = g_nFileCount++,
            s  = sFrameFileUploadTemplate,
            $itm = null,
            $rmButton = null;
        
        s = s.replace(/{{frame_id}}/g, 'file_' + id);
        $itm = $('<li>' + s + '</li>');
        $rmButton = $itm.find('button.remove-frame');
        $rmButton.click( removeFrameFileBtnClick );
        return $itm;
    }

    function uploadFileBtnClick(e){
        $('.container form').each(function(index){
            var $form   = $(this), 
                $iframe = $('<iframe src="blank.html" class=""></iframe>').load(function(e){
                    var $me = $(this);
                    debugger;
                });
            $(document.body).append( $iframe);
        });
        e.preventDefault();
        return false;
    }

    function uploadFrameFileBtnClick(e){
        $('.container iframe').each(function(index){
            var form   = this.contentDocument.getElementsByTagName('form'),
                s      = $('<input type="hidden" name="file_id" value="' + $(this).attr('data-id') + '"/>'),
                $lding = $(this).parent().find('.title-loading-icon');

            $lding.css('visibility','visible');
            if( form && form.length ){
                form = form[0];
                form.appendChild(s[0]);
                $(this).load(function(e){
                    $lding.css('visibility','hidden');
                    try{
                        console.log(JSON.parse(this.contentDocument.body.innerHTML));
                    }catch(e){
                    }
                    this.contentDocument.body.innerHTML = 'Success!';
                });
                form.submit();
            }
        });
        e.preventDefault();
        return false;
    }

    function addFileBtnClick(e){
        var $fileUp = createUploadFile();
        $ListFileUpload.append( $fileUp );
    }

    function addFrameFileBtnClick(e){
        var $fileUp = createFrameUploadFile();
        $ListFileUpload.prepend( $fileUp );
    }
    function showDownloadLoading( bShow ){
        if( bShow ){
            $downloadLoadingIcn.css('visibility','visible');
        }else{
                $downloadLoadingIcn.css('visibility','hidden');
        }
    }

    function getDownLoadableFiles(){
        var deferred = Q.defer();

        showDownloadLoading(true);
        $.ajax({
            url:"/dotsFileTransfer/getDownloadableFiles.php",
            dataType:'json',
            success:function( data, textStatus, jqXHR ){
                deferred.resolve(data);
            },
            error:function( jqXHR, textStatus, errorThrown ){
                deferred.reject( errorThrown );
            }
        });

        return deferred.promise;
    }
    function downloadFile( e ){
        var $me = $(this);
        window.open( $me.attr('data-url') );
    }
    $(document).ready(function(){
        $addFileBtn.click(addFrameFileBtnClick);
        $uploadFileBtn.click(uploadFrameFileBtnClick);
        $addFileBtn.click();
        getDownLoadableFiles().then(function(data){
            if( data instanceof Array && data.length ){
                for( var i=0,l=data.length,itm=null,fileName='',btn='',btnTmpl=sDownLoadButtonTemplate,url=''; i<l; i++ ){
                    itm = data[i];
                    fileName = itm.split('/');
                    fileName = fileName[fileName.length-1];
                    btn = btnTmpl.replace( /{{url}}/g, itm ).replace( /{{file_name}}/g, fileName);
                    btn = $(btn);
                    btn.click(downloadFile);
                    $ListFileDownload.append(btn);
                }
            }
            showDownloadLoading(false);
        },
        function( errorThrown ){
            showDownloadLoading(false);
        });
    });
}();
