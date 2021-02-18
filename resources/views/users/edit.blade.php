@extends('users.padrao')
@section('padrao')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Editar funcionário</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card card-login card-hidden mb-3">
                            <div class="card-body ">
                                <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="material-icons">face</i>
                                          </span>
                                        </div>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="{{ __('Nome...') }}" value="{{ $user->name }}" required autofocus>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div id="name-error" class="error text-danger pl-3" for="name"
                                             style="display: block;">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="material-icons">face</i>
                                          </span>
                                        </div>
                                        <input type="text" name="username" class="form-control"
                                               placeholder="{{ __('Funcionário...') }}" value="{{ $user->username }}" required>
                                    </div>
                                    @if ($errors->has('username'))
                                        <div id="username-error" class="error text-danger pl-3" for="username"
                                             style="display: block;">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                          </span>
                                        </div>
                                        <input type="email" name="email" class="form-control"
                                               placeholder="{{ __('Email...') }}" value="{{ $user->email }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                             style="display: block;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                          </span>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control"
                                               placeholder="{{ __('Senha...') }}">
                                    </div>
                                    @if ($errors->has('password'))
                                        <div id="password-error" class="error text-danger pl-3" for="password"
                                             style="display: block;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div
                                    class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                              </span>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="form-control" placeholder="{{ __('Confirme a senha...') }}">
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <div id="password_confirmation-error" class="error text-danger pl-3"
                                             for="password_confirmation" style="display: block;">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('grupos_usuarios_id') ? ' has-danger' : '' }}">
                                    <label for="grupos_usuarios_id" style="margin: 20px 0px 10px 20px;">Setor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="material-icons">supervisor_account</i>
                                          </span>
                                        </div>
{{--                                <div class="bmd-form-group{{ $errors->has('grupos_usuarios_id') ? ' has-danger' : '' }}">--}}
                                        <select name="grupos_usuarios_id" class="form-control select2">
                                            <option value="">Selecione o setor</option>
                                            @foreach($gruposusuarios as $g)
                                                <option value="{{ $g->id }}" @if($user->grupos_usuarios_id == $g->id) selected @endif>{{ $g->nome }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('grupos_usuarios_id'))
                                        <div class="error text-danger pl-3"
                                             style="display: block;">
                                            <strong>{{ $errors->first('grupos_usuarios_id') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit"
                                        class="btn btn-warning btn-lg">{{ __('Alterar funcionário') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
