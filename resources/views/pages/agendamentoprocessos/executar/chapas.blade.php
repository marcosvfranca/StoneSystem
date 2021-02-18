@if(!$agendamento->chapas()->whereNull('concluido')->where('cancelado', 'N')->count())
<div class="alert alert-success">
    <h4 class="font-weight-bold text-uppercase">{{ $agendamento->processo()->first()->nome }} concluido. Clique no botão abaixo para finalizar.</h4>
    <a href="{{ route('executar-processos.index') }}" class="btn btn-warning text-uppercase">finalizar {{ $agendamento->processo()->first()->nome }}</a>
</div>
@endif
<div class="table-responsive">
    <table class="table" border="1">
        <thead>
        <tr>
            <th width="10"><input type="checkbox" class="selectAll"></th>
            <th class="font-weight-bold">Numeração</th>
            <th class="font-weight-bold">Espessura</th>
            <th class="font-weight-bold">Comprimento</th>
            <th class="font-weight-bold">Largura</th>
            <th class="font-weight-bold text-danger">Materiais</th>
        </tr>
        </thead>
        <tbody>
        @foreach($agendamento->chapas()->orderBy('id')->get() as $c)
            <tr class="@if($c->concluido == 'S') font-weight-bold bg-success @endif
            @if($c->cancelado == 'S') font-weight-bold bg-danger @endif
            @if($c->concluido == 'N') font-weight-bold bg-warning @endif
                ">
                <th><input type="checkbox" class="checkChapas" data-id="{{ $c->id }}"
                           @if(in_array($c->concluido == 'S', ['S', 'N']) or $c->motivo_cancelamento_id or $c->motivo_nao_conclusao_processo_id) disabled @endif
                    ></th>
                <td class="font-weight-bold">{{ $c->chapa()->numeracao }}</td>
                <td>{{ $c->chapa()->espessura()->first()->descricao }}</td>
                <td>{{ $c->chapa()->comprimento }}</td>
                <td>{{ $c->chapa()->largura }}</td>
                <td>
                    <ol>
                        @foreach($c->tiposMateriais()->get() as $tipoMaterial)
                            <li>{{ $tipoMaterial->tipo }}</li>
                        @endforeach
                    </ol>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
