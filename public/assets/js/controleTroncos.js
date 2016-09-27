  

function replaceAll(string, token, newtoken) {
       while (string.indexOf(token) != -1) {
              string = string.replace(token, newtoken);
       }
       return string;
}

function editTronco(){
       var data = getData();
       
        
}
function changeJuntorTec(){
   $('#opAvanc').val('0');
              switch ($('#tecnologia').val()) {
                case '11' :                       
                    $('#opAvanc').show();
                    $('.form-ip').show();
                    $('.form-notip').hide();
                    $('.prefx_juntor').hide();                
                break;
                case '12' :                   
                    if( $('#JuntorSelect').val() != undefined && $('#JuntorSelect').val().indexOf('-KHOMP') != -1 ){
                        $('#opAvanc').show()
                    } else {
                        $('#opAvanc').hide();
                    }
                    $('.gsm_khomp_fab').show();
                    $('#JuntorSelect').show();
                    $('.form-notip').show();
                    $('.form-ip').hide();
                    $('.prefx_juntor').hide();
                    $('.form_facip').hide();   
                break;

                case '13' :    
                    if( $('#JuntorSelect').val() != undefined  && $('#JuntorSelect').val().indexOf('-KHOMP') != -1){
                        $('#opAvanc').show()
                    } else if ( $('#JuntorSelect').val().indexOf('-Digivoice') != -1) {
                        $('#opAvanc').hide();
                    }                     
                    $('.form-notip').show();
                    $('.digital_khomp').hide();
                    $('.form-ip').hide();
                    $('.juntor').show();
                    $('.prefx_juntor').hide(); 
                    $('.form_facip').hide();   
                break; 
                case '14' :     
                    if( $('#JuntorSelect').val() != undefined  && $('#JuntorSelect').val().indexOf('-KHOMP') != -1){
                        $('#opAvanc').show()
                    } else {
                        $('#opAvanc').hide();
                    }
                    $('.form-notip').show();
                    $('.digital_khomp').hide();
                    $('.form-ip').hide();
                    $('.juntor').show();
                    $('.prefx_juntor').hide();
                    $('.form_facip').hide();     
                break;
                case '15' : 
                    opAvancOFF();                    
                    $('#opAvanc').hide();
                    $('.digital_khomp').hide();
                    $('.form-ip').hide();
                    $('.juntor').show();
                    $('.prefx_juntor').show();
                    $('.form_facip').hide();       
                    $('.form-notip').show();
                break;
                default:
                        $('.gsm_khomp').hide();
                        $('.form-ip').hide();
                        $('.form_facip').hide();
                        $('.form-notip').show();
                        $('.div_prefx_sa').hide();
                        $('.div_prefx_en').hide();
                        $('#opAvanc').hide();
                        $('#JuntorSelect').show();
                break;
     }
}

