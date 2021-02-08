(function ($) {
    'use strict';

    //window load 
    $(window).load(function () {
        var masthead = $('#masthead');
        var headerHeight = parseInt($('#masthead').outerHeight(true));
        //stick footer 
        stickyFooter();

        $(window).on('resize',_.throttle(function () {
            headerHeight = parseInt(masthead.outerHeight(true));
            //stick footer
            stickyFooter();
        }, 100));

        //menu
        masthead.affix({
            offset: {
                top: headerHeight + 60
            }
        });

        masthead.on('affix.bs.affix', function() {
            if (!masthead.hasClass('affix')){
                masthead.addClass('affix animated slideInDown');s
            }
        });

        masthead.on('affixed-top.bs.affix', function() {
            masthead.removeClass('affix animated slideInDown');
        });


        //make footer stick to bottom
        function stickyFooter() {
            if (!$('body.home').length) {
                //skip home page of this rule
                var footerHeight = $('.site-footer').height();
                $('#content').css('paddingBottom', (footerHeight > 80 ? footerHeight : 80));
            }
        }

        //pre-loader
        function preloader(){
            if ($('#ztl-overlay').length) {
                $('#ztl-overlay').fadeOut('500',function(){
                    $('#page').css('visibility','visible');
                });

            }
        }

        preloader();
        //fix the Essential Grid issue
        $(window).trigger('resize');
    });

    $(document).ready(function () {

        //make nice comments form 
        if ($('#commentform').length > 0) {
            $('#commentform label').each(function () {
                var item;
                var labelName;
                item = $(this).attr('for');
                labelName = $(this).text();
                if ($('#' + item).length > 0) {
                    $('#' + item).attr("placeholder", labelName);
                }
            });
        }

        //mark not custom header widgets
        $('.header-one aside').each(function(){
            if ($(this).find('.ztl-header-widget').length === 0 ){
                $(this).addClass('ztl-wide-widget');
            }
        });


        $('.ztl-date-line a').each(function(){
            $(this).html( $(this).text().replace(/(^\w{1,2} \/)/,'<span>$1</span>'));
        });


        $('#comments p.form-submit').addClass('ztl-button-three');

        //add a span
        $('.woocommerce form .form-row label input[type=checkbox]+span').before('<span class=\"ztl-checkbox-helper\"></span>');


        //Smooth scroll to top
        $(window).scroll(function () {
            if ($(this).scrollTop() > 400) {
                $('.ztl-scroll-top').fadeIn();
            } else {
                $('.ztl-scroll-top').fadeOut();
            }
        });

        //Click event to scroll to top
        $('.ztl-scroll-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        //Show/hide placeholder on focus
        $('input, textarea').each(function(){
            $(this).data('holder', $(this).attr('placeholder'));
        });

        $('input, textarea').focusin(function () {
            $(this).attr('placeholder', '');
        });
        $('input, textarea').focusout(function () {
            $(this).attr('placeholder', $(this).data('holder'));
        });

    });

}(jQuery));

