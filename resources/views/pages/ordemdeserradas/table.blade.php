@if(!count($ordem_de_serradas))
    <div class="alert alert-danger mt-3">Nenhuma ordem de serrada encontrada...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Numeração de pedreira
            </th>
            <th>
                Material
            </th>
            <th>
                Espessura
            </th>
            <th>
                Observações
            </th>
            <th>
                Concluída?
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
        @foreach($ordem_de_serradas as $o)
            <tr>
                <td>
                    {{ $o->blocoBruto()->first()->numeracao_pedreira }}
                </td>
                <td>
                    {{ $o->blocoBruto()->first()->tiposBlocos()->first()->descricao }}
                </td>
                <td>
                    {{ $o->espessura()->first()->descricao }}
                </td>
                @php
                echo "<td>" . nl2br($o->observacoes) . "</td>"
                @endphp
                <td class="text-center">
                    {{ $o->chapas_serradas_id ? __("Sim") : __("Não") }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($o->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('ordem_de_serradas', 'A'))
                        <a class="btn btn-success" href="{{ route('ordem-de-serradas.edit', ['ordem_de_serrada' => $o]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar ordem de serrada') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('ordem_de_serradas', 'E'))
                        <form action="{{ route('ordem-de-serradas.destroy', ['ordem_de_serrada' => $o]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Deseja excluir esta ordem de serrada?')">
                                <i class="material-icons">delete</i>
                                    {{ __('Excluir ordem de serrada') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
