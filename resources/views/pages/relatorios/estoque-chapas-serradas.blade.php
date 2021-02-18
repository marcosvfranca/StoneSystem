@extends('pages.relatorios.padrao', ['activePage' => 'relatorio_estoque_chapas_serradas', 'titlePage' => 'Estoque de chapas serradas'])
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
                            @foreach($tipos_blocos as $t)
                                <option value="{{ $t->id }}"
                                        @if(in_array($t->id, request()->get('tipos_blocos') ?? [])) selected @endif>{{ $t->descricao }}</option>
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
    @if(!count($chapas_serradas))
        <div class="container">
            <div class="alert alert-danger mt-3">Nenhuma chapa serrada encontrada...</div>
        </div>
    @else
        <div style="border: 0;border-radius: 5px;padding: 5px;">
            <table class="table" border="1">
                <thead class=" text-warning">
                <tr>
                    <th>
                        Numeração do bloco
                    </th>
                    <th>
                        Quantidade de chapas
                    </th>
                    <th>
                        M²
                    </th>
                    <th>
                        Material do bloco
                    </th>
                    <th>
                        Qualidade da serrada
                    </th>
                    <th class="text-center">
                        Cadastrado em
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $chapas = 0;
                    $m2 = 0;
                @endphp
                @foreach($chapas_serradas as $cs)
                    <tr>
                    @php
                    $chapasAux = $cs->chapas()->count();
                    $chapas += $chapasAux;
                    @endphp
                        <td>
                            <a href="{{ route('relatorios.historico', ['numeracao' => $cs->numeracao]) }}" target="_blank">{{ $cs->numeracao }}</a>
                        </td>
                        <td>
                            {{ $chapasAux }}
                        </td>
                        @php
                            $m2Aux = $cs->chapas()->sum(\Illuminate\Support\Facades\DB::raw('comprimento * altura'));
                            $m2 += $m2Aux;
                        @endphp
                        <td>
                            {{ number_format($m2Aux, 2, ',', '.') }}
                        </td>
                        <td>
                            {{ $cs->tiposBlocos()->first()->descricao }}
                        </td>
                        <td>
                            <ul>
                                @foreach($cs->observacoes()->get() as $o)
                                    <li>
                                        {{ $o->observacao()->first()->descricao }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            {{ date('d/m/Y', strtotime($cs->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-3">
                    <b>Quantidade total de blocos: {{ count($chapas_serradas) }}</b>
                </div>
                <div class="col-3">
                    <b>Quantidade total de chapas: {{ $chapas }}</b>
                </div>
                <div class="col-3">
                    <b>Total m²: {{ number_format($m2, 2, ',', '.') }}</b>
                </div>
            </div>
        </div>
    @endif
@endsection
