  //   function getData(){
	 // console.log('password:' + $('#password ').val());
	 // var data ={ 
	 //                    nome : $('#nome').is(':visible') ? $('#nome').val() : undefined,
	 //                    tipo : $('#tipo').is(':visible') ? $('#tipo').val() : undefined,
	 //                    tec : $('#tec').is(':visible') ? $('#tec').val() : undefined,
	 //                    app : $('#app').is(':visible') ? $('#app').val() : undefined,      
	 //                    number : $('#number').is(':visible') ? $('#number').val() : undefined,
	 //                    ddr : $('#ddr').is(':visible') ? $('#ddr').val() : undefined,
	 //                    habDDR : $('input[name="habDDR"]').is(':visible') ? $('input[name="habDDR"]').bootstrapSwitch('state') : undefined,
	 //                    password : $('#password').is(':visible') ? $('#password').val() : undefined,
	 //                    deviation : $('#deviation').is(':visible') ? $('#deviation').val() : undefined,      
	 //                    profile : $('#profile').is(':visible') ? $('#profile').val() : undefined,                          
	 //                    detour : $('#detour').is(':visible') ? $('#detour').val() : undefined,     
	 //                    padlock : $('#padlock').is(':visible') ? $('#padlock').val() : undefined,      
	 //                    no_externo : $('#no_externo').is(':visible') ? $('#no_externo').val() : undefined,
	 //                    notdisturb : $('input[name="notdisturb"]').is(':visible') ? $('input[name="notdisturb"]').bootstrapSwitch('state') : undefined,
	 //                    conference : $('input[name="conference"] ').is(':visible') ? $('input[name="conference"]').bootstrapSwitch('state'): undefined,
	 //                    centercost : $('input[name="centercost"] ').is(':visible') ? $('input[name="centercost"]').bootstrapSwitch('state'): undefined,
	 //                    intercomaccess : $('input[name="intercomaccess"] ').is(':visible') ? $('input[name="intercomaccess"]').bootstrapSwitch('state'): undefined,
	 //                    capture : $('input[name="capture"] ').is(':visible') ? $('input[name="capture"]').bootstrapSwitch('state'): undefined,
	 //                    parking_calls : $('input[name="parking_calls"]').is(':visible') ? $('input[name="parking_calls"]').bootstrapSwitch('state'): undefined,
	 //                    accountcode : $('input[name="accountcode"]').is(':visible') ? $('input[name="accountcode"]').bootstrapSwitch('state'): undefined,
	 //                    nat:  $('input[name="nat"]').is(':visible') ? $('input[name="nat"]').bootstrapSwitch('state') : undefined
	 //                 };
      
  //     console.log('profile:  '+data.profile);
	 //  return data;                
  //   }


	 function verificaDDR(){
		    if ($('#ddr').val() == ''){
		         $("#ddr").attr('readonly', 'readonly');
		         $('#habDDR').bootstrapSwitch('state', false);
		       } else {
		         $("#ddr").removeAttr('readonly');  
		         console.log('ro');
		         $('#habDDR').bootstrapSwitch('state', true);
		    }
	 }
     


     function setTec(){
           var val = $('#tec').val(); 
           
           if(val== 12 || val == 13 || val == 14){
                $('.nat').show();
                $('.senha_field').show();
                $("#centrais").hide();
                $('.porta').hide();
           } else if(val==15){
           		$('.senha_field').hide();
           		$('.porta').show();
           		$("#centrais").hide();
           		$(".nat").hide();
           } else if(val==16){
           	    $('.senha_field').hide();
           		$("#centrais").show();
           		$(".nat").hide();
           		$('.porta').hide();
           }
           else {
           	    $('.senha_field').hide();
           	    $('.nat').hide();
           	    $("#centrais").hide();
           	    $('.porta').hide();
           }
     }

	 function setUser(){
	                    $('.form_pabx').hide();
	                    $('.form_din').hide();           
	                    $('#tec').removeAttr('readonly');

	                    if ($('#app').parent().hasClass('has-error') ){
	                      $('#app').parent().removeClass("has-error");
                        }

	                    if($('#tipo').val()==1 || $('#tipo').val()==0){
	                       $('#tec').find('option[value=15]').hide();
	                       $('#tec').find('option[value=16]').hide();              
	                       $('#app').val('111');
	                       //mostrarFormApp(); 
	                       $('#app').find('option[value=112]').hide(); 
	                       $('#app').find('option[value=113]').hide(); 
	                       $('#app').find('option[value=114]').hide(); 
	                       $('#app').find('option[value=115]').hide(); 
	                       $('#app').find('option[value=116]').hide(); 
	                       $('#app').attr('readonly', 'readonly');
	                       $('.form_trc').hide();
	                       $('.profile').hide();
	                       $('.porta').hide();
	                    } else if ($('#tipo').val() == 39){
	                        $('#tec').find('option[value=15]').show();
	                        $('#tec').find('option[value=16]').show(); 
	                        //$('#app').val('0');
	                        mostrarFormApp();  
	                        $('#app').find('option[value=112]').show(); 
	                        $('#app').find('option[value=113]').show(); 
	                        $('#app').find('option[value=114]').show(); 
	                        $('#app').find('option[value=115]').show(); 
	                        $('#app').find('option[value=116]').show();
	                        $('#app').removeAttr('readonly');
	                        $('.form_trc').hide();
     	                    $('.profile').show();
	                    } 
	 }
	    	    
	 function setDeviation(){
	           $('.form_deviation').hide();
	           if($('#deviation').val()!=0){
	           $('.form_deviation').show();
	           } 
	 }

	 function setDesvioPara(){
	           if($('#detour').val() != 0){

	               if($('#detour').val() == 3){
	                   $('.noexterno').show();   
	               } else {
	                   $('.noexterno').hide();
	               }
	             
	           } else {
	              $('.noexterno').hide();
	           }
	 }
	     
	 function setDesvio(){
	            var desvio = $('#deviation').val();

	            if (desvio != 0){ 	              
	              $('.detour').show();	              
	            } else if (desvio == 0 ){
	              $('.detour').hide();
	            }

 	            $('#detour').val(0);

	 }

	 function mostrarFormApp(){
	             console.log('mostrarFormApp()');
	             var select_tec = $("#tec");
	             var fila = $("#fila");
	             var val_aplicacao = $('#app').val();

	              if($('#app').val() != 0){
	                 
		                 if($("#habDDR").val('') ){
		                  		 $("#ddr").attr('readonly','readonly');
		                 } else{
		                   		 $("#ddr").removeAttr('readonly');
		                 }

		                if(val_aplicacao==111){ //PABX
			                  $('.form_din').show();
			                  $('.form_pabx').show();
			                  $('#habDDR').show();
			                  fila.hide();
			                  select_tec.removeAttr('readonly');

			                  if($('#tipo').val() == 39) {
			                     $('.profile').show();
			                  } 
			                  else{
			                     $('.profile').hide();
			                  }

			                  select_tec.find('option[value!=16]').show();
			                  select_tec.val(0);
		                } else if(val_aplicacao==112){ //DAC
			                  $('.form_din').show();
			                  $('.form_pabx').hide().find();
			                  $('.profile').hide();
			                  $('.nat').hide();
			                  
			                  fila.show();
			                  select_tec.removeAttr('readonly');
		                      select_tec.find('option[value!=16]').show();
		                      select_tec.val(0);

		                } else if(val_aplicacao==113){// URA
			                  $('.form_din').show();
			                  $('.form_pabx').hide();
			                  $('#senha').hide();
			                  $('.nat').hide();
			                  $('.profile').hide();
			                  fila.hide();
			                  select_tec.removeAttr('readonly');

			                  $("#tec").find('option[value!=16]').hide();
		                } else if(val_aplicacao==116){ //Porteiro
			                  select_tec.val('12');
			                  select_tec.attr('readonly', 'readonly');	
			                  $('.nat').show();
			                  $('.form_pabx').hide();
			                  select_tec.find('option[value!=16]').show();
			                  select_tec.val(0);
		                }
		                else {
		                  $('.form_din').show();
		                  $('.form_pabx').hide();
		                  fila.hide();
		                  $('.profile').hide();
	                      select_tec.removeAttr('readonly');
	                      $('.nat').hide();
		                } 
	               }
	               else {
	                  $('.form_din').hide();
	                  fila.hide();
	                  $('.profile').hide();
	                  $('.nome').hide();
	                  $('.habDDR').hide();
	                  $('.form_pabx').hide();
	                  select_tec.removeAttr('readonly');
	                  select_tec.val('0');
	                  $('.nat').hide();
	                }
	 } 
	 
	 function resetaCheckBoxes (){
	       $('input[name="habDDR"]').bootstrapSwitch('state', false);
	       $('input[name="notdisturb"]').bootstrapSwitch('state', false);
	       $('input[name="conference"]').bootstrapSwitch('state', false);
	       $('input[name="accountcode"]').bootstrapSwitch('state', false);
	       $('input[name="centercost"]').bootstrapSwitch('state', false);
	       $('input[name="intercomaccess"]').bootstrapSwitch('state', false);
	       $('input[name="capture"]').bootstrapSwitch('state', false);
	       $('input[name="parking_calls"]').bootstrapSwitch('state', false);
   	       $('input[name="nat"]').bootstrapSwitch('state', false);
	 }
	       


     
 
