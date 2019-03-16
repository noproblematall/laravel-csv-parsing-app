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

            let header = ['Address','City','Province','Postal_code'];
            let _added_elem = '';
            for(let i=0; i<header.length; i++) {
                _added_elem += '<div class="col-md-3"><select class="cus_sel_box '+header[i]
                +'" name=""><option value="">'+
                header[i]+'</option>';
                for(let j=0; j<origin_header.length; j++) {
                    _added_elem += '<option value="'+origin_header[j]+'">'+
                    origin_header[j]+'</option>';
                }
                _added_elem += '</select></div>';
            }
            let whole_added_elem = '<div class="custom-select" id="selected_'+fileId
            +'"><div class="row">'+_added_elem+'</div><p class="alert_header" style="display:none; color: #981a36;">Select the above select boxs!</p></div>';
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

    $("#tostep2-btn").click(function() {
        $('.alert_header').hide();
        let validation = false;
        $('.cus_sel_box').each(function() {
            if($(this).val() == "") {
                this.focus();
                validation = true;
                $(this).parent().parent().parent().find('.alert_header').show();
            }
        })

        if(!validation) {
            var file_count = file.files.length - del_item.length;
            var header_info = {};
            var _token = $("input[name=_token]").val();
            for(var k=0; k<file_count; k++) {
                header_info[k] = {};
                header_info[k]['fileName'] = $("#selected_"+k).parent().find('.file-name').text();
                header_info[k]['Address'] = $("#selected_"+k+" .Address").val();
                header_info[k]['City'] = $("#selected_"+k+" .City").val();
                header_info[k]['Province'] = $("#selected_"+k+" .Province").val();
                header_info[k]['Postal_code'] = $("#selected_"+k+" .Postal_code").val();
            }
            console.log(header_info);
            
            // var myJSON = header_info.toString();
            // console.log(myJSON);
            $.ajax({
                url: 'set_header',
                type: 'post',
                data: {'header_info':header_info,'_token':_token},
                success: function(msg) {
                    if(msg=="success") {
                        window.location = 'main_process';
                    }
                }
            })
        }

    });

    if($("#_page").val() == 'main_process') {
        get_file_info();
    };

    $("#process-cancel-btn").click(function() {
        $('#get-contact-info').addClass('hide');
        $("#dbStore-spinner").show();
        $.ajax({
            url: '/process_cancel',
            type: 'get',
            success: function(msg) {
                if(msg == 'success') {
                    window.location = '/working_area';
                }
            }
        });
    });
})

function get_file_info() {
    let appended_elem = $('#file_info');

    $.ajax({
        url: '/get_file_info',
        type: 'get',
        success: function(data) {
            console.log(data);
            let total_count = 0;
            let processable = 0;
            for(let i = 0; i < data.length; i++) {
                let append_str = '<h4 class="mytext-dark-blue underline text-left">'+(i+1)+'. '+data[i].fileName
                +' :</h4><div class="form-group text-left"><label for="total_rows">Total rows:</label><input type="text" name="total_rows" id="total_rows_'+i
                +'" class="form-control" value="'+data[i].count+'" placeholder="Total rows" disabled></div><div class="form-group text-left" style="margin-bottom: 68px"><label for="rows-to-process">Number of rows to process:</label><input type="text" class="form-control" id="rows_to_process_'+i+'" value="'+
                data[i].count+'" placeholder="Number of rows to process" reqired></div>';
                appended_elem.append(append_str);
                total_count += data[i].count;
                processable = data[i].processable;
                console.log(data[i].fileName);
                console.log(data[i].count);
            }

            $('.total_rows').text(total_count);
            $('.processable').text(processable);
            $("#dbStore-spinner").hide();
            $('#get-contact-info').removeClass('hide');
        }
    })
}