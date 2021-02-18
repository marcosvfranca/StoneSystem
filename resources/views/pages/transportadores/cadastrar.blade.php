@extends('pages.transportadores.transportadores')
@section('transportadores')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar transportador</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('transportadores.inserir') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6 form-group">
                            <input class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="Nome" value="{{ old('nome') }}" autofocus>
                            @error('nome')
                            <span class="error text-danger">{{ $errors->first('nome') }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <input class="form-control placa @error('placa') is-invalid @enderror" name="placa" placeholder="Placa" value="{{ old('placa') }}">
                            @error('placa')
                            <span class="error text-danger">{{ $errors->first('placa') }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" class="btn btn-warning"> Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
