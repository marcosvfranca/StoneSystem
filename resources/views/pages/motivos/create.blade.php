@extends('pages.motivos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Cadastrar motivo de operação de processo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('motivos.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('motivo') is-invalid @enderror" name="motivo" placeholder="Motivo" value="{{ old('motivo') }}">
                            @error('motivo')
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
