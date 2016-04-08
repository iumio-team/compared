/* - - - - - - - - - - -
 * COMPARED
 - - - - - - - - - - - */

var tm;
var COMPARED = {

    docElem             : document.body,
    header              : $('#header'),
    didScroll           : false,
    changeHeaderOn      : 0,
    changeHeaderAnimOn  : 0,
    containersCnt       : 0,
    nbPrevContainer     : 0,
    arrContainersPos    : Array(),
    appearDelay         : 500,
    appearTime          : 300,

    init : function(){

        this.setToggles();
        this.animHeader();
        this.addBacktop();
        this.addCookieNotice();
        this.addTooltips();

    },

    addTooltips : function(){

        $('[data-tooltip="tooltip"]').tooltip();

    },

    addBacktop : function(){

        var that = this;

        $('body').append('<span class="back-to-top"><i class="fa fa-arrow-circle-up"></i></span>');
        $('.back-to-top').bind('click',function(){
            that.scrollToTop();
        })

    },

    addCookieNotice : function(){

        var oldItems = JSON.parse(localStorage.getItem('olfa_ls')) || [];


        if(oldItems.length == 0){

            $('body').append('<span class="cookie-notice"><i class="fa fa-info-circle"></i> En poursuivant votre navigation sur ce site, vous acceptez lâ€™utilisation de <strong>cookies</strong> pour vous proposer des offres ciblÃ©es adaptÃ©s Ã  vos centres dâ€™intÃ©rÃªts et rÃ©aliser des statistiques de visites. <a href="#">En savoir plus</a><br> <a href="#" class="close">J\'ai compris</a></span>');
            $('.cookie-notice .close').bind('click', function(e){
                e.preventDefault();
                $('.cookie-notice').fadeOut(500);
            })

            var newItem = {
                'cookie_notice': true,
            };

            oldItems.push(newItem);

            localStorage.setItem('olfa_ls', JSON.stringify(oldItems));

        }

    },

    selectizeInputs : function(){

        $('.selectize').select2({ minimumResultsForSearch: Infinity });
        $('.selectize-search').select2();

    },

    setToggles : function(){

        $('#sidebar-user-toggle').click(function(e){

            if ($(this).attr("data-connect") == "offline") {
                e.preventDefault();
                e.stopImmediatePropagation();

                if(window.location.href.indexOf("compared.login.admin") > -1) {
                    location.href = "compared.login.admin";
                }else{
                    location.href = "compared.login";
                }
            }
        });

        $('#sidebar-user-toggle-mobile').click(function(e){

            if ($(this).attr("data-connect") == "offline") {
                e.preventDefault();
                e.stopImmediatePropagation();

                if(window.location.href.indexOf("compared.login.admin") > -1) {
                    location.href = "compared.login.admin";
                }else{
                    location.href = "compared.login";
                }
            }else{
                if(!$('#sidebar-user').hasClass('mob-active')){
                    $('#sidebar-user').addClass('mob-active')
                }else{
                    $('#sidebar-user').removeClass('mob-active')
                }

            }
        });

        $(".lang-selected").click(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var lang = $(this).html();
            $.ajax({
                url: "index.php",
                type: "POST",
                data : {"lang": lang},
                success : function(_data){
                    console.log(_data)
                    location.reload();
                }
            });
        });

        $('.lang-selector').dropdown();

    },

    animCascade : function(_divId,_element){

        $('#' + _divId + ' ' + _element).each(function(index){
            $(this).css({'opacity' : 0});
            $(this).delay(index * 200 + this.appearTime + this.appearDelay).animate({'opacity' : 1}, 500);
        })

    },

    animHeader : function(){

        that = this;

        that.scrollPage();

        window.addEventListener( 'scroll', function( event ) {
            //if(Stage.w > 768){
            if( !that.didScroll ) {
                that.didScroll = true;
                setTimeout( function(){
                    that.scrollPage();
                }, 0 );
            }
            //}
        }, false );
    },

    scrollPage : function(){

        var that = this;
        var sy = this.scrollY();

        clearTimeout(tm);

        if ( sy >= this.changeHeaderAnimOn ) {
            if(!$('body').hasClass('header-fixed-top' )){
                $('body').addClass('header-fixed-top' );
            }
            if(!$('.back-to-top').hasClass('active' )){
                $('.back-to-top').addClass('active' );
            }
        }else{
            if($('body').hasClass('header-fixed-top' )){
                $('body').removeClass('header-fixed-top' );
            }
            if($('.back-to-top').hasClass('active' )){
                $('.back-to-top').removeClass('active' );
            }
        }

        this.didScroll = false;

    },

    scrollY : function(){
        return window.pageYOffset;
    },

    scrollToTop : function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");
    },

    smoothScroll : function(){
        $('.smooth-scroll').each(function(){
            $(this).bind('click',function(e){
                e.preventDefault();
                var anchor      = $(this).attr('href');
                var posAnchor   = $(anchor).position();
                $('body','html').animate({ scrollTop : posAnchor.top }, 500 );
            })
        })
    }

}

/* - - - - - - - - - - -
 * STAGE
 - - - - - - - - - - - */

var Stage = {

    w : 0,
    h : 0,

    init : function(){

        var that = this;

        this.resize();

        jQuery(window).resize(function(){
            that.resize();
        })
    },

    resize : function(){
        this.w = window.innerWidth;
        this.h = window.innerHeight;
    }
}


/* - - - - - - - - - - -
 * LAUNCHER
 - - - - - - - - - - - */

var UTIL = {
    fire: function(func, funcname, args) {
        var namespace = COMPARED;
        console.log(func);
        funcname = (funcname === undefined) ? 'init' : funcname;
        if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
            namespace[func][funcname](args);
        }
    },
    loadEvents: function() {
        UTIL.fire('common');

        $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
            UTIL.fire(classnm);
        });
    }
};

$(document).ready(UTIL.loadEvents);


/* - - - - - - - - - - -
 * INITIALIZATION
 - - - - - - - - - - - */

$(document).ready(function(){

    Stage.init();
    COMPARED.init();

});/**
 * Created by rafina on 21/05/16.
 */
