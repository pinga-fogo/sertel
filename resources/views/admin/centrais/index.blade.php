@extends('admin.base')
@section('content')
        <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           Centrais
        </h1>
        <ol class="breadcrumb">
            <li class='active'>
                <i class="fa fa-list"></i>  <a href="{{route('admin.troncos.index')}}"> Troncos</a> / Centrais
            </li>
        </ol>
    </div>
</div>
		
@include('admin.centrais.centraisDataTables')    

@include('admin.centrais.modalCentrais')

@endsection
@push('scripts')
<script src="/assets/js/validador.js"></script>
<script>
function resetaForm(){
               console.log('resetando formulário...');   
               $('#editFooter').hide();
               $('#cadFooter').show();
               
               $('#myModal')
                  .find("input[type=text]")
                     .val('')
                     .removeAttr('disabled')
                     .end()
                   
                 
               $("#filial").prop('checked', true);  
               $("#tronco").val('0');

               $("#form_centrais").attr('action', "{{route('admin.centrais.store')}}")
               $("#div_lista_erros").hide();
}

function showEdit(id){
      $("#form_centrais").attr('action', '{{route('admin.centrais.update')}}/'+id);

      json = sessionStorage.getItem(id);
      json = JSON.parse(json);

      $('#nome').val(json.nome);
      
      $("#codigo").val(json.codigo);

      $("#tronco").val(json.tronco);

      if(json.tipo == 1){
        $("#filial").prop('checked', true);
      } else {
        $("#matriz").prop('checked', true);
      }

      $("#myModal").modal('toggle');
      

      //$('#numeroAntigo').val( $('#numero').val() );

}

function penduraErros(erro){
  $('#div_lista_erros').show();
  $('#lista_erros').append('<li>'+erro+'</li>');
}


</script>
<script>
     $(function(){
         resetaForm();
         sessionStorage.clear();

         $('#myModal').on('hidden.bs.modal', function () {
               resetaForm();
         });
         
         $('#enviar').on('click', function(){
                if(valida()){
                   $("#form_centrais").submit();
                }     
        });
        
         $('#edit').on('click', function(){
                if(valida()){
                   $("#form_centrais").submit();
                 }     
         });

           

     });
</script>

@endpush