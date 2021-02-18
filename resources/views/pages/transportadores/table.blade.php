@if(!count($transportadores))
    <div class="alert alert-danger mt-3">Nada encontrado...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Nome
            </th>
            <th>
                Placa
            </th>
            <th width="180">
                Quantidade de Blocos
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
        @foreach($transportadores as $t)
            <tr>
                <td>
                    {{ $t->nome }}
                </td>
                <td div class="text-center">
                    {{ $t->placa }}
                </td>
                <td class="text-right">
                    {{ $t->blocos()->count() }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($t->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('transportadores', 'A'))
                        <a class="btn btn-success" href="{{ route('transportadores.editar', ['id' => $t->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar transportador') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('transportadores', 'E'))
                        <a class="btn btn-danger" href="{{ route('transportadores.deletar', ['id' => $t->id]) }}"
                           onclick="return confirm('{{ __('Deseja realmente excluir este transportador') }}')">
                            <i class="material-icons">delete</i>
                            <div class="ripple-container"></div>
                            {{ __('Excluir transportador') }}
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
