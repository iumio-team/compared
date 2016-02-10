$(document).ready(function(){

    /*------*/

    var request = ''; // Global variable for ajax requests
    //Use request.abort() before your request to cancel previous requests

    
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
            e.preventDefault();
            $('#modalConnection').find("h3.error").text("");
            $('#modalConnection').find("input").attr("run","authFM");
            $('#modalConnection').modal('show');
        })
    });
    
    $("#disableComparator").each(function(){
         $(this).bind('click',function(e){
            e.preventDefault();
            $('#modalConnection').find("h3.error").text("");
            $('#modalConnection').find("input").attr("run","authCP");
             $('#modalConnection').find("input").attr("data-content","OFF");
            $('#modalConnection').modal('show');
        })
    });
    
        $("#enableComparator").each(function(){
         $(this).bind('click',function(e){
            e.preventDefault();
            $('#modalConnection').find("h3.error").text("");
            $('#modalConnection').find("input").attr("run","authCP");
            $('#modalConnection').find("input").attr("data-content","ON");
            
            $('#modalConnection').modal('show');
        })
    });
    
    
    $("#disable").each(function(){
         $(this).bind('click',function(e){
            e.preventDefault();
            $('#modalConnection').find("h3.error").text("");
            $('#modalConnection').modal('show');
        })
    });
    
    $(".PIN").find("img.btn").each(function(){
         $(this).bind('click',function(e){
            e.preventDefault();
            if($(this).attr("data-content") != "NULL" && $(this).attr("data-content") != "RM" && $(this).attr("data-content") != "VAL"){
                 $('#modalConnection').find("h3.error").text("");
                var value = $("#password").val();
                var href = $("#password").attr("run");
                $("#password").val(value+""+$(this).attr("data-content"))
            }
           else if($(this).attr("data-content") == "RM"){
                 $("#password").val("");
                 $('#modalConnection').find("h3.error").text("");
             }
              else if($(this).attr("data-content") == "VAL"){
                   var pinn = $("#password").val();
                    var href = $("#password").attr("run");
               switch(href){
                      case 'authFM':
                            request = $.ajax({
                       url: "Gui.php?run="+href,
                       type: "POST",
                       data :{ pin: pinn },
                       dataType: "html",
                       success : function(_data){
                           console.log(_data);
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
                   break;
                    case 'authCP':
                        var modd =  $("#password").attr("data-content");
  
                            request = $.ajax({
                       url: "Gui.php?run="+href,
                       type: "POST",
                       data :{ pin: pinn ,mod:modd},
                       dataType: "html",
                       success : function(_data){
                          if(_data === "1"){
                           
                      
                              $('#modalConnection').modal("hide");
                              if(modd == "OFF"){
                                   $('#modalCP').find(".message").text("Désactivation du comparateur ...");
                              }
                              else {
                                    $('#modalCP').find(".message").text("Activation du comparateur ...");
                              }
   
                                       $('#modalCP').modal('show');
                                     var timerChangePage = setInterval(function(){
                                         clearInterval(timerChangePage);
                                         window.location = 'Gui.php?run=getInfoComparator&argument=void';

                                     },2000);
                           }
                         


                           if(_data === "0"){
                             $("#password").val("");
                            $('#modalConnection').find("h3.error").text("Erreur d'authentification");
                         }


                       }});
                   break;
               }
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
                   console.log(_data);
                    var json = JSON.parse(_data);
                        

                 if(json.date){
                
                    
                     $('#modalMaintenance').find(".statuts").text("Activé");
                     $('#modalMaintenance').find(".bt").text("Désactiver la maintenance");
                     $('#modalMaintenance').find(".date").css("display","block");
                     $('#modalMaintenance').find(".date1").text("Le "+json.date);
                       $('#modalMaintenance').find(".time-elapsed").css("display","block");
                       $('#modalMaintenance').find(".elapsed1").text(json.timeelapsed);
                     $('#modalMaintenance').find(".bt").attr("id","disable");
                                                   console.log(json.date);
                  $('#modalMaintenance').modal('show');
                  
                    
                    
                }
                
                  if(_data === "0"){
                     $('#modalMaintenance').find(".statuts").text("Désactivé");
                     $('#modalMaintenance').find(".bt").text("Activer la maintenance");
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
                     $('.modal-body').html("<span>Suppresion effectuée </span>");
                     $('#myModal').modal('show');
                   
                     
                    var timerChangePage = setInterval(function(){
                        
                    clearInterval(timerChangePage);
                    window.location = 'Gui.php?run=getMessages&argument=void';
                    
                    },2000)
                }
                
                  if(_data === '0'){
                     $('.modal-body').html("<span >Une erreur a été rencontré lors de la suppression du message </span>");
                     $('#myModal').find('.modal-footer').hide();
                      $('#myModal').modal('show');
                   
                }
                

              }
            });

    })
    
    
      
});
