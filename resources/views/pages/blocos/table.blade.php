@if(!count($blocos))
    <span>Nenhuma chapa bruta cadastrada...</span>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Numeração
            </th>
            <th>
                Material
            </th>
            <th class="text-center">
                Transportador /
                <br>
                Placa
            </th>
            <th class="text-center">
                Quantidade de chapas
            </th>
            <th class="text-center">
                Cadastrado em
            </th>
            <th class="text-right">
                &nbsp;&nbsp;
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($blocos as $b)
            <tr>
                <td>
                    {{ $b->numeracao }}
                </td>
                <td>
                    {{ $b->tiposBlocos()->first()->descricao ?? 'Sem material de bloco'}}
                </td>
                <td class="text-center">
                {{ $b->transportadores()->first()->nome ?? 'Sem transportador'}}
                <br>
                {{ $b->transportadores()->first()->placa ?? 'Sem transportador'}}
                </td>
                <td class="text-center">
                    {{ $b->chapas()->count() }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($b->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('blocos', 'A'))
                        <a class="btn btn-success" href="{{ route('blocos.editar', ['id' => $b->id]) }}">
                            <i class="material-icons">equalizer</i>
                            <div class="ripple-container"></div>
                            {{ __('Gerenciar chapas') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('blocos', 'E'))
                        <a class="btn btn-danger" href="{{ route('blocos.deletar', ['id' => $b->id]) }}">
                            <i class="material-icons">delete</i>
                            <div class="ripple-container"></div>
                            {{ __('Excluir bloco') }}
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
