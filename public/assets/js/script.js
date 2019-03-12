$(document).ready(function() {
    // let h = $(window).height();
    // console.log(h);
    // let sub_h = h - 59 - 224;
    // console.log(sub_h);
    // $('section#working-area').height(sub_h);
    
    $("#avatar").mouseover(function() {
        $(".dropdown-menu").show();
    })
    $("#avatar").mouseout(function() {
        $(".dropdown-menu").hide();
    })
    $(window).scroll(function() {
        var height = $(window).scrollTop();
        if (height > 100) {
            $('#qodef-back-to-top').fadeIn();
        } else {
            $('#qodef-back-to-top').fadeOut();
        }
    })
    $("#qodef-back-to-top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    })
    $('#signup').click(function() {
        $("#signup-modal").modal();
    })
    $('#signin').click(function() {
        $("#signin-modal").modal();
    })
    $("#to-signin").click(function(e) {
        e.preventDefault();
        $("#signup-modal").modal('hide');
        $("#signin-modal").modal('show');
    })
    $("#to-signup").click(function(e) {
        e.preventDefault();
        $("#signin-modal").modal('hide');
        $("#signup-modal").modal('show');
    })
})

function preview_images() 
{
 var total_file=document.getElementById("images").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
}