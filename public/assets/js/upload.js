$(document).ready(function () {
    var del_item = [];

    var file = document.getElementById('resumable-browse');
    $('#resumable-browse').change(function () {
        $('#progess').removeClass('hide');
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
            '"><div class="row mb20"><div class="col-md-1 col-sm-1 col-xs-1 text-center"><i class="fas fa-file" style="margin-top: 20px;"></i></div><div class="col-md-9 col-sm-9 col-xs-9"><p class="text-left"><b class="file-name">'+
            this.files[i].name+'</b></p><div class="text-left"><span class="process-size">0 bytes </span><span class="file-size"> / '+
            filesize+'</span></div><div class="myProgress"><div class="bar myBar"></div></div></div><div class="col-md-2 col-sm-2 col-xs-1"><span class="f_close" title="'+fileId+'" id="f_close_'+fileId+'">&times;</span></div></div></div>');
            $('#progressbar_'+fileId).click(function() {

            })
            $("#f_close_"+fileId).click(function (){
                $('#progressbar_'+$(this).attr('title')).remove();
                del_item.push($(this).attr('title'));
            });
        }
        $('#resumable-drop').addClass('hide');
    })

    $("#upload-btn").click(function() {
        // console.log(file.files);
        uploadFiles();
    })
    $("#cancelAll-btn").click(function() {
        $('#resumable-drop').removeClass('hide');
        $('#progess').html('');
        $("#resumable-browse").val('');
        $('#resumable-drop').removeClass('hide');
        $('#resumable-drop').show();

        $("#upload-btn").removeClass('hide');
        $("#tostep2-btn").addClass('hide');
    })
    $(".f_close").click(function() {
        alert(123);
    })

    function uploadFiles() {
        
        if(del_item.length > 0) {
            for (var i = 0; i < file.files.length; i++) {
                for(var j = 0; j<del_item.length; j++) {
                    if(i!=del_item[j]) {
                        uploadSingleFile(file.files[i], i);
                    }
                }
            }
        }
        else {
            for (var i = 0; i < file.files.length; i++) {
                if(i!=del_item[j]) {
                    uploadSingleFile(file.files[i], i);
                }
            }
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
            $('#progressbar_' + fileId).css("width", "100%");

            let origin_header = new Array();
            origin_header = JSON.parse(event.target.response);

            let header = ['Address','City','Province','Postal code'];
            let _added_elem = '';
            for(let i=0; i<header.length; i++) {
                _added_elem += '<div class="col-md-3"><select class="cus_sel_box" name="" id=""><option value="">'+
                header[i]+'</option>';
                for(let j=0; j<origin_header.length; j++) {
                    _added_elem += '<option value="'+origin_header[j]+'">'+
                    origin_header[j]+'</option>';
                }
                _added_elem += '</select></div>';
            }
            let whole_added_elem = '<div class="custom-select"><div class="row">'+_added_elem+'</div></div>';
            $('#resumable-drop').hide();
            $("#progressbar_"+fileId).append(whole_added_elem);
            $("#upload-btn").addClass('hide');
            $("#tostep2-btn").removeClass('hide');

        }, false);
        //Error Listener
        ajax.addEventListener("error", function (e) {
            $("#status_" + fileId).text("Upload Failed");
        }, false);
        //Abort Listener
        ajax.addEventListener("abort", function (e) {
            $("#status_" + fileId).text("Upload Aborted");
        }, false);

        ajax.open("POST", "file_upload", 'json'); // Your API .net, php

        var uploaderForm = new FormData();
        var _token = $('input[name=_token]').val();
        uploaderForm.append("file", file);
        uploaderForm.append("_token", _token);
        ajax.send(uploaderForm);
        
        //Cancel button
        var _cancel = $('#f_close_' + fileId);
        // _cancel.show();

        _cancel.on('click', function () {
            $("progressbar_"+fileId).hide();
        })
    }
})