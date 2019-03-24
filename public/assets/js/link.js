$(document).ready(function() {
    var _base_url = $("input[name=_base_url]").val();

    $('#to-contact-page').click(function(e) {
        e.preventDefault();
        $('ul.navbar-nav li').removeClass('active');
        $('#to-contact-page').parent().addClass('active');
        window.location = _base_url+'contact';
    })

    $('#to-pricing-page').click(function(e) {
        e.preventDefault();
        $('ul.navbar-nav li').removeClass('active');
        $('#to-contact-page').parent().addClass('active');
        window.location = _base_url+'packages';
    })

    $('#personal_info').click(function(e) {
        e.preventDefault();
        window.location = _base_url+'user/personal_info';
    })

    $('#change_pwd').click(function(e) {
        e.preventDefault();
        window.location = _base_url+'user/change_password';
    })

    $('#manage_mambership').click(function(e) {
        e.preventDefault();
        window.location = _base_url+'user/manage_mambership';
    })
})