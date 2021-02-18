@extends('pages.motivos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Alterar motivo de operação de processo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('motivos.update', ['motivo' => $motivo->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 form-group">
                            <input autofocus class="form-control @error('motivo') is-invalid @enderror" name="motivo" placeholder="Motivo" value="{{ $motivo->motivo }}">
                            @error('motivo')
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
