@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Áudios
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    Áudios
                </li>                
            </ol>                   
      </div>
    </div>

    <!-- /.row -->
    <div class='row'> 
    <!--<a href="{{route('admin.ramais.create')}}" class="btn btn-block btn-info"><span class="glyphicon glyphicon-plus"></span> Criar Novo Ramal</a><br> -->
    <a id='createButton' class="btn btn-block btn-info btn btn-info gsm_khomp digital_khomp" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Importar Áudio</a><br> 

    @include('admin.audios.modalform')
    
    @include('admin.audios.datatables')


@endsection

@push('scripts')


<script>
  $('#editFooter').hide();
  $("#enviar").on('click', function(){
      $("#formAudio").submit();
  });

</script>


@endpush