@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Stone System - Login')])
@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-warning text-center">
            <h4 class="text-uppercase card-title"><strong>{{ __('Entrar') }}</strong></h4>
          </div>
          <div class="card-body">
            <p class="card-description text-center"><strong>{{ __('Digite seu usuário e senha') }} </strong> </p>
            <p class="card-description text-center"><b>{{ __('Não comparti-lhe sua senha!') }} </b> </p>
            <div class="bmd-form-group{{ $errors->has('username') || $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input autofocus type="text" name="login" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Usuário...') }}" value="{{ old('username') ?: old('email') }}" required>
              </div>
              @if ($errors->has('username') || $errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="login" style="display: block;">
                  <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
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
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Senha...') }}" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-warning btn-lg text-uppercase">{{ __('Entrar') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