function arranque(){
       switch($('#tecnologia').val()){
              case 11: 
                    $('.form-notip').hide();
                    $('.form-ip').show();
                    $('.form_facip').show(); console.log('mostrou form_facip');
              break;
              case 12:
                    if( $('#resulFabricante').val().indexOf('KHOMP') != -1){
                             $('#opAvanc').show();

                    } else if ( $('#resulFabricante').val().indexOf('Digivoice') != -1) {
                             $('#opAvanc').hide(); 
                    } 

                    $('.gsm_khomp_fab').show();
                    $('#JuntorSelect').show();
                    $('.form-notip').show();
                    $('.form-ip').hide();
                    $('.prefx_juntor').hide();
                    $('.form_facip').hide();  console.log('escondeu form_facip');   
              break;
              case 13:
                      $('#opAvanc').show();
              break;
              case 14:
                      if( $('#resulFabricante').val().indexOf('KHOMP') != -1){
                          $('#opAvanc').show();
                      } else if ( $('#resulFabricante').val().indexOf('Digivoice') != -1) {
                          $('#opAvanc').hide(); 
                      } 
              break;
              default:
              console.log('###erro de arranque em tecnologia');
              break;
          }
         
       switch($('#rota_dir').val()) {
              case '11': 
                  $('.div_prefx_sa').show();
              break;
              case '12':
                  $('.div_prefx_en').show();
              break;
              default:
                  $('.div_prefx_en').hide();
                  $('.div_prefx_sa').hide(); 
              break;
       } 
       
}
/*
function getData(){
 console.log ( $('input[type=text][name="cadencias[]"]').val() );
  
  var data = {
                juntor : $('#JuntorSelect').is(':visible') ? $('#JuntorSelect').val() : undefined,
                nome : $('#nome').is(':visible') ? $('#nome').val() : undefined,
                tecnologia : $('#tecnologia').is(':visible') ? $('#tecnologia').val() : undefined,
                JuntorSelect : $('#JuntorSelect').is(':visible') ? $('#JuntorSelect').val() : undefined,
                prefx_juntor : $('#prefx_juntor').is(':visible') ? $('#prefx_juntor').val() : undefined,
                tipo : $('#tipo').is(':visible') ? $('#tipo').val() : undefined,
                rota : $('#rota').is(':visible') ? $('#rota').val() : undefined,
                rota_dir : $('#rota_dir').is(':visible') ? $('#rota_dir').val() : undefined,
                prefx_entrada : $('#prefx_entrada').is(':visible') ? $('#prefx_entrada').val() : undefined,
                prefx_saida : $('#prefx_saida').is(':visible') ? $('#prefx_saida').val() : undefined,
                conta_registro : $('#conta_registro').is(':visible') ? $('#conta_registro').val() : undefined,
                senha_registro : $('#senha_registro').is(':visible') ? $('#senha_registro').val() : undefined,
                dominio : $('#dominio').is(':visible') ? $('#dominio').val() : undefined,
                host : $('#host').is(':visible') ? $('#host').val() : undefined,
                proxy : $('#proxy').is(':visible') ? $('#proxy').val() : undefined,
                protocolo : $('#protocolo').is(':visible') ? $('#protocolo').val() : undefined,
                type : $('#type').is(':visible') ? $('#type').val() : undefined,
                juntor_atend: $('#juntor_atend').is(':visible') ? $('#juntor_atend').val() : undefined,
                juntor_cod_acess : $('#juntor_cod_acess').is(':visible') ? $('#juntor_cod_acess').val() : undefined,
                nat : $('#nat').is(':visible') ? $('#nat').val() : undefined,
                dtmf_mode : $('#dtmf_mode').is(':visible') ? $('#dtmf_mode').val() : undefined,
                insecure : $('#insecure').is(':visible') ? $('#insecure').val() : undefined,
                contexto : $('#contexto').is(':visible') ? $('#contexto').val() : undefined,
                porta : $('#porta').is(':visible') ? $('#porta').val() : undefined,
                ccss_enable : $('#ccss_enable').is(':visible') ? $('#ccss_enable').val() : undefined,
                audio_rx_sync : $('#audio_rx_sync').is(':visible') ? $('#audio_rx_sync').val() : undefined,
                context_gsm_call : $('#context_gsm_call').is(':visible') ? $('#context_gsm_call').val() : undefined,
                context_gsm_sms : $('#context_gsm_sms').is(':visible') ? $('#context_gsm_sms').val() : undefined,
                context_digital : $('#context_digital').is(':visible') ? $('#context_digital').val() : undefined,
                volume_tx : $('#volume_tx_v').is(':visible') ? $('#volume_tx_v').val() : undefined,
                volume_rx : $('#volume_rx_v').is(':visible') ? $('#volume_rx_v').val() : undefined,
                suprimir_id : $('#suprimir_id').is(':visible') ? $('#suprimir_id').val() : undefined,
                block_call : $('#block_call').is(':visible') ? $('#block_call').val() : undefined,
                disconnect_call : $('#disconnect_call').is(':visible') ? $('#disconnect_call').val() : undefined,
                context_fxo : $('#context_fxo').is(':visible') ? $('#context_fxo').val() : undefined,
                context_fxo_alt : $('#context-fxo-alt').is(':visible') ? $('#context').val() : undefined,
                fxo_fsk_detection : $('#fxo_fsk_detection').is(':visible') ? $('#fxo_fsk_detection').val() : undefined,
                fxo_fsk_timeout : $('#fxo_fsk_timeout').is(':visible') ? $('#fxo_fsk_timeout').val() : undefined,
                fxo_user_xfer_delay : $('#fxo_user_xfer_delay').is(':visible') ? $('#fxo_user_xfer_delay').val() : undefined,
                fxo_send_pre_audio : $('#fxo_send_pre_audio').is(':visible') ? $('#fxo_send_pre_audio').val() : undefined,
                fxo_busy_disconnection : $('#fxo_busy_disconnection').is(':visible') ? $('#fxo_busy_disconnection').val() : undefined,
                language: $('#language').is(':visible') ? $('#language').val() : undefined,
                mohclass : $('#mohclass').is(':visible') ? $('#mohclass').val() : undefined,
                flash_behaviour : $('#flash_behaviour').is(':visible') ? $('#flash_behaviour').val() : undefined,
                pendulum_digits : $('#pendulum_digits').is(':visible') ? $('#pendulum_digits').val() : undefined,
                pendulum_hu_digits : $('#pendulum_hu_digits').is(':visible') ? $('#pendulum_hu_digits').val() : undefined,
                co_dialtone : $('#co_dialtone').is(':visible') ? $('#co_dialtone').val() : undefined,
                vm_dialtone : $('#vm_dialtone').is(':visible') ? $('#vm_dialtone').val() : undefined,
                pbx_dialtone : $('#pbx_dialtone').is(':visible') ? $('#pbx_dialtone').val() : undefined,
                fast_busy : $('#fast_busy').is(':visible') ? $('#fast_busy').val() : undefined,
                ring_back : $('#ring_back').is(':visible') ? $('#ring_back').val() : undefined,
                waiting_call : $('#waiting_call').is(':visible') ? $('#waiting_call').val() : undefined,
                ring : $('#ring').is(':visible') ? $('#ring').val() : undefined,
                nome_cad : $('#nome_cad').is(':visible') ? $('#nome_cad').val() : undefined,
                val_cad : $('#val_cad').is(':visible') ? $('#val_cad').val() : undefined,
                reenc_chamadas : $('input[name="reenc_chamadas"]').is(':visible') ? $('input[name="reenc_chamadas"]').bootstrapSwitch('state') == true ? '1' : '0' : undefined,
                qualify : $('input[name="qualify"]').is(':visible') ? $('input[name="qualify"]').bootstrapSwitch('state') == true ? '1' : '0' : undefined,
                reinvite : $('input[name="reinvite"]').is(':visible') ? $('input[name="reinvite"]').bootstrapSwitch('state') == true ? '1' : '0' : undefined,
                pro_band : $('input[name="pro_band"]').is(':visible') ? $('input[name="pro_band"]').bootstrapSwitch('state') == true ? '1' : '0' : undefined,
                
  }
     return(data);
}
*/


