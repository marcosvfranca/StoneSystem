@extends('pages.espessuraschapas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar espessura de chapa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('espessuras-chapas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Nome" value="{{ old('descricao') }}">
                            @error('descricao')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <label>Cor:</label>
                            <input class="form-control @error('cor') is-invalid @enderror" name="cor" placeholder="Cor" value="{{ old('cor') }}" type="color">
                            @error('cor')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <label>Cor do texto:</label>
                            <input class="form-control @error('cor_fonte') is-invalid @enderror" name="cor_fonte" placeholder="Cor do texto" value="{{ old('cor_fonte') }}" type="color">
                            @error('cor_fonte')
                            <span class="error text-danger">{{ $message }}</span>
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
