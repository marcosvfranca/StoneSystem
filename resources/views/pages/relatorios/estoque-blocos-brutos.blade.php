@extends('pages.relatorios.padrao', ['activePage' => 'relatorio_estoque_blocos_bruto', 'titlePage' => 'Estoque de blocos'])
@section('relatorio')
    <div class="card mt-2">
        <h4 class="card-header">Filtragem:</h4>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-3">
                        <label>Numeração do bloco</label>
                        <input class="form-control" placeholder="Numeração do bloco" name="numeracao"
                               value="{{ request()->get('numeracao') ?? null }}">
                    </div>
                    <div class="col-3">
                        <label>Material do bloco</label>
                        <select class="form-control select2" name="tipos_blocos[]" multiple data-placeholder="Material do bloco">
                            <option value="">Todos...</option>
                            @foreach($tipos_blocos as $t)
                                <option value="{{ $t->id }}"
                                        @if(in_array($t->id, request()->get('tipos_blocos') ?? [])) selected @endif>{{ $t->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Fornecedor</label>
                        <select class="form-control select2" name="fornecedores_id[]" multiple data-placeholder="Fornecedor">
                            <option value="">Todos...</option>
                            @foreach($fornecedores as $f)
                                <option value="{{ $f->id }}"
                                        @if(in_array($f->id, request()->get('fornecedores_id') ?? [])) selected @endif>{{ $f->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Classificação</label>
                        <select class="form-control select2" name="classificacoes_blocos_id[]" multiple data-placeholder="Classificação">
                            <option value="">Todos...</option>
                            @foreach($classificacoes_blocos as $c)
                                <option value="{{ $c->id }}"
                                        @if(in_array($c->id, request()->get('classificacoes_blocos_id') ?? [])) selected @endif>{{ $c->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Transportador</label>
                        <select class="form-control select2" name="transportadores_id[]" multiple data-placeholder="Transportador">
                            <option value="">Todos...</option>
                            @foreach($transportadores as $t)
                                <option value="{{ $t->id }}"
                                        @if(in_array($t->id, request()->get('transportadores_id') ?? [])) selected @endif>{{ $t->nome . ' - ' . $t->placa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Data inicial</label>
                        <input type="date" class="form-control" name="dtinicial"
                               value="{{ request()->get('dtinicial') ?? null }}">
                    </div>
                    <div class="col-3">
                        <label>Data final</label>
                        <input type="date" class="form-control" name="dtfinal"
                               value="{{ request()->get('dtfinal') ?? null }}">
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
    @if(!count($blocos_brutos))
        <div class="container">
            <div class="alert alert-danger mt-3">Nenhum bloco encontrado...</div>
        </div>
    @else
        <div style="border: 0;border-radius: 5px;padding: 5px;">
            <table class="table" border="1">
                <thead class=" text-warning">
                <tr>
                    <th>
                        Numero de pedreira
                    </th>
                    <th class="text-right">
                        Comprimento bruto
                    </th>
                    <th class="text-right">
                        Altura bruta
                    </th>
                    <th class="text-right">
                        Largura bruta
                    </th>
                    <th class="text-right">
                        M³
                    </th>
                    <th>
                        Material do bloco
                    </th>
                    <th>
                        Fornecedor
                    </th>
                    <th>
                        Classificação
                    </th>
                    <th>
                        Transportador
                    </th>
                    <th class="text-center">
                        Cadastrado em
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $m3 = 0;
                @endphp
                @foreach($blocos_brutos as $b)
                    <tr>
                    @php
                    $m3Aux = $b->comprimento_bruto * $b->altura_bruta * $b->largura_bruta;
                    $m3 += $m3Aux;
                    @endphp
                        <td>
                            <a href="{{ route('relatorios.historico', ['numeracao' => $b->numeracao_pedreira]) }}" target="_blank">{{ $b->numeracao_pedreira }}</a>
{{--                            {{ $b->numeracao_pedreira }}--}}
                        </td>
                        <td class="text-right">
                            {{ number_format($b->comprimento_bruto, 2, ',', '.') }}
                        </td>
                        <td class="text-right">
                            {{ number_format($b->altura_bruta, 2, ',', '.') }}
                        </td>
                        <td class="text-right">
                            {{ number_format($b->largura_bruta, 2, ',', '.') }}
                        </td>
                        <td class="text-right">
                            {{ number_format($m3Aux, 2, ',', '.') }}
                        </td>
                        <td>
                            {{ $b->tiposBlocos()->first()->descricao }}
                        </td>
                        <td>
                            {{ $b->fornecedores()->first()->nome }}
                        </td>
                        <td>
                            {{ $b->classificacoes()->first()->descricao }}
                        </td>
                        <td>
                            {{ $b->transportadores()->first()->nome }}
                        </td>
                        <td class="text-center">
                            {{ date('d/m/Y', strtotime($b->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-3">
                    <b>Quantidade total de blocos: {{ count($blocos_brutos) }}</b>
                </div>
                <div class="col-3">
                    <b>Total m³: {{ number_format($m3, 2, ',', '.') }}</b>
                </div>
            </div>
        </div>
    @endif
@endsection
