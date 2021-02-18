@extends('pages.fornecedores.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Alterar fornecedor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('fornecedores.update', ['fornecedore' => $fornecedor]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="Nome" value="{{ $fornecedor->nome }}">
                            @error('nome')
                            <span class="error text-danger">{{ $message }}</span>
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
