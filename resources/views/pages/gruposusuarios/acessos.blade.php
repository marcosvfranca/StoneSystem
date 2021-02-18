@if(!count($acessos))
    <div class="alert alert-danger">Nenhum acesso disponível...</div>
@else
    <table class="table tableSearchAcessos">
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
                        <input type="checkbox" data-name="inserir" class="checkAcesso" data-value="{{ $a->id }}"
                               checked>
                        Inserir
                    @endif
                </td>
                <td class="text-center">
                    @if($a->unico != 'S')
                        <input type="checkbox" data-name="alterar" class="checkAcesso" data-value="{{ $a->id }}"
                               checked>
                        Alterar
                    @endif
                </td>
                <td class="text-center">
                    @if($a->unico != 'S')
                        <input type="checkbox" data-name="excluir" class="checkAcesso" data-value="{{ $a->id }}"
                               checked>
                        Excluir
                    @endif
                </td>
                <td class="td-actions text-right">
                    <button class="btn btn-success liberaAcesso" id="btnLiberaAcesso{{ $a->id }}"
                            data-inserir="S" data-alterar="S" data-excluir="S"
                            data-id-acesso="{{ $a->id }}" data-id-grupo="{{ $grupousuario_id }}"
                            data-csfr="{{ csrf_token() }}">
                        <i class="material-icons">done</i>
                        Liberar acesso
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
