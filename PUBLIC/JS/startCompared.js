$(document).ready(function () {
    $(".clickSm").each(function () {
        $(this).bind('click', function () {
            if ((($('input.ftsm').val() === "NULL")
                    && ($('input#sdsm').val() === "NULL"))
                    || ($('input#ftsm').val() === "NULL")
                    || ($('input#sdsm').val() === "NULL")) {

                var counter = $(".progress_bar_mod").text();
                var smC = $(this).find('input.input').val();
                var picture = $(this).find('input.inputImg').val();
                var name = $(this).find('input.inputName').val();
                if ($('input#ftsm').val() !== smC && ($('input#ftsm').val() !== "NULL")) {
                    $('input#sdsm').val(smC);
                    $('.sm2_alpha').css("display", "none");
                    $('.sm2').css("display", "inline_block");
                    $('.sm2').find("img.pic2").attr("src", "PUBLIC/IMAGE/smartphones/" + picture + ".jpg");
                    $('.sm2').find("div.textName2").text(name);
                    $('.sm2').find("a.ft2").attr("href", "javascript:window.open('Wui.php?run=getSpec&argument=" + $('span#data-comparator').attr("data-comparator_sd") + "')");
                }
                else if ($('input#sdsm').val() !== "NULL" && $('input#ftsm').val() === "NULL") {
                    console.log("azety")
                    $('input#ftsm').val(smC);
                    $('.sm1_alpha').css("display", "none");
                    $('.sm1').css("display", "inline_block");
                    $('.sm1').find("img.pic2").attr("src", "PUBLIC/IMAGE/smartphones/" + picture + ".jpg");
                    $('.sm1').find("div.textName1").text(name);
                    $('.sm1').find("a.ft2").attr("href", "javascript:window.open('Wui.php?run=getSpec&argument=" + smC + "')");
                }
                else if ($('input#sdsm').val() !== smC && ($('input#sdsm').val() !== "NULL")) {
                    $('input#sdsm').val(smC);
                    $('.sm2_alpha').css("display", "none");
                    $('.sm2').css("display", "inline_block");
                    $('.sm2').find("img.pic2").attr("src", "PUBLIC/IMAGE/smartphones/" + picture + ".jpg");
                    $('.sm2').find("div.textName1").text(name);
                    $('.sm2').find("a.ft2").attr("href", "javascript:window.open('Wui.php?run=getSpec&argument=" + smC + "')");
                }
                else {

                    $('input#ftsm').val(smC);
                    $('.sm1_alpha').css("display", "none");
                    $('.sm1').css("display", "inline_block");
                    $('.sm1').find("img.pic1").attr("src", "PUBLIC/IMAGE/smartphones/" + picture + ".jpg");
                    $('.sm1').find("div.textName1").text(name);
                    $('.sm1').find("a.ft1").attr("href", "javascript:window.open('Wui.php?run=getSpec&argument=" + smC + "')");
                }

                if (counter === "0") {
                    $(".progress_bar_mod").text(" ");
                    $(".progress_bar_mod").css("width", "50%");
                    $(".progress_bar_mod").text("1");
                }
                else if (counter === "1" && $('input#ftsm').val() !== smC) {
                    $(".progress_bar_mod").text(" ");
                    $(".progress_bar_mod").css("width", "100%");
                    $(".progress_bar_mod").text("2");
                    $("#nav_start").css("display", "inline-block");
                }


            }

        });
    });

    $(".removeSm2").each(function () {
        $(this).bind('click', function () {
            var counter = $(".progress_bar_mod").text();
            if (counter === "1") {
                $(".progress_bar_mod").text(" ");
                $(".progress_bar_mod").css("width", "0%");
                $(".progress_bar_mod").text("0");
                $("#nav_start").css("display", "none");
                $('#sdsm').val("NULL");
                $('.sm2').css("display", "none");
                $('.sm2').find("img.pic2").attr('src', 'zer');
                $('.sm2').find("div.textName2").text("");
                $('.sm2').find("a.ft2").removeAttr("href");
                $('.sm2_alpha').css("display", "inline-block");
            }
            else if (counter === "2") {
                $(".progress_bar_mod").text(" ");
                $(".progress_bar_mod").css("width", "50%");
                $(".progress_bar_mod").text("1");
                $("#nav_start").css("display", "none");
                $('#sdsm').val("NULL");
                $('.sm2').css("display", "none");
                $('.sm2').find("img.pic2").attr('src', 'zer');
                $('.sm2').find("div.textName2").hide();
                $('.sm2').find("a.ft2").removeAttr("href");
                $('.sm2_alpha').css("display", "inline-block");
            }

        }
        );
    });
    $(".removeSm1").each(function () {
        $(this).bind('click', function () {
            var counter = $(".progress_bar_mod").text();


            if (counter === "1") {
                $(".progress_bar_mod").text(" ");
                $(".progress_bar_mod").css("width", "0%");
                $(".progress_bar_mod").text("0");
                $("#nav_start").css("display", "none");
                $('#ftsm').val("NULL");
                $('.sm1').css("display", "none");
                $('.sm1').find("img.pic2").attr("src", "");
                $('.sm1').find("div.textName2").text("");
                $('.sm1').find("a.ft2").attr("href", "");
                $('.sm1_alpha').css("display", "inline-block");
            }
            else {
                /**console.log("fail");
                $(".progress_bar_mod").text(" ");
                $(".progress_bar_mod").css("width", "50%");
                $(".progress_bar_mod").text("1");
                $("#nav_start").css("display", "none");
                $('#ftsm').val("NULL");
                $('.sm1').css("display", "none");
                $('.sm1').find("img.pic2").attr("src", "");
                $('.sm1').find("div.textName2").text("");
                $('.sm1').find("a.ft2").attr("href", "");
                $('.sm1_alpha').css("display", "inline-block");**/
                $("#modal_start_comp").modal("show");
            }

        }
        );
    });
});

