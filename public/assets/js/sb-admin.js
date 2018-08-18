(function ($) {

    "use strict"; // Start of use strict

    // Configure tooltips for collapsed side navigation
    $('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
        template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
    })

    // Toggle the side navigation
    $("#sidenavToggler").click(function (e) {
        e.preventDefault();
        $("body").toggleClass("sidenav-toggled");
        $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
        $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
    });

    // Force the toggled class to be removed when a collapsible nav link is clicked
    $(".navbar-sidenav .nav-link-collapse").click(function (e) {
        e.preventDefault();
        $("body").removeClass("sidenav-toggled");
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function (e) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
    });

    // Scroll to top button appear
    $(document).scroll(function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Configure tooltips globally
    $('[data-toggle="tooltip"]').tooltip()

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });

    // Recipients New button
    $("#btnRecipientsNew").on('click', function(){
        $("#formRecipients")[0].reset();
    });

    // Vouchers New button
    $("#btnVouchersNew").on('click', function(){
        $("#formVouchers")[0].reset();

        // populate recipients list
        $.getJSON("recipients/list", function(json){
            $('#id_recipient').empty();
            $('#id_recipient').append($('<option>').text("Select"));
            $.each(json.data, function(i, obj){
                $('#id_recipient').append($('<option>').text(obj.name).attr('value', obj.value));
            });
        });

        // populate offers list
        $.getJSON("offers/list", function(json){
            $('#id_offer').empty();
            $('#id_offer').append($('<option>').text("Select"));
            $.each(json.data, function(i, obj){
                $('#id_offer').append($('<option>').text(obj.name).attr('value', obj.value));
            });
        });

    });

    // Offers New button
    $("#btnOffersNew").on('click', function(){
        $("#formOffers")[0].reset();
    });

    // Generate New Offers button
    $("#btnGenerateVouchers").on('click', function(){
        $("#formGenerateVouchers")[0].reset();

        // populate offers list
        $.getJSON("offers/list", function(json){
            $('#id_offer_gen').empty();
            $('#id_offer_gen').append($('<option>').text("Select"));
            $.each(json.data, function(i, obj){
                $('#id_offer_gen').append($('<option>').text(obj.name).attr('value', obj.value));
            });
        });
    });

    $(".alert").on("click", function(){
        // Slide up alert message when clicked
        $(".alert").slideUp();
    });

})(jQuery); // End of use strict