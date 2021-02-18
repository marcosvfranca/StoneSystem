@extends('pages.tipomaterialprocessos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar material de processo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tipo-material-processos.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('tipo') is-invalid @enderror" name="tipo" placeholder="tipo" value="{{ old('tipo') }}" autofocus>
                            @error('tipo')
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
