$(document).ready(function() {
    // let h = $(window).height();
    // console.log(h);
    // let sub_h = h - 59 - 224;
    // console.log(sub_h);
    // $('section#working-area').height(sub_h);

    let page = $("#_page").val();

    
    $(".signin-btn").click(function() {
        let elem =  $(this);
        if( elem.hasClass('btn-disable') ) {
            return false;
        }
        $('.invalid-feedback').removeClass('show');
        $('.signin-btn-text').hide();
        $('#signin-spinner').addClass('show');
        elem.addClass('btn-disable');
        elem.addClass('dark-red');
        $.ajax({
            url: '/login',
            type: 'post',
            dataType: 'json',
            data: $('#signin-form').serialize(),
            success : function(data) {
                if(page == 'login') {
                    window.location = '/working_area';
                }
                else {
                    if(data.auth) {
                        $('.ajax-username').text(data.user.f_name+' '+data.user.l_name);
                        $('#signin-modal').modal('hide');
                        $(".ajax-avatar").addClass('show');
                        $(".guest").hide();
                    }
                    else if(data.message == 'The given data was invalid.') {
                        alert(data.message);
                    }
                }
            },
            error: function(data) {
                console.log(data);
                console.log(data.responseJSON);
                if(data.responseJSON.message == 'The given data was invalid.') {
                    $('.signin-btn-text').show();
                    $('#signin-spinner').removeClass('show');
                    elem.removeClass('btn-disable');
                    elem.removeClass('dark-red');
                    if(data.responseJSON.errors.email) {
                        $('#in-email-alert').addClass('show');
                        $('#in-email-alert').text(data.responseJSON.errors.email[0]);
                        $('#signin-modal #email').focus();
                    }
                    else if(data.responseJSON.errors.password) {
                        $('#in-pwd-alert').addClass('show');
                        $('#in-pwd-alert').text(data.responseJSON.errors.password[0]);
                    }
                }
            }
        })
    });

    $("#signup-form").submit(function() {
        let elem = $(".signup-btn");
        let success_flag = false;
        $('.invalid-feedback').removeClass('show');
        if( elem.hasClass('btn-disable') ) {
            return false;
        }
        $('.signup-btn-text').hide();
        $('#signup-spinner').addClass('show');
        elem.addClass('btn-disable');
        elem.addClass('dark-red');

        $.ajax({
            url: '/register',
            type: 'post',
            dataType: 'json',
            data: $('#signup-form').serialize(),
            success : function(data) {
                success_flag = true;
            },
            error: function(data) {
                console.log(data);
                console.log(data.responseJSON);
                if(data.responseJSON) {
                    if(data.responseJSON.message == 'The given data was invalid.') {
                        $('.signup-btn-text').show();
                        $('#signup-spinner').removeClass('show');
                        elem.removeClass('btn-disable');
                        elem.removeClass('dark-red');
                        if(data.responseJSON.errors.email) {
                            $('#up-email-alert').addClass('show');
                            $('#up-email-alert').text(data.responseJSON.errors.email[0]);
                            $('#signup-modal #email').focus();
                        }
                        else if(data.responseJSON.errors.password) {
                            $('#up-pwd-alert').addClass('show');
                            $('#up-pwd-alert').text(data.responseJSON.errors.password[0]);
                        }
                    }
                }
                else {
                    window.location = '/';
                }
                success_flag = false;
            }
        });

        if(!success_flag) {
            return false;
        }
    })

    $('#working_area').click(function() {
        $('ul.navbar-nav li').removeClass('active');
        $('#working_area').parent().addClass('active');
        window.location = '/working_area';
    })

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