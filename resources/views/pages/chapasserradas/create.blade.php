@extends('pages.chapasserradas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar chapa serrada</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('chapas-serradas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-3 form-group">
                            <input type="text" autofocus class="form-control @error('numeracao') is-invalid @enderror" name="numeracao" placeholder="Numeração do bloco" value="{{ old('numeracao') }}">
                            @error('numeracao')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <select name="tipos_blocos_id" class="select2 w-100" data-placeholder="Selecione o material do bloco">
                                <option value="">Selecione o material do bloco</option>
                                @foreach($tiposBlocos as $t)
                                    <option value="{{ $t->id }}" @if(old('tipos_blocos_id') == $t->id) selected @endif>{{ $t->descricao }}</option>
                                @endforeach
                            </select>
                            @error('tipos_blocos_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <select name="observacoes_id[]" class="select2 w-100" multiple="true" data-placeholder="Selecione a qualidade da serrada">
                                @foreach($observacoes as $o)
                                    <option value="{{ $o->id }}" @if(in_array($o->id, old('observacoes_id') ?? [])) selected @endif>{{ $o->descricao }}</option>
                                @endforeach
                            </select>
                            @error('observacoes_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <textarea class="form-control @error('observacoes') is-invalid @enderror" name="observacoes" rows="2" placeholder="Observações">{{ old('observacoes') }}</textarea>
                        </div>
                        <div class="col-3 form-group">
                            <button type="submit" class="btn btn-warning"> Cadastrar chapas</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
