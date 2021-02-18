@if(!count($tiposblocos))
    <div class="alert alert-danger mt-3">Nada encontrado...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Nome
            </th>
            <th class="text-right">
                Quantidade de variações
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
        @foreach($tiposblocos as $t)
            <tr>
                <td>
                    {{ $t->descricao }}
                </td>
                <td class="text-right">
                    {{ $t->itensTiposBlocos()->count() }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($t->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('tipos-blocos', 'A'))
                        <a class="btn btn-success" href="{{ route('tiposblocos.editar', ['id' => $t->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar material de bloco') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('tipos-blocos', 'E'))
                        <a class="btn btn-danger" href="{{ route('tiposblocos.deletar', ['id' => $t->id]) }}"
                           onclick="return confirm('{{ __('Deseja realmente excluir este material de bloco') }}')">
                            <i class="material-icons">delete</i>
                            <div class="ripple-container"></div>
                            {{ __('Excluir material de bloco') }}
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
