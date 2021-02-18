<h4>Bloco nº: {{ $numeracao }}</h4>
<div class="table-responsive" style="width: 99% !important;">
    <table class="table" border="2">
        <thead class="text-warning">
        <tr>
            <th><input type="checkbox" class="form-check selectAllItensSerrada" checked></th>
            <th>Numeração</th>
            <th>Espessura</th>
            <th>Comprimento</th>
            <th>Altura</th>
        </tr>
        </thead>
        <tbody>
        @foreach($itens as $i)
        <tr @if(\App\EspessurasChapas::find($i->espessuras_chapas_id)->cor or \App\EspessurasChapas::find($i->espessuras_chapas_id)->cor_fonte) style="background-color: {{ \App\EspessurasChapas::find($i->espessuras_chapas_id)->cor }};color: {{ \App\EspessurasChapas::find($i->espessuras_chapas_id)->cor_fonte }};"
            @endif>
            <td><input type="checkbox" class="form-check checkItemSerrada" data-id="{{ $i->id }}" checked></td>
            <td>{{ $i->numeracao }}</td>
            <td>{{ \App\EspessurasChapas::find($i->espessuras_chapas_id)->descricao ?? '0' }}</td>
            <td>{{ number_format($i->comprimento, 2, ',', '.') }}</td>
            <td>{{ number_format($i->altura, 2, ',', '.') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
