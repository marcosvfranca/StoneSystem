@extends('pages.estadoschapas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Alterar estado de chapa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('estados-chapas.update', ['estados_chapa' => $estadoChapa->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Nome" value="{{ $estadoChapa->descricao }}">
                            @error('descricao')
                            <span class="error text-danger">{{ $errors->first('descricao') }}</span>
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
