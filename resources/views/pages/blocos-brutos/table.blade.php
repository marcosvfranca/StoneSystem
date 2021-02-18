@if(!count($blocos_brutos))
    <div class="alert alert-danger mt-3">Nenhum bloco cadastrado...</div>
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
            <th>
                Fornecedor
            </th>
            <th>
                Classificação
            </th>
            <th>
                Transportador
            </th>
            <th>
                Comprimento
            </th>
            <th>
                Altura
            </th>
            <th>
                Largura
            </th>
            <th>M³</th>
            <th class="text-center">
                Cadastrado em
            </th>
            <th class="text-right">
                &nbsp;&nbsp;
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($blocos_brutos as $b)
            <tr>
                <td>
                    {{ $b->numeracao }}
                </td>
                <td>
                    {{ $b->tiposBlocos()->first()->descricao }}
                </td>
                <td>
                    {{ $b->fornecedores()->first()->nome }}
                </td>
                <td>
                    {{ $b->classificacoes()->first()->descricao }}
                </td>
                <td>
                    {{ $b->transportadores()->first()->nome }}
                </td>
                <td>
                    {{ number_format($b->comprimento, 2, ',', '.') }}
                </td>
                <td>
                    {{ number_format($b->altura, 2, ',', '.') }}
                </td>
                <td>
                    {{ number_format($b->largura, 2, ',', '.') }}
                </td>
                <td>{{ number_format($b->comprimento * $b->altura * $b->largura, 2, ',', '.') }}</td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($b->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('blocos_brutos', 'A'))
                        <a class="btn btn-success" href="{{ route('blocos-brutos.edit', ['blocos_bruto' => $b]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar bloco') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('blocos_brutos', 'E'))
                        <form action="{{ route('blocos-brutos.destroy', ['blocos_bruto' => $b]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Deseja excluir este bloco?')">
                                <i class="material-icons">delete</i>
                                    {{ __('Excluir bloco') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
