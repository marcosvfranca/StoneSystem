@extends('pages.tipomaterialprocessos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Alterar material de processo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tipo-material-processos.update', ['tipo_material_processo' => $tipoMaterialProcessos->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 form-group">
                            <input class="form-control @error('tipo') is-invalid @enderror" name="tipo" placeholder="Material" value="{{ $tipoMaterialProcessos->tipo }}" autofocus>
                            @error('tipo')
                            <span class="error text-danger">{{ $errors->first('tipo') }}</span>
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
