@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Listagem de grupos
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/groups/">Grupos</a>
            </li>
            <li class="active">
                <i class="fa fa-list-alt"></i> Listagem de grupos
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Total de usuários</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Grupo 1</td>
                        <td class="center">25</td>
                        <td>
                            <a href="{{route('admin.groups.update')}}" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="#" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
