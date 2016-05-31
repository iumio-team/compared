$(document).ready(function () {

    var functions = {
        check: function () {
            $.ajax({
                type: "POST",
                url: "/Service/Comparator",
                success: function (_data) {
                    if (_data != 1)
                        location.reload();
                }
            });
        },
        lastCompared : function()
        {
            var ls = localStorage.getItem('lastCompared');
            if (ls === null)
                $('#comparedUser').html("<a class='text-center link' href='Wui.php?run=prepareComparison&argument=void' >Vous n'avez fait aucune comparaison ! <br> Faites-en une en cliquant ici ...");
            else {
                spliterArray = ls.split('|');
                $('#comparedUser').html("<a class='text-center link' href=Wui.php?run=compared&sm1="+spliterArray[0]+"&sm2="+spliterArray[1]+"> Le "+spliterArray[2]+" à "+spliterArray[3]+"  <br> "+spliterArray[4]+"<br> vs <br> "+spliterArray[5]+" </a>");
            }
        },
        sdf_FTS : function(_number, _decimal, _separator) {
            var decimal = (typeof (_decimal) != 'undefined') ? _decimal : 2;
            var separator = (typeof (_separator) != 'undefined') ? _separator : '';
            var r = parseFloat(_number);
            var exp10 = Math.pow(10, decimal);
            r = Math.round(r * exp10) / exp10;
            rr = Number(r).toFixed(decimal).toString().split('.');
            b = rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);
            r = (rr[1]  ? b + '.' + rr[1] : b);

            return r;
        },

        form_help : function()
        {
            $.ajax({
                type: "POST",
                url: "/sendMessage",
                data: {name:$('#form_help').find('input.name').val(),email:$('#form_help').find('input.email').val(),subject : $('#form_help').find('input.subject').val() , content :$('#form_help').find('textarea.content').val()},
                success: function(_data){
                    $('#contact').modal('hide');
                    $("#contactSuccess").modal('show');
                    if(_data === "NOTSEND"){
                        $('#good').html("Un problème est survenue lors de l'envoi de votre message . Merci de réessayer .");

                    }
                    else {
                        $('#good').html("Votre message a été envoyé <i class='fa fa-check-square'></i> ");

                    }
                }

            });
        },
        imageExists : function(url, callback) {
            var img = new Image();
            img.onload = function() {callback(true); };
            img.onerror = function() {callback(false); };
            img.src = url;
        },

        response : function(imageUrl, imageUrl2)
        {
            functions.imageExists(imageUrl, function(exists) {
                if (exists == false)
                    imageUrl = imageUrl2;
                return (imageUrl);
            });
        },
      score : function(score)
      {
                var sm = $(".inputIdSm").val();
                $.ajax({
                    url: "Wui.php?run=newSmScore",
                    type: "POST",
                    data: {"sm": sm, "score": score},
                    success: function (_data) {
                        console.log(_data);
                        $("#modal_mark_smSpec").modal('show');
                    },
                    error: function (request, status, error) {
                        alert(error)
                    }
                });
        }
    }

    $(".starC").each(function () {
        $(this).bind('click', function () {
            var score = $(this).val();
            functions.score(score);
        });
    });

    // Sample usage

    $('a.callContact').each(function () {
        $(this).bind('click', function (e) {
            $('#contact').modal('show');
            $('body').trigger('click');
        });
    });

    $("#form_help").each(function () {
        $(this).bind('submit', function (e) {
            e.preventDefault();
            functions.form_help();
        });
    });

    window.setInterval(functions.check, 2000);

    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
});


//jQuery