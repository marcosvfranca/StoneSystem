@extends('pages.ordemdeserradas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Cadastrar ordem de serrada</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('ordem-de-serradas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <label>Selecione o bloco</label>
                            <select class="form-control select2 @error('blocos_brutos_id') is-invalid @enderror" name="blocos_brutos_id" data-placeholder="Selecione o bloco">
                                <option value="">Selecione o bloco</option>
                                @foreach($blocos_brutos as $b)
                                    <option value="{{ $b->id }}" @if($b->id == old('blocos_brutos_id')) selected @endif>{{ $b->numeracao }} - {{ $b->tiposBlocos()->first()->descricao }}</option>
                                @endforeach
                            </select>
                            @error('blocos_brutos_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <label>Selecione a espessura</label>
                            <select class="form-control select2 @error('espessuras_chapas_id') is-invalid @enderror" name="espessuras_chapas_id" data-placeholder="Selecione a espessura">
                                <option value="">Selecione a espessura</option>
                                @foreach($espessuras_chapas as $e)
                                    <option value="{{ $e->id }}" @if($e->id == old('espessuras_chapas_id')) selected @endif>{{ $e->descricao }}</option>
                                @endforeach
                            </select>
                            @error('espessuras_chapas_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <textarea class="form-control @error('observacoes') is-invalid @enderror" name="observacoes" placeholder="Observações">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
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
