@if(count($blocos))
<div class="table-responsive">
    <table class="table">
        <tbody>
        @foreach($blocos as $bloco)
            <tr class="bg-light">
                <th>
                    <input type="checkbox" class="checkbox checkboxBloco" data-id="{{ $bloco->id }}">
                </th>
                <th>
                    Bloco nº: {{ $bloco->numeracao }}
                </th>
                <th>
                    Categoria: {{ $bloco->tiposBlocos()->first()->descricao }}
                </th>
                <th>
                    Transportador: {{ $bloco->transportadores()->first()->nome }} - {{ $bloco->transportadores()->first()->placa }}
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            @foreach($bloco->chapas()->orderByRaw('CAST(numeracao as SIGNED INTEGER)')->get() as $chapa)
                <tr @if($chapa->espessura()->first()->cor or $chapa->espessura()->first()->cor_fonte) style="background-color: {{ $chapa->espessura()->first()->cor }};color: {{ $chapa->espessura()->first()->cor_fonte }};"
                    @endif>
                    <td>
                        <input type="checkbox" class="checkbox checkboxChapa" data-chapa-id="{{ $chapa->id }}" data-bloco-id="{{ $bloco->id }}">
                    </td>
                    <td>
                        Chapa nº: {{ $chapa->numeracao }}
                    </td>
                    <td>
                        Espessura: {{ $chapa->espessura()->first()->descricao }}
                    </td>
                    <td>
                        Comprimento: {{ number_format($chapa->comprimento, 2, ',', '.') }}
                    </td>
                    <td>
                        Altura: {{ number_format($chapa->largura, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
@else
    <div class="alert alert-danger">
        Nada encontrado...
    </div>
@endif
