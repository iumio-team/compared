$(document).ready(function(){

    /*------*/

    var request = ''; // Global variable for ajax requests
    //Use request.abort() before your request to cancel previous requests
    
    /*------*/

    /**$('#mdp_regenerate').bind('click',function(e){
            e.preventDefault();

            var reqSrc = $(this).attr('href');

            var request = $.ajax({
              url: reqSrc,
              type: "POST",
              dataType: "html",

              success : function(_data){
                    console.log(_data);

                    $('#userPass').val(_data)

              }
            });

    })
    
     /*$('#remove_company').click(function() {
    bootbox.confirm("Are you sure want to delete?", function(result) {
      alert("Confirm result: " + result);
    });
  });*/
    /** $('.remove_company').each(function(){
    $(this).bind('click',function(e){
            e.preventDefault();

            var reqSrc = $(this).attr('href');

            var request = $.ajax({
              url: reqSrc,
              type: "POST",
              dataType: "html",

              success : function(_data){
                    console.log(_data);
                    
                    if(_data === '1'){
                    console.log('OK')
                     $('#modal-error').modal('show');
                     $('#modal-error').find('.modal-footer').hide();
                     $('.modal-body').html("<span class='animation2'>Suppresion effectuée </span>")
                     
                    var timerChangePage = setInterval(function(){
                        
                    clearInterval(timerChangePage);
                    window.location = 'index.php?action=companyList';
                    
                    },2000)
                }
                if(_data === '0'){
                    console.log('NOK')
                    $('#modal-error').modal('show');
                    $('.modal-body').html("<span class='animation2'>Une erreur a été rencontré lors de la suppression du client ou prestataire : Utilisateur non existante dans la base </span>")
                }
                

  

              }
            });
            

    })
     });
     
     
   $('.remove_user').each(function(){
    $(this).bind('click',function(e){
            e.preventDefault();

            var reqSrc = $(this).attr('href');

            var request = $.ajax({
              url: reqSrc,
              type: "POST",
              dataType: "html",

              success : function(_data){
                    console.log(_data);
                    
                    if(_data === '1'){
                    console.log('OK')
                     $('#modal-error').modal('show');
                     $('#modal-error').find('.modal-footer').hide();
                     $('.modal-body').html("<span class='animation2'>Suppresion effectuée </span>")
                     
                    var timerChangePage = setInterval(function(){
                        
                    clearInterval(timerChangePage);
                    window.location = 'index.php?action=home';
                    
                    },2000)
                }
                if(_data === '0'){
                    console.log('NOK')
                    $('#modal-error').modal('show');
                    $('.modal-body').html("<span class='animation2'>Une erreur a été rencontré lors de la suppression de l'utilisateur : Utilisateur non existante dans la base </span>")
                }
                

  

              }
            });
            

    })
     })
     
     
    var Form = {
        
        init : function(){
            
            
        }
    }
    
    var Message = function(_messageCode){
            
        var output = '';

        switch(_messageCode){

            case 'validCreateUser' : 
                output = "La création de l'utilisateur s'est effectué avec succès";
            break;

        }

        if (output != '')
            return output;
          
    }
    
        $('#form-addUser').submit(function(e) {
            e.preventDefault();


            $.ajax({
              url:'index.php',
              type: "POST",
              data: $("#form-addUser").serialize(),
              
              success : function(_data){
                 console.log(_data);

                if(_data === '1'){
                    console.log('OK')
                     $('#modal-error').modal('show');
                     $('#modal-error').find('.modal-footer').hide();
                     $('.modal-body').html("<span class='animation2'>La création de l'utilisateur s'est effectué avec succès</span>")
                     
                    var timerChangePage = setInterval(function(){
                        
                    clearInterval(timerChangePage);
                    window.location = 'index.php?action=home';
                    
                    },2000)
                }
                if(_data === '0'){
                    console.log('NOK')
                    $('#modal-error').modal('show');
                    $('.modal-body').html("<span class='animation2'>Une erreur a été rencontré lors de la création de l'utilisateur : Indentifiant non utilisable </span>")
                }
                
                
              }
            });
        });
        
        $('#form-ModUser').submit(function(e) {
            e.preventDefault();


            $.ajax({
              url:'index.php',
              type: "POST",
              data: $("#form-ModUser").serialize(),
              
              success : function(_data){
                 console.log(_data);

                if(_data === '1'){
                    console.log('OK')
                     $('#modal-error').modal('show');
                     $('#modal-error').find('.modal-footer').hide();
                     $('.modal-body').html("<span class='animation2'>Modification réussie</span>")
                     
                     var timer = setInterval(function() {
                      
                         //window.location = '/gestion_unflux/index.php?action=home';
                         window.history.back();
                    
                     },2000)
                     
                    
                }
                if(_data === '0'){
                    console.log('NOK')
                   
                    $('#modal-error').modal('show');
                    $('.modal-body').html("<span class='animation2'>Une erreur a été rencontré lors de la modification : Indentifiant non utilisable </span>"); 
              }
            }
        });
        });
        
        $('#form-addCompany').submit(function(e) {
            e.preventDefault();
            console.log('Submit');

            $.ajax({
              url:'index.php',
              type: "POST",
              data: $("#form-addCompany").serialize(),
              
              success : function(_data){
                 console.log(_data);

                if(_data === '1'){
                    console.log('OK')
                     $('#modal-error').modal('show');
                     $('#modal-error').find('.modal-footer').hide();
                     $('.modal-body').html("<span class='animation2'>Création réussie</span>")
                     
                    var timer = setInterval(function() {
                      
                        location.href='index.php?action=companyList';
                    
                     },2000)
                     
                    
                }
                if(_data === '0'){
                    console.log('NOK')
                   
                    $('#modal-error').modal('show');
                     
                    $('.modal-body').html("<span class='animation2'>Une erreur a été rencontré lors de la création : Société existante </span>"); 
                    
              }
            }
        });
        });
            

    

    /*------*/

    /**$('.idP_regenerate').bind('keyup',function(e){

        console.log('Change');
            var idP = $("input").val();
            //e.preventDefault();
            console.log('In jquery function to search idPerso');
            var request = $.ajax({
              url: 'index.php?action=verifIdPerso&idPerso='+idP,
              type: "POST",
              dataType: "html",
              success : function(_data){
                if($('.unknown'))
                  $('.unknown').empty()
              
                $('.userID').removeAttr('id','inputSuccess1')
                 $('.userID').removeAttr('id','inputError1')
                 $('.form-group').removeClass('has-error').removeClass('has-sucess')
                 console.log('NB : ' + $('.form-group').length);
                  $('.animation').find('.message').remove();
                 console.log('>>' + _data);

                if(_data == 'Identifiant non utilisé'){
                    console.log('OK')
                    $('.userID').attr('id','inputSuccess1')
                    $('.form-group').addClass('has-success')
                    $('.animation').append('<span class="message animation2">'+_data+'</span>')
                }

                if(_data =='Identifiant dejà utilisé !'){
                    console.log('NOK')
                    $('.form-group').addClass('has-error')
                    $('.userID').attr('id','inputError1')
                    $('.animation').append('<span class="message animation2">'+_data+'</span>')
                }

                if($.trim($('.userID').val()) == ''){
                    $('.animation').find('.message').remove();
                }

              }
            });
        });
        
        $('.comp_user').each(function(){
            
         var comp_user = $(this);
         
         $(this).bind('click',function(e){
            e.preventDefault();

            var reqSrc = $(this).find('a').attr('href');

            var request = $.ajax({
              url: reqSrc,
              type: "POST",
              dataType: "html",

              success : function(_data){
                if(_data == 'Suppression effectué'){
                    console.log('OK')
                    comp_user.fadeOut(300, function(){
                        $(this).remove();
                    });
                    $('div#alertContainer').append('<span class="message animation2">'+_data+'</span>')
                }

                if(_data == 'Suppression non effectué'){
                    console.log('NOK')
                    $('div#alertContainer').append('<span class="message animation2">'+_data+'</span>')
                }

              }

              });
            });
           })

        $('#select').selectize();
        
        $('.companyName_regenerate').bind('keyup',function(e){

        console.log('Change');
            var nameC = $("input").val();
            //e.preventDefault();
            console.log('In jquery function to search company name');
            var request = $.ajax({
              url: 'index.php?action=verifCompanyN&name='+nameC,
              type: "POST",
              dataType: "html",
              success : function(_data){
                if($('.unknown'))
                  $('.unknown').empty()
              
                $('.companyName ').removeAttr('id','inputSuccess1')
                 $('.companyName ').removeAttr('id','inputError1')
                 $('.form-group').removeClass('has-error').removeClass('has-sucess')
                 console.log('NB : ' + $('.form-group').length);
                  $('.animation').find('.message').remove();
                 console.log('>>' + _data);

                if(_data == 'Société inexistante'){
                    console.log('OK')
                    $('.companyName').attr('id','inputSuccess1')
                    $('.form-group').addClass('has-success')
                    $('.animation').append('<span class="message animation2">'+_data+'</span>')
                }

                if(_data =='Le nom de cette société est dejà utilisé !'){
                    console.log('NOK')
                    $('.form-group').addClass('has-error')
                    $('.userID').attr('id','inputError1')
                    $('.animation').append('<span class="message animation2">'+_data+'</span>')
                }

                if($.trim($('.companyName').val()) == ''){
                    $('.animation').find('.message').remove();
                }

              }
            });
        });
        
        
        
        
        
        
        
        $(".pe").popover({
        placement : 'button'
        });
        $(".pop-top").popover({placement : 'top'});
        $(".pop-right").popover({placement : 'right'});
        $(".pop-bottom").popover({placement : 'bottom'});
        $(".pop-left").popover({ placement : 'left'});
        $(".pe").click(function(){
        $(".pe a").popover('show');
    }); */
    
         $('.deleteMessage').each(function(){
         $(this).bind('click',function(e){
            e.preventDefault();
            var reqSrc = $(this).attr("data");
             $('#myModal').find(".btn-success").attr("data",reqSrc);
             $('#myModal').attr("data-keyboard","true");
            $('#myModal').modal('show');
        })
    });
    
    $("#enable").each(function(){
         $(this).bind('click',function(e){
            e.preventDefault()
            $('#modalConnection').find("h3.error").text("");
            $('#modalConnection').modal('show');
        })
    });
    
    $("#disable").each(function(){
         $(this).bind('click',function(e){
            e.preventDefault()
            $('#modalConnection').find("h3.error").text("");
            $('#modalConnection').modal('show');
        })
    });
    
    $(".PIN").find("img.btn").each(function(){
         $(this).bind('click',function(e){
            e.preventDefault()
            if($(this).attr("data-content") != "NULL" && $(this).attr("data-content") != "RM" && $(this).attr("data-content") != "VAL"){
                 $('#modalConnection').find("h3.error").text("");
                var value = $("#password").val()
                $("#password").val(value+""+$(this).attr("data-content"))
            }
           else if($(this).attr("data-content") == "RM"){
                 $("#password").val("");
                 $('#modalConnection').find("h3.error").text("");
             }
              else if($(this).attr("data-content") == "VAL"){
                   var code = $("#password").val();
                   request = $.ajax({
              url: "Gui.php?run=authPIN",
              type: "POST",
              data :{ pin: code },
              dataType: "html",
              success : function(_data){
                  console.log(_data)
                 if(_data === "1"){
                    $('#modalConnection').modal("hide");
                    $('#modalMaintenance').modal("hide");
                      $('#modalSc').modal('show');
                    var timerChangePage = setInterval(function(){
                        clearInterval(timerChangePage);
                        window.location = '../Wui.php?run=getLoginView&argument=void';
                    
                    },2000);
                    
                }
                
                  if(_data === "0"){
                    $("#password").val("");
                   $('#modalConnection').find("h3.error").text("Erreur d'authentification");
                }
                

              }});
      
             }
        })
    
    });
    
    
      $('#maintenance').each(function(){
         $(this).bind('click',function(e){
            e.preventDefault();

            request = $.ajax({
              url: "Gui.php?run=getMaintenanceStatus&argument=void",
              type: "POST",
              dataType: "html",

              success : function(_data){
                  var json = JSON.parse(_data);
                        

                 if(json.date){
                
                    
                     $('#modalMaintenance').find(".statuts").text("Activé")
                     $('#modalMaintenance').find(".bt").text("Désactiver la maintenance");
                     $('#modalMaintenance').find(".date").css("display","block");
                     $('#modalMaintenance').find(".date1").text("Le "+json.date);
                       $('#modalMaintenance').find(".time-elapsed").css("display","block");
                       $('#modalMaintenance').find(".elapsed1").text(json.timeelapsed);
                     $('#modalMaintenance').find(".bt").attr("id","disable");
                                                   console.log(json.date)
                  $('#modalMaintenance').modal('show');
                  
                    
                    
                }
                
                  if(_data === "0"){
                     $('#modalMaintenance').find(".statuts").text("Désactivé")
                     $('#modalMaintenance').find(".bt").text("Activer la maintenance")
                     $('#modalMaintenance').find(".bt").attr("id","enable");
                     $('#modalMaintenance').modal('show');
                   
                }
                

              }});
          
        });
    });
    

    
    $('.deleteMessageValidate').bind('click',function(e){
            e.preventDefault();
            var reqSrc = $(this).attr("data");
            request = $.ajax({
              url: "Gui.php?run=deleteMessage&argument="+""+reqSrc,
              type: "POST",
              dataType: "html",

              success : function(_data){
                 if(_data === '1'){
                      $('#myModal').find('.modal-footer').hide();
                       $('#myModal').attr("data-keyboard","false");
                     $('.modal-body').html("<span>Suppresion effectuée </span>")
                     $('#myModal').modal('show');
                   
                     
                    var timerChangePage = setInterval(function(){
                        
                    clearInterval(timerChangePage);
                    window.location = 'Gui.php?run=getMessages&argument=void';
                    
                    },2000)
                }
                
                  if(_data === '0'){
                     $('.modal-body').html("<span >Une erreur a été rencontré lors de la suppression du message </span>")
                     $('#myModal').find('.modal-footer').hide();
                      $('#myModal').modal('show');
                   
                }
                

              }
            });

    })
    
    
      
});
