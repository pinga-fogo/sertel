function removeErrors(){
      $('.has-error').removeClass('has-error');
      $('#listaerros').empty();
 }

 function valida(){
          
     var flag=0;
              $('#listaerros').empty();

              console.log('validando formulário...');
              $("[data-val='exigido']:visible").each( function(){
              if( $(this).find('input').is(':text') && $(this).find('input').val().length < 1 ){
                   if( $(this).find('input').attr('id') == 'ddr' ){
                       
                       if( $('input[name="habDDR"]').bootstrapSwitch('state') != true ){
                            $(this).removeClass("has-error");           
                       }
                       
                       else {
                           $(this).addClass("has-error");
                           $('input[name="habDDR"]').on('switchChange.bootstrapSwitch', function(){
                                $('.num_ddr').removeClass('has-error');
                           });
                       }
                   } else {     
                      $(this).addClass("has-error");
                       
                      penduraErro($(this).find('input'), $(this)); 
                      $(this).find('input').attr('placeholder','Campo Obrigatório !').on('input', function(){
                           $(this).parent().removeClass('has-error');
                      });    
 
                      flag++;
                      }
              }   
                 
            else if( $(this).find('input').is(':text') && $(this).find('input').val().length > 1) {
                  $(this).removeClass("has-error");
            }
                
            else if( $(this).find('select').val() == 0 || $(this).find('select').val() == ''){
             
             $(this).addClass("has-error");
             
             flag++;

             $(this).find('select').on('change', function(){
                       $(this).parent().removeClass('has-error');
             });


            penduraErro($(this).find('select'), $(this)); 

            }

            });
        
 
          if(flag >= 1){
            
            $('button#submit').on('click', function(){
                 if(valida()){
                  store();
                 }
            });
            return 0;
          } else if(flag==0) {
            return 1;
          }; 
  } 

 function penduraErro(el, parent){
   
   var nome = el.attr('id');   
   console.log(nome);
   
   if(nome != undefined){
   $('#msgFeedBack').removeClass('hidden'); 
   $('#listaerros').append('<li>O campo <u>'
                      +$(parent).find('label[for='
                      +nome+']').html()
                      +'</u> é obrigatório. </li>');
   }

 }


 function validaNomes(nome){
    var nomeAntigo = $("input[name=antigos]").val();
    console.log('nomeAntigo: '+nomeAntigo + '-----' + 'nomeVelho: '+ nome);

    if(nome != ''){
              var nomesarr = $('#nomesStringbuffer').val();
              var nomesdup = nomesarr.split(';');
              
              var nomes = nomesdup.filter(function(este, i) { //remove duplicatas
              return nomesdup.indexOf(este) == i;
              });
              
              if( (nomes.indexOf(nome) != -1) && (nome =! nomeAntigo) ){
                console.log('saiu: 0');
                return 0;
              } else {
                console.log('saiu: 1');
               return 1;
              }
   } else {
   console.log('saiu -1'); 
   return -1; 
   }

 }       