@extends('pages.processos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Alterar processo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('processos.update', ['processo' => $processo->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 form-group">
                            <input class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="Nome do processo" value="{{ $processo->nome }}" autofocus>
                            @error('nome')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <select name="exige_material" class="select2 w-100">
                                <option value="S" @if($processo->exige_material == 'S') selected @endif>{{ __('Obrigar selecionar material') }}</option>
                                <option value="N" @if($processo->exige_material == 'N') selected @endif>{{ __('Não obrigar selecionar material') }}</option>
                            </select>
                            @error('exige_material')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <select name="ultimo_processo" class="select2 w-100">
                                <option value="N" @if($processo->ultimo_processo == 'N') selected @endif>{{ __('Processo normal') }}</option>
                                <option value="S" @if($processo->ultimo_processo == 'S') selected @endif>{{ __('Último processo') }}</option>
                            </select>
                            @error('exige_material')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <select id="tipo_material_processos" name="tipo_material_processos[]" class="select2 w-100" multiple>
                                @foreach($tipoMaterialProcessos as $t)
                                    <option value="{{ $t->id }}" @if($processo->tipoMaterialProcessos()->where('tipo_material_processos_id', $t->id)->count()) selected @endif > {{ $t->tipo }}</option>
                                @endforeach
                            </select>
                            @error('tipo_material_processos')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <select id="selecionar_materiais" name="selecionar_materiais" class="select2 w-100">
                                <option value="S" @if($processo->selecionar_materiais == 'S') selected @endif>{{ __('Pré selecionar materiais no agendamento') }}</option>
                                <option value="N" @if($processo->selecionar_materiais == 'N') selected @endif>{{ __('Não pré selecionar materiais no agendamento') }}</option>
                            </select>
                            @error('selecionar_materiais')
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
@include('pages.processos.js')
@endsection