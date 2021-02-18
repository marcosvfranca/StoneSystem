@extends('pages.relatorios.padrao', ['activePage' => 'relatorio_agendamentos', 'titlePage' => 'Agendamentos'])
@section('relatorio')
    <style>
        .text-right {
            text-align: right;
        }
    </style>
    <div class="card mt-2">
        <h4 class="card-header">Filtragem:</h4>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-4">
                        <label>Material do bloco</label>
                        <select class="form-control select2" name="tipos_blocos[]" multiple data-placeholder="Material do bloco">
                            <option value="">Todos...</option>
                            @foreach($tipos_blocos as $t)
                                <option value="{{ $t->id }}"
                                        @if(in_array($t->id, request()->get('tipos_blocos') ?? [])) selected @endif>{{ $t->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Setor</label>
                        <select class="form-control select2" name="grupos_usuarios_id[]" multiple data-placeholder="Setor">
                            <option value="">Todos...</option>
                            @foreach($grupos_usuarios as $g)
                                <option value="{{ $g->id }}"
                                        @if(in_array($g->id, request()->get('grupos_usuarios_id') ?? [])) selected @endif>{{ $g->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Processo</label>
                        <select class="form-control select2" name="processo_id[]" multiple data-placeholder="Processo">
                            <option value="">Todos...</option>
                            @foreach($processos as $p)
                                <option value="{{ $p->id }}"
                                    @if(in_array($p->id, request()->get('processo_id') ?? [])) selected @endif>{{ $p->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Data inicial</label>
                        <input type="date" class="form-control" name="dtinicial"
                               value="{{ request()->get('dtinicial') ?? $dtinicial ?? null }}">
                    </div>
                    <div class="col-3">
                        <label>Data final</label>
                        <input type="date" class="form-control" name="dtfinal"
                               value="{{ request()->get('dtfinal') ?? $dtfinal ?? null }}">
                    </div>
                </div>
                <div class="row mt-2 ocultarNaImpressao">
                    <div class="col-2">
                        <button type="submit" class="btn btn-block btn-warning">Aplicar filtros</button>
                    </div>
                    <div class="col-1">
                        <button type="button" onclick="imprimir()" class="btn btn-block btn-primary">Imprimir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(!count($agendamentos))
        <div class="container">
            <div class="alert alert-danger mt-3">Nenhum agendamento encontrado...</div>
        </div>
    @else
        <div style="border: 0;border-radius: 5px;padding: 5px;">
            <table class="table" border="1">
                <thead class=" text-warning">
                <tr>
                    <th width="50" class="text-right">
                        Cód. Agendamento
                    </th>
                    <th width="100" class="text-right">
                        Num Bloco
                    </th>
                    <th>
                        Processo
                    </th>
                    <th>
                        Material Bloco
                    </th>
                    <th>
                        Setor
                    </th>
                    <th>
                        Observações
                    </th>
                    <th width="50" class="text-right">
                        Total Chapas
                    </th>
                    <th width="50" class="text-right">
                        Total Concluído
                    </th>
                    <th width="50" class="text-right">
                        Total Cancelado
                    </th>
                    <th width="50" class="text-right">
                        Total não Concluído
                    </th>
                    <th class="text-center">
                        Cadastrado em
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($agendamentos as $a)
                    <tr>
                        <td class="text-right">
                            {{ $a->id }}
                        </td>
                        <td class="text-right">
                            <a href="{{ route('relatorios.historico', ['numeracao' => $a->numeracao]) }}" target="_blank">{{ $a->numeracao }}</a>
                        </td>
                        <td>
                            {{ $a->nome  }}
                        </td>
                        <td>
                            {{ $a->material }}
                        </td>
                        <td>
                            {{ $a->setor }}
                        </td>
                        <td>
                            {{ $a->observacoes }}
                        </td>
                        <td class="text-right">
                            {{ $a->chapas }}
                        </td>
                        <td class="text-right">
                            {{ $a->concluido }}
                        </td>
                        <td class="text-right">
                            {{ $a->cancelado }}
                        </td>
                        <td class="text-right">
                            {{ $a->nconcluido }}
                        </td>
                        <td class="text-center">
                            {{ date('d/m/Y', strtotime($a->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
