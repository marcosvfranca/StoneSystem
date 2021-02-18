@if(count($acessos) == 0)
    <div class="alert alert-danger">Nenhum acesso concedido...</div>
@else
    <table class="table tableSearchAcessosGruposUsuarios">
        <thead class=" text-warning">
        <tr>
            <th>
                Acesso
            </th>
            <th class="text-center">
                Inserir
            </th>
            <th class="text-center">
                Alterar
            </th>
            <th class="text-center">
                Excluir
            </th>
            <th class="text-right">
                &nbsp;&nbsp;
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($acessos as $a)
            <tr>
                <td>
                    {{ $a->nome }}
                </td>
                <td class="text-center">
                    @if($a->unico != 'S')
                        <input class="form-check-input" type="checkbox" disabled
                               @if($a->inserir == 'S') checked @endif>
                        Inserir
                    @endif
                </td>
                <td class="text-center">
                    @if($a->unico != 'S')
                        <input class="form-check-input" type="checkbox" disabled
                               @if($a->alterar == 'S') checked @endif>
                        Alterar
                    @endif
                </td>
                <td class="text-center">
                    @if($a->unico != 'S')
                        <input class="form-check-input" type="checkbox" disabled
                               @if($a->excluir == 'S') checked @endif>
                        Excluir
                    @endif
                </td>
                <td class="td-actions text-right">
                    <button class="btn btn-danger removeAcesso"
                            data-id="{{ $a->id }}"
                            data-csfr="{{ csrf_token() }}">
                        <i class="material-icons">close</i> Remover acesso
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
