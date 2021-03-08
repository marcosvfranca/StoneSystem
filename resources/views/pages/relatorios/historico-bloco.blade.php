@extends('pages.relatorios.padrao', ['activePage' => 'relatorio_historio_bloco', 'titlePage' => "Histórico do bloco: $numeracao", 'class_container' => 'container'])
@section('relatorio')
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    @if(!$bloco)
        <div class="container">
            <div class="alert alert-danger mt-3">Bloco com numeração de pedreira {{ $numeracao }} não encontrado...
            </div>
        </div>
    @else
        <div style="border: 0;border-radius: 5px;padding: 5px;">
            <table class="table" border="2">
                <tr>
                    <td>
                        <b>Número de pedreira:</b> {{ $bloco->numeracao_pedreira }}
                    </td>
                    <td>
                        <b>Nosso número:</b> {{ $bloco->nosso_numero }}
                    </td>
                    <td colspan="2">
                        <b>Origem:</b> {{ $bloco->getOrigemFormated() }}
                    </td>
                </tr>
                <tr>
                    <td><b>Comprimento bruto: </b>{{ $bloco->getFormatedValue('comprimento_bruto') }}</td>
                    <td><b>Altura bruta: </b>{{ $bloco->getFormatedValue('altura_bruta') }}</td>
                    <td><b>Largura bruta: </b>{{ $bloco->getFormatedValue('largura_bruta') }}</td>
                    <td><b>Cubagem: </b>{{ $bloco->getCubagemBruta(true) }}</td>
                </tr>
                <tr>
                    <td><b>Comprimento líquido: </b>{{ $bloco->getFormatedValue('comprimento_liquido') }}</td>
                    <td><b>Altura líquida: </b>{{ $bloco->getFormatedValue('altura_liquida') }}</td>
                    <td><b>Largura líquida: </b>{{ $bloco->getFormatedValue('largura_liquida') }}</td>
                    <td><b>Cubagem: </b>{{ $bloco->getCubagemLiquida(true) }}</td>
                </tr>
                <tr>
                    <td><b>NF de Chegada: </b>{{ $bloco->nf_chegada }}</td>
                    <td><b>Data NF de Chegada: </b>{{ $bloco->getFormatedDate('dt_nf_chegada') }}</td>
                    <td><b>NF de compra: </b>{{ $bloco->nf_compra }}</td>
                    <td><b>Data NF de compra: </b>{{ $bloco->getFormatedDate('dt_nf_compra') }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Transportador: </b>{{ $bloco->transportadores()->first()->nome }}</td>
                    <td colspan="2"><b>Material do bloco: </b>{{ $bloco->tiposBlocos()->first()->descricao }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Classificação do bloco: </b>{{ $bloco->classificacoes()->first()->descricao }}
                    </td>
                    <td colspan="2"><b>Fornecedor do bloco: </b>{{ $bloco->fornecedores()->first()->nome }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right"><b>Bloco cadastrado
                            em:</b>{{ $bloco->getCreatedAtFormated() }}</td>
                </tr>
            </table>
        </div>
    @endif
    @if(!$chapa_serrada)
        <div class="container">
            <div class="alert alert-danger mt-3">Chapa serrada para o bloco {{ $numeracao }} não encontrada...</div>
        </div>
    @else
        <h4>Histórico chapa serrada:</h4>
        <div style="border: 0;border-radius: 5px;padding: 5px;">
            <table class="table" border="2">
                <tr>
                    <td>
                        <b>Quantidade de chapas:</b> {{ $chapa_serrada->chapas()->count() }}
                    </td>
                    <td>
                        <b>Total
                            m²:</b> {{ number_format($chapa_serrada->chapas()->sum(\Illuminate\Support\Facades\DB::raw('comprimento * altura')), 2, ',', '.') }}
                    </td>
                    <td><b>Material: </b>{{ $chapa_serrada->tiposBlocos()->first()->descricao }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Qualidade da serrada: </b>
                        @foreach($chapa_serrada->observacoes()->get() as $o)
                            {{ $o->observacao()->first()->descricao . " | " }}
                        @endforeach
                    </td>
                    <td style="text-align: right;"><b>Cadastrado em: </b>{{ $chapa_serrada->getCreatedAtFormated() }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Observações: </b>{{ $chapa_serrada->observacoes ?? "N/A" }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table class="table">
                            <tr>
                                <th>Numeração</th>
                                <th>Espessura</th>
                                <th>Comprimento</th>
                                <th>Altura</th>
                                <th>M²</th>
                            </tr>
                            @foreach($chapa_serrada->chapas()->orderByRaw('CAST(numeracao as SIGNED INTEGER)')->get() as $chapa)
                                <tr>
                                    <td>{{ $chapa->numeracao }}</td>
                                    <td>{{ $chapa->espessura()->first()->descricao }}</td>
                                    <td>{{ $chapa->getFormatedValue('comprimento') }}</td>
                                    <td>{{ $chapa->getFormatedValue('altura') }}</td>
                                    <td>{{ number_format($chapa->comprimento * $chapa->altura, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    @endif
    @if(!$chapa_bruta)
        <div class="container">
            <div class="alert alert-danger mt-3">Chapa bruta (gatti) para o bloco {{ $numeracao }} não encontrada...
            </div>
        </div>
    @else
        <h4>Histórico chapa bruta:</h4>
        <div>
            <table class="table" border="2">
                <tr>
                    <td>
                        <b>Quantidade de chapas:</b> {{ $chapa_bruta->chapas()->count() }}
                    </td>
                    <td>
                        <b>Total
                            m²:</b> {{ number_format($chapa_bruta->chapas()->sum(\Illuminate\Support\Facades\DB::raw('comprimento * largura')), 2, ',', '.') }}
                    </td>
                    <td style="text-align: right;">
                        <b>Cadastrado em: </b>{{ $chapa_bruta->getCreatedAtFormated() }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Transportador: </b> {{ $chapa_bruta->transportadores()->first()->nome }}
                        - {{ $chapa_bruta->transportadores()->first()->placa }}
                    </td>
                    <td colspan="1">
                        <b>Material: </b> {{ $chapa_bruta->tiposBlocos()->first()->descricao }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table class="table">
                            <tr>
                                <th>Numeração</th>
                                <th>Espessura</th>
                                <th>Comprimento</th>
                                <th>Altura</th>
                                <th>M²</th>
                            </tr>
                            @foreach($chapa_bruta->chapas()->orderByRaw('CAST(numeracao as SIGNED INTEGER)')->get() as $chapa)
                                <tr>
                                    <td>{{ $chapa->numeracao }}</td>
                                    <td>{{ $chapa->espessura()->first()->descricao }}</td>
                                    <td>{{ $chapa->getFormatedValue('comprimento') }}</td>
                                    <td>{{ $chapa->getFormatedValue('largura') }}</td>
                                    <td>{{ number_format($chapa->comprimento * $chapa->largura, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    @endif
    <div class="row mt-2 mb-2 ocultarNaImpressao">
        <div class="col-1">
            <button type="button" onclick="imprimir(true)" class="btn btn-block btn-primary">Imprimir</button>
        </div>
    </div>
@endsection
