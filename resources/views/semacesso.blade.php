@extends('layouts.app', ['activePage' => 'sem_acesso', 'titlePage' => __('Sem acesso')])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">Você não possui acesso a essa página, contate o administrador do sistema</div>
                </div>
            </div>
        </div>
    </div>
@endsection
