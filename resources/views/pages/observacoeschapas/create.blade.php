@extends('pages.observacoeschapas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar observação de chapa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('observacoes-chapas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Nome" value="{{ old('descricao') }}">
                            @error('descricao')
                            <span class="error text-danger">{{ $errors->first('descricao') }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <input autofocus class="form-control @error('apelido') is-invalid @enderror" name="apelido" placeholder="Apelido" value="{{ old('apelido') }}">
                            @error('apelido')
                            <span class="error text-danger">{{ $errors->first('apelido') }}</span>
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
