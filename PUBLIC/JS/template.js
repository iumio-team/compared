/**
 * Created by rafina on 4/1/16.
 */

function calculateScroll() {
    var contentTop = [];
    var contentBottom = [];
    var winTop = $(window).scrollTop();
    var rangeTop = 200;
    var rangeBottom = 500;
    $('.navmenu').find('a').each(function () {
        contentTop.push($($(this).attr('href')).offset().top);
        contentBottom.push($($(this).attr('href')).offset().top + $($(this).attr('href')).height());
    });
    $.each(contentTop, function (i) {
        if (winTop > contentTop[i] - rangeTop && winTop < contentBottom[i] - rangeBottom) {
            $('.navmenu li')
                .removeClass('active')
                .eq(i).addClass('active');
        }
    })
}


$(document).ready(function () {

    var $menu = $("#menuF");

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100 && $menu.hasClass("default")) {
            $menu.fadeOut('fast', function () {
                $(this).removeClass("default")
                    .addClass("fixed transbg")
                    .fadeIn('fast');
            });
        } else if ($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
            $menu.fadeOut('fast', function () {
                $(this).removeClass("fixed transbg")
                    .addClass("default")
                    .fadeIn('fast');
            });
        }
    });


    $("div.blog").mouseover(function (e) {
        e.preventDefault();
        $(this).find("#span_show").css("opacity", "0.8");
    });
    $("div.blog").mouseout(function (e) {
        e.preventDefault();
        $(this).find("#span_show").css("opacity", "0");
    });

    $("div.compare_item").mouseenter(function (e) {
        e.preventDefault();
        $(this).find("#span_show_compare").css("opacity", "1");
    });
    $(".close_list").click(function (e) {
        e.preventDefault();
        $(this).parent().css("opacity", "0");
    });
    $(".bhide").click(function () {
        $(".hideObj").slideDown();
        $(this).hide(); //.attr()
        return false;
    });
    $(".bhide2").click(function () {
        $(".container.hideObj2").slideDown();
        $(this).hide(); // .attr()
        return false;
    });

    $('.heart').mouseover(function () {
        $(this).find('i').removeClass('fa-heart-o').addClass('fa-heart');
    }).mouseout(function () {
        $(this).find('i').removeClass('fa-heart').addClass('fa-heart-o');
    });

    function sdf_FTS(_number, _decimal, _separator) {
        var decimal = (typeof (_decimal) != 'undefined') ? _decimal : 2;
        var separator = (typeof (_separator) != 'undefined') ? _separator : '';
        var r = parseFloat(_number);
        var exp10 = Math.pow(10, decimal);
        r = Math.round(r * exp10) / exp10;
        rr = Number(r).toFixed(decimal).toString().split('.');
        b = rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);
        r = (rr[1] ? b + '.' + rr[1] : b);

        return r;
    }

    setTimeout(function () {
        $('#counter').text('0');
        $('#counter1').text('0');
        $('#counter2').text('0');
        setInterval(function () {

            var curval = parseInt($('#counter').text());
            var curval1 = parseInt($('#counter1').text().replace(' ', ''));
            var curval2 = parseInt($('#counter2').text());

        }, 2);

    }, 500);



    window.setTimeout(s.check, 3000);

    $('#specSm1').each(function () {
        $(this).bind('click', function (e) {

            $('#myModalSm1').modal('show');
        });
    });
    $('#menu').each(function () {
        $(this).bind('click', function (e) {
            if ($(".sidebar_compared").hasClass("isShow")) {
                $('.sidebar_compared').hide();
                $(".sidebar_compared").removeClass("isShow")
            }
            else {
                $('.sidebar_compared').show();
                $(".sidebar_compared").addClass("isShow")
            }
        });
    });
    $('#specSm2').each(function () {
        $(this).bind('click', function (e) {

            $('#myModalSm2').modal('show');
        });

    });

    calculateScroll();
    $(window).scroll(function (event) {
        calculateScroll();
    });
    $('.navmenu ul li a').click(function () {
        $('html, body').animate({scrollTop: $(this.hash).offset().top - 80}, 800);
        return false;
    });
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });


});


//jQuery