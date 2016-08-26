
function create_desc_li_autocomplete(ul , item){

    var result = $( document.createElement('li') ).data( "item.autocomplete", item );
    if (item.desc != '')
        return result
            .append($( document.createElement('a') ).append($( document.createElement('span') ).addClass('autocomplete-value').append( item.label)
                ).append(" frege "
                ).append( $( document.createElement('span') ).addClass('autocomplete-desc').append( item.desc))
            )
            .appendTo( ul );
}

/*
 *
 *
 */


function create_desc_li_autocomplete_collection(ul , item){
    return $( document.createElement('li') ).data( "item.autocomplete", item )
        .append($( document.createElement('a') ).append($( document.createElement('span') ).addClass('autocomplete-value').append( item.label+" - "+ item.marque)
            ).append("  "
            ).append( $( document.createElement('span') ).addClass('autocomplete-desc').append( item.desc))
        )
        .appendTo( ul );
}

/*
 *
 *
 */


function create_desc_li_autocomplete_user(ul , item){
    return $( document.createElement('li') ).data( "item.autocomplete", item )
        .append($( document.createElement('a') ).append($( document.createElement('span') ).addClass('autocomplete-value').append( item.label)
            ).append( "  "
            ).append( $( document.createElement('span') ).addClass('autocomplete-desc').append( item.desc))
        )
        .appendTo( ul );
}

function create_desc_li_autocomplete_search(ul , item){
    return $( document.createElement('li') ).data( "item.autocomplete", item )
        .append($( document.createElement('a') ).append($( document.createElement('span') ).addClass('autocomplete-value').append( ((item.label != '')? item.label :  item.desc))
            )
        )
        .appendTo( ul );
}

/*
 *
 *
 */


function show_end_table(item){
    $("tr" , $(item).parent().parent() ).show();
    $(item).parent().html('<td colspan="3" onclick="hide_end_table($(this).parent().parent() , false)" style="cursor: pointer;"><a href="javascript:show_end_table(this);">'+gettext_cacher+'</a></td>');
}

/*
 *
 *
 */


function hide_end_table(item, first)
{
    var i = 0;
    var tmp = item;
    $("tr",item).each(function(){
        if (i == 4 && first)
            $(tmp).append('<tr><td colspan="3" onclick="show_end_table(this)" style="cursor: pointer;"><a href="javascript:show_end_table(this);">'+gettext_afficher+'</a></td></tr>');

        if (i > 4)
        {
            $(this).hide();
        }
        i++;
    });

    if(!first)
        $("tr:last",item).show().html('<td colspan="3" onclick="show_end_table(this)" style="cursor: pointer;"><a href="javascript:show_end_table(this);">'+gettext_afficher+'</a></td>');
}


$(function(){

    /*
     * Toggle menu
     *
     */
    var u ;
    var canget = true;
    $("#sidebar-menu-toggle").click(function() {
        var toggle_menu = $(this).data("toggle");
        clearInterval(u);
        $(toggle_menu).toggleClass("open-sidebar-menu");
        $(toggle_menu).toggleClass("move");
        var t = 1;
        var i = $("#sidebar-menu-content").find('.hvr-ripple-out').length;
        var z = $("#sidebar-menu-content").find('.hvr-ripple-out');
        $("#sidebar-menu-content").find('.hvr-ripple-out').hover()
            var e = 0;
           if (canget == false)
           {
               clearInterval(u);
               return false;
           }

             u = setInterval(function() {
                 var canget = false;
                if (t) {
                    z.mouseenter()
                } else {
                   z.mouseleave();
                }
                t = t?0:1;
                e++;
                if ((e + 1) > i) {
                    clearInterval(u);
                    var canget = true;
                }

            }, 500);
    });

    /*
     * Toggle menu
     *
     */

    $("#sidebar-user-toggle").click(function() {
        var toggle_menu = $(this).data("toggle");
        $(toggle_menu).toggleClass("open-sidebar-user");


    });


    /*
     *
     *
     */

    $("[clck]").click(function() { window.location.href = $(this).attr("clck"); }).css("cursor","pointer");
    $("button[type=submit]").css("cursor","pointer");


    /*
     *
     *
     */

    $(".table_short").each(function(){
        hide_end_table(this , true);
    });

    $('#call_mark').click(function (e) {
        e.preventDefault();
        $('#modal_mark_smSpec').modal("show");
    })



    /*
     *
     *
     */

    $("#form_edit_profil").submit(function(e)
    {
        e.preventDefault()
        var password1	= ( $( "#passwd" ).attr("value"));
        if (password1.length > 0 && typeof $("#password2") == 'undefined')
        {
            $( "#passwd" ).css({"border":"1px solid red"});
            alert('Confirmez votre mot de passe')
            return false;
        }
        else if (password1.length > 0 && typeof $("#password2") != 'undefined') {
            var password2 = ($("#password2").attr("value"));
            if (( password1.length > 0 && password1.length < 6 ) || password1.length > 100 || ( password1.length > 0 && password1 != password2)) {
                $("#passwd").css({"border": "1px solid red"});
                $("#password2").css({"border": "1px solid red"});
                alert('Les mots de passe de ne correspondent pas')
                return false;
            }
        }
        var request = $.ajax({
            url: "index.php",
            type: "POST",
            data : {"edit_profil":  "true", "form" : $(this).serialize()},
            success : function(_data){
                var rs = JSON.parse(_data);
                if (rs['id'] == -3) {
                    $("#mail").css({"border":"1px solid red"});
                }
                alert(rs['msg'])

            }
        });

    });


    $(document).on('mousemove', function(e) {
        var x = e.pageX;
        var y = e.pageY;
        var w = $(this).width();
        var h = $(this).height();
        var angle = Math.atan2(y-(h/2), x-(w/2)) * (180/Math.PI);
        var rotate = angle + (180-45);
        $('.button .compass')
            .css('-webkit-transform', 'rotate('+rotate+'deg)')
            .css('-moz-transform', 'rotate('+rotate+'deg)')
            .css('-ms-transform', 'rotate('+rotate+'deg)')
            .css('-o-transform', 'rotate('+rotate+'deg)')
            .css('transform', 'rotate('+rotate+'deg)');
    });

    $(".edit-password").click(function(e){
        e.preventDefault();
        var placeholder = $('#passwd').attr('data-placeholder');
        $('#passwd').after('<input type="password"  placeholder="'+placeholder+'"  id="password2" name="passwd2" value="">');
    });

});