var $ = window.$; // use the global jQuery instance

var $fileUpload = $('#resumable-browse');
var $fileUploadDrop = $('#resumable-drop');
var $progress = $("#progress");
var file_name = $("#file-name");
var file_size = $("#file-size");
var bar = $('.bar');

if ($fileUpload.length > 0 && $fileUploadDrop.length > 0) {
    var resumable = new Resumable({
        // Use chunk size that is smaller than your maximum limit due a resumable issue
        // https://github.com/23/resumable.js/issues/51
        chunkSize: 1 * 1024 * 1024, // 1MB
        simultaneousUploads: 3,
        testChunks: false,
        throttleProgressCallbacks: 1,
        // Get the url from data-url tag
        target: $fileUpload.data('url'),
        // Append token to the request - required for web routes
        query:{_token : $('input[name=_token]').val()}
    });

// Resumable.js isn't supported, fall back on a different method
    if (!resumable.support) {
        $('#resumable-error').addClass('show');
    } else {
        // Show a place for dropping/selecting files
        file = {};
        $fileUploadDrop.addClass('show');
        resumable.assignDrop($fileUpload[0]);
        resumable.assignBrowse($fileUploadDrop[0]);

        // Handle file add event
        resumable.on('fileAdded', function (file) {
            let filesize = parseFloat((file.size/1048576).toFixed(1));
            $progress.addClass('show');
            file_name.html(file.fileName);
            file_size.html(filesize+' MB');
            bar.css("background-color","#3ea200");
            $("#success-alert").hide();
            $("#warning-alert").hide();
            console.log(file);
            $('#upload-btn').click(function() {
                resumable.upload();
            });
        });
        resumable.on('fileSuccess', function (file, message) {
            $("#success-alert").addClass('show');
            file = {};
        });
        resumable.on('fileError', function (file, message) {
            $("#warning-alert span").text(message);
            $("#warning-alert").addClass('show');
            $("#myProgress #myBar").css("background-color","#b30000");
            file = {};
        });
        resumable.on('fileProgress', function (file) {
            bar.width(Math.floor(resumable.progress() * 100) + '%')
        });
        $('#cancel-btn').click(function() {
            file = {};
            console.log(file);
        })
    }

}

$(".close").click(function(e) {
    e.preventDefault();
    $("#success-alert").hide();
    $("#warning-alert").hide();
})

$("#close").click(function(e) {
    e.preventDefault();
    $("#progress").removeClass('show');
})