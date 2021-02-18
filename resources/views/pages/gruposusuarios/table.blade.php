@if(!count($gruposusuarios))
    <span>Nenhum setor cadastrado...</span>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Nome
            </th>
            <th class="text-center">
                Administrador?
            </th>
            <th class="text-right">
                Quantidade de funcionários
            </th>
            <th>
                Tela inicial
            </th>
            <th class="text-right">
                &nbsp;&nbsp;
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($gruposusuarios as $g)
            <tr>
                <td>
                    {{ $g->nome }}
                </td>
                <td class="text-center">
                    {{ $g->admin == 'S' ? 'Sim' : 'Não' }}
                </td>
                <td class="text-right">
                    {{ $g->usuarios()->count() }}
                </td>
                <td>
                    {{ $g->getTelaInicial()->first()->nome ?? 'Padrão' }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('gruposusuarios', 'A'))
                        <a class="btn btn-success" href="{{ route('gruposusuarios.editar', ['id' => $g->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Gerênciar setor') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('gruposusuarios', 'E'))
                        <a class="btn btn-danger" href="{{ route('gruposusuarios.deletar', ['id' => $g->id]) }}"
                           onclick="return confirm('Confirma a exclusão deste setor?');">
                            <i class="material-icons">delete</i>
                            <div class="ripple-container"></div>
                            {{ __('Excluir setor') }}
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