function resetaCheckBoxes(){
       $('input[name="reenc_chamadas"]').bootstrapSwitch('state', false);
       $('input[name="qualify"]').bootstrapSwitch('state', false);
       $('input[name="reinvite"]').bootstrapSwitch('state', false);
       $('input[name="pro_band"]').bootstrapSwitch('state', false);
}
         
function ativaTecIP(){
        $('.form-notip').hide();
        $('.form-ip').show();
        $('.div_prefx_sa').hide();
        $('.div_prefx_en').hide();
        $('.form_gsm_khomp').hide();
        $('.form_facip').show();   console.log('msotrou form_facip');    
}

function verificaFab(){
         if($('#tecnologia').val() != 11){
            if($('#fabricante').val() == 11){
                ($('.11')).show();
                ($('.12')).hide();
                ($('.13')).hide();
                ($('.14')).hide();
                ($('.15')).hide();
                ($('#juntorSelect')).val('0');
            } else
            if($('#fabricante').val() == 14){
                ($('.11')).hide();
                ($('.12')).hide();
                ($('.13')).hide();
                ($('.14')).show();
                ($('.15')).hide();
                ($('#juntorSelect')).val('0');
            } else 
            if($('#fabricante').val() == 13){
                ($('.11')).hide();
                ($('.12')).hide();
                ($('.13')).show();
                ($('.14')).hide();
                ($('.15')).hide();
                ($('#JuntorSelect')).val('0');
            }


         }
}

function setTecDefaultValues(){
            $('#audio_rx_sync').val('Auto');
            $('#context_gsm_call').val('khomp-DD-CC');
            $('#context_gsm_sms').val('khomp-DD-CC');
            $('#co_dialtone').val('0,0');
            $('#vm_dialtone').val('1000,100,100,100');
            $('#pbx_dialtone').val('1000,100');
            $('#fast_busy').val('100,100');
            $('#ringback').val('1000,4000');
            $('#waiting_call').val('100,100,100,3700');
            $('#context_digital').val('khomp-DD-LL');
            $('#language').val('Pt-br');
            $('#mohclass').val('Default');
            $('#flash_behaviour').val('Auto');
            $('#pend_hangup_digits').val('Auto');
            $('#pend_digits').val('Auto');
            $('#ring').val('1000,4000');
}

function form_gsm_khomp_ON(){
                        $('.gsm_khomp').hide();  
                        $('.form-ip').hide();
                        $('.form_facip').hide();   console.log('escondeu form_facip');    
                        $('.form-notip').show();
                        $('.div_prefx_sa').hide();
                        $('.div_prefx_en').hide();     
                        $('#opAvanc').show();   
}

