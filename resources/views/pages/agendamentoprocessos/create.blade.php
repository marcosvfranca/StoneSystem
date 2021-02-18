@extends('pages.agendamentoprocessos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Agendar processo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('agendamento-processos.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <select class="form-control select2 @error('processo_id') is-invalid @enderror" name="processo_id">
                                <option value="">Selecione o processo...</option>
                                @foreach($processos as $p)
                                    <option value="{{ $p->id }}" @if($p->id == old('processo_id')) selected @endif>{{ $p->nome }}</option>
                                @endforeach
                            </select>
                            @error('processo_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <select class="form-control select2 @error('grupos_usuario_id') is-invalid @enderror" name="grupos_usuario_id">
                                <option value="">Selecione o setor...</option>
                                @foreach($gruposUsuarios as $g)
                                    <option value="{{ $g->id }}" @if($g->id == old('grupos_usuario_id')) selected @endif>{{ $g->nome }}</option>
                                @endforeach
                            </select>
                            @error('grupos_usuario_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <textarea name="observacoes" placeholder="Observações" class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group text-center">
                            <button type="submit" class="btn btn-warning"> Selecionar chapas/blocos</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
