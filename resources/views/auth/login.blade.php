@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class='col-md-6 col-md-offset-3'>
            <div class="panel panel-default" style='width:100%'>
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  ">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" style='width:100%; margin-right:20px,margin-left:5px' value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control"  style='width:100%' name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Lembrar
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Entrar
                                </button>
                            </div>
                             <div class='col-md-6 col-md-offset-4'>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu sua senha?</a>
                             </div>
                        </div>



                        <!-- DUMP FORM -->
                       

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
@endsection
@push('scripts')



@endpush