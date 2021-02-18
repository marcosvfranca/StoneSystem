@extends('pages.observacoeschapas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Alterar observação de chapa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('observacoes-chapas.update', ['observacoes_chapa' => $observacaoChapa->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Nome" value="{{ $observacaoChapa->descricao }}">
                            @error('descricao')
                            <span class="error text-danger">{{ $errors->first('descricao') }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <input class="form-control @error('apelido') is-invalid @enderror" name="apelido" placeholder="Apelido" value="{{ $observacaoChapa->apelido }}">
                            @error('descricao')
                            <span class="error text-danger">{{ $errors->first('apelido') }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" class="btn btn-warning"> Alterar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