function form_gsm_khomp_OFF(){
                        $('.gsm_khomp').hide();  
                        $('.form-ip').hide();
                        $('.form_facip').hide();   console.log('escondeu form_facip');    
                        $('.form-notip').show();
                        $('.div_prefx_sa').hide();
                        $('.div_prefx_en').hide();     
                        $('#opAvanc').hide();   
}
     
function opAvancOFF(){
                $('.form_facip').hide();   console.log('escondeu form_facip');    
                $('.gsm_khomp').hide();
                $('.digital_khomp').hide();
                $('.analog_khomp').hide();
                $('.form-ip').hide();
}
 

$('#opAvanc').on('click', function(){
       if($('#opAvanc').val() == 0){     
            switch($('#tecnologia').val()){
               
               case '11': 
                    $('.form_facip').show(); console.log('mostrou form_facip'); 
                    $('.gsm_khomp').hide();
               break;
               
               case '12': 
                    $('.gsm_khomp').show();
                    $('.form_facip').hide();  console.log('escondeu form_facip');    
                    $('.not-ip').show();

               break;
               
               case '13': 
                    $('.gsm_khomp').hide();
                    $('.digital_khomp').show();
                    $('.form_facip').hide();   console.log('escondeu form_facip');    
                    $('.form-ip').hide();
               break;
               
               case '14': 
                    $('.gsm_khomp').hide();
                    $('.digital_khomp').hide();
                    $('.form_facip').hide();   console.log('escondeu form_facip');    
                    $('.form-ip').hide();
                    $('.analog_khomp').show();
               break;
               default:
                    $('.form_facip').hide();   console.log('escondeu form_facip');    
                    $('.gsm_khomp').hide();
                    $('.digital_khomp').hide();
                    $('.analog_khomp').hide();
               break;
            }
         $('#opAvanc').val('1');
       } else {
            $('.form_facip').hide();  console.log('escondeu form_facip');    
            $('.gsm_khomp').hide();
            $('.digital_khomp').hide();
            $('#opAvanc').val('0');
            $('.analog_khomp').hide();
            $('.form-ip').hide();

       }         
}); 
 
$('#tecnologia').on('change', function(){
              $('#opAvanc').val('0');
              switch ($('#tecnologia').val()) {
                case '11' :                       
                    $('#opAvanc').show();
                    $('.form-ip').show();
                    $('.form-notip').hide();
                    $('.prefx_juntor').hide();                
                break;
                case '12' :                   
                    if( $('#JuntorSelect').val().indexOf('-KHOMP') != -1 ){
                        $('#opAvanc').show()
                    } else {
                        $('#opAvanc').hide();
                    }

                    $('.gsm_khomp_fab').show();
                    $('#JuntorSelect').show();
                    $('.form-notip').show();
                    $('.form-ip').hide();
                    $('.prefx_juntor').hide();
                    $('.form_facip').hide();   console.log('escondeu form_facip');    
                break;
                case '13' :    
                    if( $('#JuntorSelect').val().indexOf('-KHOMP') != -1){
                        $('#opAvanc').show()
                    } else if ( $('#JuntorSelect').val().indexOf('-Digivoice') != -1) {
                        $('#opAvanc').hide();
                    }                    
                    
                    $('.form-notip').show();
                    $('.digital_khomp').hide();
                    $('.form-ip').hide();
                    $('.juntor').show();
                    $('.prefx_juntor').hide(); 
                    $('.form_facip').hide();   console.log('escondeu form_facip');    
                break; 
                case '14' :     
                    if( $('#JuntorSelect').val().indexOf('-KHOMP') != -1){
                        $('#opAvanc').show()
                    } else {
                        $('#opAvanc').hide();
                    }

                    $('.form-notip').show();
                    $('.digital_khomp').hide();
                    $('.form-ip').hide();
                    $('.juntor').show();
                    $('.prefx_juntor').hide();
                    $('.form_facip').hide();   console.log('escondeu form_facip');    
                break;
                case '15' : 
                    opAvancOFF();                    
                    $('#opAvanc').hide();
                    $('.digital_khomp').hide();
                    $('.form-ip').hide();
                    $('.juntor').show();
                    $('.prefx_juntor').show();
                    $('.form_facip').hide();   console.log('escondeu form_facip');    
                    $('.form-notip').show();

                break;
                default:
                        $('.gsm_khomp').hide();
                        $('.form-ip').hide();
                        $('.form_facip').hide();   console.log('escondeu form_facip');    
                        $('.form-notip').show();
                        $('.div_prefx_sa').hide();
                        $('.div_prefx_en').hide();
                        $('#opAvanc').hide();
                        $('#JuntorSelect').show();
                        opAvancOFF();
                break;
     }
});         

