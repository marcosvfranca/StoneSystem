@extends('pages.tiposblocos.tiposblocos')
@section('tiposblocos')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar classificação de bloco</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tiposblocos.inserir') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6 form-group">
                            <input class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Nome" value="{{ old('descricao') }}" autofocus>
                            @error('descricao')
                            <span class="error text-danger">{{ $errors->first('descricao') }}</span>
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
