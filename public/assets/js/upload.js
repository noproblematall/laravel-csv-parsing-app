var $ = window.$; // use the global jQuery instance

var $fileUpload = $('#resumable-browse');
var $fileUploadDrop = $('#resumable-drop');
var $progress = $("#progress");
var file_name = $("#file-name");
var file_size = $("#file-size");
var bar = $('.bar');
var file_selected = false;
var elem =  $('#upload-btn');

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
$("#resumable-browse").mouseover(function() {
    if(file_selected) {
        $(this).addClass('btn-disable');
    }
    else {
        $(this).removeClass('btn-disable');
    }
})

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
                file_selected = true;
                $progress.addClass('show');

                if(file.size < 1024) {
                    let filesize = file.size;
                    file_size.html(filesize+' bytes');
                }
                else {
                    let filesize = parseFloat((file.size/1048576).toFixed(1));
                    file_size.html(filesize+' MB');
                }
                
                file_name.html(file.fileName);
                bar.css("background-color","#3ea200");
                $("#success-alert").hide();
                $("#warning-alert").hide();

                $('#upload-btn').click(function() {
                    elem.addClass('btn-disable');
                    elem.addClass('dark-red');
                    resumable.upload();
                });
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