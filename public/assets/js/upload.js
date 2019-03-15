$(document).ready(function () {
    $('input[type=file]').change(function () {
        $('#progess').html('');
        for (var i = 0; i < this.files.length; i++) { //Progress bar and status label's for each file genarate dynamically
            var fileId = i;
            let filesize;

            if(this.files[i].size < 1024) {
                filesize = this.files[i].size + ' bytes';
            }
            else {
                filesize = parseFloat((this.files[i].size/1048576).toFixed(2))+' MB';
            }
            console.log(this.files[i]);
            $("#progess").append('<div class="mb20 f_progress" id="progressbar_'+fileId+
            '"><div class="row"><div class="col-md-1 col-sm-1 col-xs-1 text-center"><i class="fas fa-file" style="margin-top: 20px;"></i></div><div class="col-md-9 col-sm-9 col-xs-9"><p class="text-left"><b class="file-name">'+
            this.files[i].name+'</b></p><div class="text-left"><span class="process-size">0 bytes </span><span class="file-size"> / '+
            filesize+'</span></div><div class="myProgress"><div class="bar myBar"></div></div></div><div class="col-md-2 col-sm-2 col-xs-1"><span class="f_close">&times;</span></div></div></div>');
        }
    })

    $("#upload-btn").click(function() {
        uploadFiles();
    })

    function uploadFiles() {
        var file = document.getElementById("resumable-browse")//All files
        for (var i = 0; i < file.files.length; i++) {
            uploadSingleFile(file.files[i], i);
        }
    }

    function uploadSingleFile(file, i) {
        var fileId = i;
        var ajax = new XMLHttpRequest();
        //Progress Listener
        ajax.upload.addEventListener("progress", function (e) {
            var percent = (e.loaded / e.total) * 100;
            $('#progressbar_' + fileId + ' .myBar').css("width", percent + "%");

            var process_size;
            if(e.loaded < 1024) {
                process_size = file.size + ' bytes';
            }
            else {
                process_size = (e.loaded / 1048576).toFixed(2) + ' MB';
            }
            $('#progressbar_' + fileId + ' .process-size').text(process_size);
           
            
        }, false);
        //Load Listener
        ajax.addEventListener("load", function (e) {
            $("#status_" + fileId).text(event.target.responseText);
            $('#progressbar_' + fileId).css("width", "100%")

            //Hide cancel button
            var _cancel = $('#cancel_' + fileId);
            _cancel.hide();
        }, false);
        //Error Listener
        ajax.addEventListener("error", function (e) {
            $("#status_" + fileId).text("Upload Failed");
        }, false);
        //Abort Listener
        ajax.addEventListener("abort", function (e) {
            $("#status_" + fileId).text("Upload Aborted");
        }, false);

        ajax.open("POST", "file_upload"); // Your API .net, php

        var uploaderForm = new FormData();
        var _token = $('input[name=_token]').val();
        uploaderForm.append("file", file);
        uploaderForm.append("_token", _token);
        ajax.send(uploaderForm);
        
        //Cancel button
        var _cancel = $('#cancel_' + fileId);
        _cancel.show();

        _cancel.on('click', function () {
            ajax.abort();
        })
    }
})