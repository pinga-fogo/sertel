@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Listagem de Perfis de Ramais
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i> <a href="{{route('admin.ramais.index')}}"> Ramais</a> / Perfis de Ramais
                </li>
            </ol>
        </div>
    </div>
    <a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Criar Perfil de Ramais</a><br>

    {{-- para carregar listagem normal sem data table --}}
    {{-- @include('admin.accounts.list') --}}

    {{-- para carregar listagem com data table --}}
    @include('admin.ramais..profiles.datatable')


   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalDefaultTitle"></h4><br><br>
         <div id='msgFeedBack' class='alert alert-danger hidden'>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <ul id='listaerros'>
             
             </ul> 
        </div>
      </div>
      <div class="modal-body" id="modalDefaultBody">
        <form action="{{route('admin.profiles_ramais.store')}}" id='formProfiles' method='get'>
                     @include('admin/ramais/profiles/profile_ramais_formfields')

      </div>
       <div class="modal-footer">
           <div id='cadFooter'>
            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
            <button type="button" id="enviar" class="btn btn-primary" >Cadastrar</button>
      </div>
          
      <div id='editFooter'> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" id="edit" class="btn btn-primary">Salvar</button>
      </div>

            </form>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src='/assets/js/validador.js'></script>
<script src='/assets/js/controlePerfil.js'></script>

<script>


function showEdit(id){

                json = sessionStorage.getItem(id);
                json = JSON.parse(json);

                $("#formProfiles").attr('action', "{{route('admin.profiles_ramais.update')}}/"+id);
                
                      
                    
                 $('#cadFooter').hide(),     
                 $('#editFooter').show();
                 $('input[name="id"]').val(id);                
                 $('#nome').val(json.nome),   
                 
                 $('input[name="mcdu_send"]').bootstrapSwitch('state', json.envia_mcdu == '1' ? true : false),
                 $('input[name="collect_call"]').bootstrapSwitch('state', json.aceita_a_cobrar == '1' ? true : false),
                 $('#group_capture').val(json.grupo_captura),
                 $('#capture_groups').val(json.captura_grupos),
                 $('input[name="internal_access"]').bootstrapSwitch('state', (json.acesso_interno == '1' ? true : false)),
                 $('input[name="local_access"]').bootstrapSwitch('state', json.acesso_local == '1' ? true : false),
                 $('input[name="fixed_access_ddd"]').bootstrapSwitch('state',json.acesso_fixo_ddd == '1' ? true : false),
                 $('input[name="access_mobile_local"]').bootstrapSwitch('state',json.acesso_movel_local== '1' ? true : false ),
                 $('input[name="ddd_mobile_access"]').bootstrapSwitch('state',json.acesso_movel_ddd == '1' ? true : false),
                 $('input[name="special_access"]').bootstrapSwitch('state',json.acesso_especial == '1' ? true : false),
                 $('input[name="access_number_services"]').bootstrapSwitch('state',json.numeros_servico == '1' ? true : false),
                 $('input[name="especial_access_rota"]').bootstrapSwitch('state',json.rota_especial== '1' ? true : false ),              
                 $('input[name="conference"]').bootstrapSwitch('state',json.conferencia == '1' ? true : false),
                 $('input[name="query_sale"]').bootstrapSwitch('state',json.consulta_saldo == '1' ? true : false),
                 $('input[name="do_not_disturb"]').bootstrapSwitch('state',json.nao_perturbe == '1' ? true : false),
                 $('input[name="enable_follow_me"]').bootstrapSwitch('state', json.siga_me == '1' ? true : false),
                 $('input[name="server_information"]').bootstrapSwitch('state', json.informacoes_servidor== '1' ? true : false),
                 $('input[name="login_queue"]').bootstrapSwitch('state',json.acesso_fila == '1' ? true : false),
                 $('input[name="last_external_number_received"]').bootstrapSwitch('state',json.ultimo_no_externo_recebido== '1' ? true : false ),
                 $('input[name="last_received_number_internal"]').bootstrapSwitch('state', json.ultimo_no_interno_recebido== '1' ? true : false),
                 $('input[name="access_to_voice_mail"]').bootstrapSwitch('state',json.voice_mail== '1' ? true : false ),
                 $('input[name="ramal_talks"]').bootstrapSwitch('state',json.fala_ramal== '1' ? true : false ),   
                 $('input[name="agenda"]').bootstrapSwitch('state',json.agenda== '1' ? true : false ),   
                 $('input[name="padlock"]').bootstrapSwitch('state',json.cadeado== '1' ? true : false ),   
                             
                 $('input[name=antigos]').val($('#nome').val());
                 $('#myModal').modal('toggle');          
   } 




























function resetaForm(){
               console.log('resetaForm()');   
               
               $("#formProfiles").attr('action', '{{route('admin.profiles_ramais.store')}}');

               $('#editFooter').hide();
               $('#cadFooter').show();
               
               $('#myModal')
                  .find("input")
                     .val('')
                     .removeAttr('disabled')
                     .end()
                  .find("option")
                     .show()
                     .end()
                  .find(".switch").bootstrapSwitch('state', false);     
}


</script>
<script>
    $(function(){
         sessionStorage.clear();
         $('#editFooter').hide();
          
          $('body').on('hidden.bs.modal','.modal', function(){
          console.log('hidden Modal');
          resetaForm();
          });

         $('#enviar').on('click', function(){
           if(valida()){
              $("#formProfiles").submit();  
           }
         });

         $("#edit").on('click', function(){
            if(valida()){
              $("#formProfiles").submit();  
            }
         })



 });
</script>
@endpush