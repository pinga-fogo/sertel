<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Tipo de conta</th>
                        <th>Grupo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr data-tr="{{$user->id }}">
                            <td>{{$user->name}}</td>
                            <td> {{$user->profile->lastname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ ($user->role==='admin') ? 'Administrador' : 'Usuário' }}</td>
                            <td>Grupo {{ $user->group_id }}</td>
                            <td>
                                <a  href="{{route('admin.accounts.edit' , $user->id  )}}" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>
                                <a data-id="{{$user->id }}" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse usuário?" href="{{route('admin.accounts.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $users->render(); !!}
    </div>
</div>
<!-- /.row -->