$('#JuntorSelect').on('change', function(){
     switch( $('#tecnologia').val() ){
          case '12' : 
             setTecDefaultValues();
             form_gsm_khomp_ON();
             if (  $('#JuntorSelect').val().indexOf('-Digivoice') != -1 || $('#JuntorSelect').val().indexOf('-Dahdi') != -1 ){ 
             form_gsm_khomp_OFF();
             console.log('GSM - Digivoice');
             $('#OpAvanc').hide();
             }
          break;
          case '13' :
                if(  $('#JuntorSelect').val().indexOf('-KHOMP') != -1 ){ //Se for Digital e KHOMP           
                     setTecDefaultValues();
                     //verificaFab(); 
                     form_gsm_khomp_OFF();
                     $('.digital_khomp').hide();
                     $('#opAvanc').show();
                     $('.prefx_juntor').hide();
                } else if (  $('#JuntorSelect').val().indexOf('-Digivoice') != -1 || $('#JuntorSelect').val().indexOf('-Dahdi') != -1  ){ 
                    $('#OpAvanc').hide(); 
                    form_gsm_khomp_OFF();
                    $('.digital_khomp').hide();
                }
          break;   
          case '14' : 
                 if( $('#JuntorSelect').val().indexOf('-KHOMP') != -1){  //Se for Analógico e KHOMP
                     $('.analog_khomp').hide();
                     $('.digital_khomp').hide();
                     form_gsm_khomp_OFF()
                     $('.form-ip').hide();
                     $('.prefx_juntor').hide();
                     $('#opAvanc').show();
                 } else if ( $('#JuntorSelect').val().indexOf('-Digivoice') != -1 || $('#JuntorSelect').val().indexOf('-Dahdi') != -1  ){ 
                     $('#OpAvanc').hide();
                     form_gsm_khomp_OFF(); 
                     $('.digital_khomp').hide();
                     $('.analog_khomp').hide();
                 }
          break;
          case '15' : 
                     $('.analog_khomp').hide();
                     $('.digital_khomp').hide();
                     form_gsm_khomp_OFF()
                     $('#opAvanc').hide();
                     $('.form-ip').hide();
                     $('.prefx_juntor').show();
          break;
          default : 
                     //verificaFab();
                     $('.digital_khomp').hide();
                     form_gsm_khomp_OFF();
          break;

     }     
});

$('#rota_dir').on('change', function(){
        if($('#rota_dir').val() != 0){
            switch ($('#rota_dir').val()){
               
               case '11' : //saída
                 $('.div_prefx_sa').show();
                 $('.div_prefx_en').hide();
                 $("#fidelidade_field").show();

               break;
               
               case '12' : //entrada
                //se for legado
                $("#fidelidade_field").hide();

                if( $("#tecnologia").val() == '15' ){
                    $('.div_prefx_en').show();
                } else {
                    $('.div_prefx_en').hide();
                }

                  $('.div_prefx_sa').hide();
               break;
               
               case '13' : //bidirecional

                  $("#fidelidade_field").show();
                  $('.div_prefx_sa').show();
                  $('.div_prefx_en').hide();
               break;
               
               default:
                  $("#fidelidade_field").show();
                  $('.div_prefx_sa').hide();
                  $('.div_prefx_en').hide();
               break;
            }
        } else {
             
             $('#rota_dir').val('0');
             $('.div_prefx_sa').hide();
             $('.div_prefx_en').hide();
             $('.digital_khomp').hide();
           
           }
});
         
$('#juntor_cod_acess').focus(function(){
       $('#juntor_cod_acess').val('');
});

$('#juntor_cod_acess').blur( function (){
               $cod = $('#juntor_cod_acess').val();
               if($cod<11 || $cod>99){
                 $('#juntor_cod_acess').val('O número precisa ser entre 11 e 99');
               } else if($cod == 'O número precisa ser entre 11 e 99'){
                 $('#juntor_cod_acess').val('');
               } 
});
  
$('#audio_tx').on('input', function(){
$('#volume_tx_v').val($('#audio_tx').val());
});
$('#audio_rx').on('input', function(){
$('#volume_rx_v').val($('#audio_rx').val());
});
$('#volume_rx_v').on('input', function(){
$('#audio_rx').val($('#volume_rx_v').val());
});    
$('#volume_tx_v').on('input', function(){
$('#audio_tx').val($('#volume_tx_v').val());
}); //Binds      

     
if( $('#setarJuntor').val() != 'vazio' ){
       $('#JuntorSelect').find('option').each( function(){
       });
}
  
