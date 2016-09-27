@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Voice Mail
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i> <a href="{{route('admin.ramais.index')}}">Ramais</a> / Voice Mail
                </li>                
            </ol>                   
      </div>
    </div>

    <!-- /.row -->
    <div class='row'> 
    <!--<a href="{{route('admin.ramais.create')}}" class="btn btn-block btn-info"><span class="glyphicon glyphicon-plus"></span> Criar Novo Ramal</a><br> -->
    <a id='createButton' class="btn btn-block btn-info btn btn-info gsm_khomp digital_khomp" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Novo Voice Mail</a><br> 

    @include('admin.voice_mail.modalForm')
    <!-- <button type="button" class="btn btn-info gsm_khomp digital_khomp" data-toggle="modal" data-target="#myModal">Nova Cadência</button> -->
    @include('admin.voice_mail.datatables')

@endsection

@push('scripts')
<script src="/assets/js/validador.js"></script>
<script src='/assets/js/select2.min.js'></script>
<script src='/assets/js/editor.js'></script>



<script>
//pega os ramais para o Select
function getRamais(){

    $.ajax({
       'url':"{{route('datatables.ramais')}}",
       'type': 'GET',
        success: function(response){
              if(response.data.length < 1)
              {
                 var emptyMsg = "<br><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i>\
                                    <p class='text-danger'>Nenhum Ramal Cadastrado</p>\
                                    <p class='text-danger'>Clique <a href='{{route('admin.ramais.index')}}'>AQUI</a> para Adicionar um.</p></div>";
                 $('.select2-container').after(emptyMsg);    
                 $('.selection').hide();
              } 
              else 
              {              
                  for (i in response.data){
                    $('#ramal').append( $('<option value='+response.data[i].id+'>'+response.data[i].nome+'</option>') );
                  }
              }     

          $('#ramal').select2();
          
          /*faz o plugin select2 ser reordenável
           $('.select2-selection__rendered').sortable({
              containment: 'parent',
              start: function() { console.log('starting') },
              update: function() { console.log('updating')  }
           });*/
    

          //ajeita o tamanho do campo
            $('.select2-container').prop('style', 'min-width:30%');
        }     
        
    });
       
}

function showEdit(id){
      json = sessionStorage.getItem(id);
      json = JSON.parse(json);

      //troncos = json.tronco.split(',');
      $('#nome').val(json.nome);
      $('#de').val(json.remetente);
      $('#para').val(json.destino);
      $('#senha').val(json.senha);
      $('.Editor-editor').html( json.mensagem );
      $('#habilitado').bootstrapSwitch('state', json.habilitado);
      
      var ramal = json.ramal;
      
      $("#ramal").val(ramal).trigger('change');

    
      // CRIAR A PARTE DOS JUNTORES
      // for (var i = 0 in ramais){
      //     $('#num_tronco').find('input[type=checkbox][value='+troncos[i]+']').prop('checked', true);
      // }
      
      $('#myModal').modal('toggle');

      $("#formVoiceMail").attr('action', "{{route('admin.voice_mail.update')}}/"+id+'')
      $('#editFooter').show();
      $('#cadFooter').hide();          
      
      $('#numeroAntigo').val( json.numero );
}




function resetaForm(){
               console.log('resetaForm()');   
               $('#editFooter').hide();
               $('#cadFooter').show();
               
               $('#myModal')
                          .find("input")
                             .val('')
                             .removeAttr('disabled')
                             .end()
                          .find("input[type=checkbox], input[type=radio]")
                             .prop("checked", "")
                             .removeAttr('disabled')
                             .end()
                          .find("option")
                             .show()
                             .end()
                          .find("select")
                            .val('0')
                            .removeAttr('disabled')
                            .end();
              
                          $('#msgFeedBack').addClass('hidden');

                          removeErrors();
   }

</script>

<script>
    $(function(){

       sessionStorage.clear();
       $('#editFooter').hide();
        

        $("#editor").Editor({
            'texteffects':true,
            'aligneffects':true,
            'textformats':true,
            'fonteffects':true,
            'actions' : true,
            'insertoptions' : true,
            'extraeffects' : true,
            'advancedoptions' : true,
            'screeneffects':true,
            'bold': true,
            'italics': true,
            'underline':true,
            'ol':true,
            'ul':true,
            'undo':false,
            'redo':false,
            'l_align':true,
            'r_align':true,
            'c_align':true,
            'justify':true,
            'insert_link':true,
            'unlink':true,
            'insert_img':false,
            'hr_line':false,
            'block_quote':true,
            'source':true,
            'strikeout':true,
            'indent':true,
            'outdent':true,
            'print':false,
            'rm_format':false,
            'status_bar':true,
            'splchars':false,
            'insert_table':true,
            'select_all':false,
            'togglescreen':true
        });                   

        resetaForm();
      
       $('body').on('hidden.bs.modal','.modal', function(){
          //console.log('hidden Modal');
          resetaForm();
        });
       
       $('#enviar').on('click',function(){
              if(valida()){                
                $("input[name=mensagem]").val( $('.Editor-editor').html() );
                          
                $('#formVoiceMail').submit();
              } 
       });

       $('#editar').on('click',function(){
              if(valida()){
                $("input[name=mensagem]").val( $('.Editor-editor').html() );

                $('#formVoiceMail').submit();

              } 
       });
       
       //povoa o Select de Ramais
       getRamais();

       //$('.select2-container').prop('style', 'min-width:30%');

});
</script>
@endpush