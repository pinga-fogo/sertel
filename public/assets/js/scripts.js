$(function(){


    $('table').tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    $('table').on('click','[data-action=confirm-delete]', function(e){
        e.preventDefault();

        var $this = $(this);
        swal({
            title: $this.data('title'),
            text: $this.data("text"),
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Deletar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false,
            showLoaderOnConfirm: true
        },
        function(isConfirm){

            var id = $this.data('id');

            if (isConfirm) {
                $.get($this.attr('href')+'?id='+id,function(data){
                    if(data.status){
                        $this.parents('tr').remove();
                        // $this.parents('[data-tr='+id+']').remove();
                        //swal("Deletado!", "Registro deletado com sucesso!.", "success");
                        swal({title: "Deletado!",
                              text: "Registro deletado com sucesso!.",
                              type: 'success',
                              timer: 2000,   showConfirmButton: false
                            });
                        
                        //Se receber portas no retorno
                        //significa que removeu um Dgv
                        //e necessita retirar a marcação 
                        //destas portas
                        if(data.portas){
                            var portas = data.portas.split(',');

                            portas.map(function(el){
                               dom = $('.portadgv[value="'+el+'"]');
                               console.log(dom);
                               dom.checked = false;
                               dom.removeAttr('disabled');
                            });
                        }

                        if(resetIndexes != undefined){ //reseta os índices da table do hardware se existir a função
                          resetIndexes();
                        }
                        if(atualizaBanco != undefined){//atualiza o banco do hardware de acordo com a tabela.
                          atualizaBanco();
                        }


                    }else{
                        swal("Erro ao cancelar", "Por favor tente novamente", "error");
                    }
                });
            } else {
                swal("Cancelado", "A ação foi cancelada", "error");
            }
        });
    });

});
// $('.nestable')
// $('.dd')
/*
    jQuery Masked Input Plugin
    Copyright (c) 2007 - 2015 Josh Bush (digitalbush.com)
    Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
    Version: 1.4.1
*/
 
 
/*function nastable($obj, fnChange){
    $obj.off();
    $obj.nestable({
        group: 1
    });
    $obj.off('change');
    $obj.on('change', function() {
        fnChange();
    });
}*/

$('.switch').bootstrapSwitch({onColor:'success', offColor: 'danger'});

 /*function getTec(){
    $('#tec').html('<option>carregando..</option>');
    var checked = $('#tec').data('key');
    console.log('ch '+checked);
    getRamaisSettings(2, checked,  function(obj, html){
        $('#tec').html(html);
        getApp();
    }) 
}  
 
function getApp(){
    $('#app').html('<option>carregando..</option>');
    var tec_id = $('#tec').val();
    var checked = $('#app').data('key');
    getRamaisSettings(tec_id, checked, function(obj, html){

        $('#app').html(html);
       // showItensForm($('#app'));
    })
} 
 */

/*function getRamaisSettings(parent_id, checked, fnCallback){
    $.get('/dashboard/ramais/settings/subtypes/',{parent_id: parent_id}, function(data){
        var html = '';
        for(i in data.subtypes){

            if(data.subtypes[i].id==checked){
                html += '<option value="'+data.subtypes[i].id+'" data-key="'+data.subtypes[i].form_key+'" selected="selected">'+data.subtypes[i].name+'</option>';
            }else{

                html += '<option value="'+data.subtypes[i].id+'" data-key="'+data.subtypes[i].form_key+'">'+data.subtypes[i].name+'</option>';
            }
        }
         if($('#master_id').val()==39){ 
         fnCallback(data, "<option value='8' data-key='form_pabx'> PABX </option>"+html);
         } else {
         fnCallback(data, '<option value="0"> ‹‹ selecione ›› </option>'+html);
         }
    },'json'); 
} */

/*


function showItensForm($el){

    console.log($el.val());
    
    /*PABX 10
      DAC 11
      URA 12
      DISA 13
      FAX 14
      PORTEIRO 15
   
  
    if($('#master_id').val()==39){
       //$('#tec').find('option[value=6]').hide();
       //$('#tec').find('option[value=7]').hide();
       $("#fieldsetfac").hide();
       //$('[class=form_pabx]').hide();
       //$('#ddr').show;
       //$('#number').show;
       //$('#password').show;
       //$('#tec').val('3');        
    } else {
       $('#tec').find('option[value=6]').show();
       $('#tec').find('option[value=7]').show();  
       $('#app').attr('enabled','enabled');   
       $("fieldset").show();
       //$('[class=form_din]').show();
    }

    if($el.val()>0){
        if($('#master_id').val()==39){
        $('.form_din').show();
      }
    }

    var key = $el.find('option:selected').data('key');

    $('.form_pabx').hide();

    $('.form_pabx').each(function(i){
        var input = $(this).find('input').val('');
        input.val(input.data('default'));
    });
    
    if(key!=""){
        $('.'+key).show();
    }
}  */

  

// Aplicação Do TRONCO / USER (Master_Id)

