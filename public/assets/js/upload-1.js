var $ = window.$; // use the global jQuery instance

var $fileUpload = $('#resumable-browse');
var $fileUploadDrop = $('#resumable-drop');
var $progress = $(".f_progress");
var file_name = $(".file-name");
var file_size = $(".file-size");
var bar = $('.bar');
var file_selected = false;
var elem =  $('#upload-btn');
var $uploadList = $('#progess');
var clicked_upload_btn = false;

elem.addClass('btn-disable');
elem.addClass('dark-red');

$("#resumable-browse").click(function() {
    if(file_selected) {
        $(this).addClass('btn-disable');
        return false;
    }
    else {
        $(this).removeClass('btn-disable');
    }
});

if ($fileUpload.length > 0 && $fileUploadDrop.length > 0) {
    var resumable = new Resumable({
        chunkSize: 1 * 1024 * 1024, // 1MB
        simultaneousUploads: 3,
        testChunks: false,
        throttleProgressCallbacks: 1,
        target: $fileUpload.data('url'),
        query:{_token : $('input[name=_token]').val()}
    });

// Resumable.js isn't supported, fall back on a different method
    if (!resumable.support) {
        $('#resumable-error').addClass('show');
    } else {
        $('#cancel-btn').click(function() {
            file_selected = false;
            $progress.removeClass('show');
            resumable.cancel();
            $("#upload-btn").show();
            $("#tostep2-btn").addClass('hide');
            $('.myalert').removeClass('show');
        });
        $("#close").click(function(e) {
            file_selected = false;
            e.preventDefault();
            resumable.cancel();
            $("#progress").removeClass('show');
            $("#upload-btn").show();
            $("#tostep2-btn").addClass('hide');
            $('.myalert').removeClass('show');
        })
        // Show a place for dropping/selecting files

        $fileUploadDrop.addClass('show');
        resumable.assignDrop($fileUpload[0]);
        resumable.assignBrowse($fileUploadDrop[0]);

        // Handle file add event
        resumable.on('fileAdded', function (file) {
            elem.removeClass('btn-disable');
            elem.removeClass('dark-red');
            $("#warning-alert").removeClass('show');

            let ext = getExtension(file.relativePath);

            if( ext == 'csv' || ext =='CSV' ) {
                let filesize;

                if(file.size < 1024) {
                    filesize = file.size + ' bytes';
                }
                else {
                    filesize = parseFloat((file.size/1048576).toFixed(1))+' MB';
                }

                $uploadList.append('<div class="mb20 f_progress"><div class="row"><div class="col-md-1 col-sm-1 col-xs-1 text-center"><i class="fas fa-file" style="margin-top: 20px;"></i></div><div class="col-md-9 col-sm-9 col-xs-9"><p class="text-left"><b class="file-name">'+file.fileName+'</b></p><p class="text-left file-size">'+filesize+'</p><div class="myProgress"><div class="bar myBar"></div></div></div><div class="col-md-2 col-sm-2 col-xs-1"><span class="f_close">&times;</span></div></div></div>');
                console.log(file.uniqueIdentifier);
                bar.css("background-color","#3ea200");
                $("#success-alert").hide();
                $("#warning-alert").hide();

                if(clicked_upload_btn) {
                    resumable.upload();
                }
                else {
                    $('#upload-btn').click(function() {
                        clicked_upload_btn = true;
                        elem.addClass('btn-disable');
                        elem.addClass('dark-red');
                        resumable.upload();
                    });
                }

            }
            else {
                $("#warning-alert span").text('Plese select a correct csv file!');
                $("#warning-alert").addClass('show');
                elem.addClass('btn-disable');
                elem.addClass('dark-red');
            }
        });
        resumable.on('fileSuccess', function (file, message) {
            $("#success-alert").addClass('show');
            $("#upload-btn").hide();
            $("#tostep2-btn").removeClass('hide');
            file = {};
        });
        resumable.on('fileError', function (file, message) {
            $("#warning-alert span").text(message);
            $("#warning-alert").addClass('show');
            $("#myProgress #myBar").css("background-color","#b30000");
            file = {};
        });
        resumable.on('fileProgress', function (file) {
            bar.width(Math.floor(resumable.progress() * 100) + '%');
        });
    };

}

$(".myclose").click(function(e) {
    e.preventDefault();
    $(this).parent().removeClass('show');
})

$("#tostep2-btn").click(function() {
    window.location = '/main_process';
})

function getExtension(path) {
    var basename = path.split(/[\\/]/).pop(),
        pos = basename.lastIndexOf(".");

    if (basename === "" || pos < 1)
        return "";

    return basename.slice(pos + 1);
}

function get_file_info() {
    let _token = $('input[name=_token]').val();
    let _file = $('#_file').val();

    $.ajax({
        url: '/get_file_info',
        type: 'post',
        data: '_file='+_file+"&_token="+_token,
        success: function(data) {
            $("#total_rows").val(data);
            $("#rows-to-process").val(data);
            $('.total_rows').text(data);
            $("#dbStore-spinner").hide();
            $('#get-contact-info').removeClass('hide');
        }
    })
}

$(document).ready(function() {
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

    $('#process-btn').click(function() {
        $("#dbStore-spinner").show();
        $('#get-contact-info').addClass('hide');

        $("#processing").removeClass('hide');
    });

    $("#processing-cancel-btn").click(function() {
        $("#processing").addClass('hide');

        $("#dbStore-spinner").hide();
        $('#get-contact-info').removeClass('hide');
    })
})