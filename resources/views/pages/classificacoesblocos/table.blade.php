@if(!count($classificacoes))
    <div class="alert alert-danger mt-3">Nenhuma classificação de bloco cadastrada...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Nome
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
        @foreach($classificacoes as $c)
            <tr>
                <td>
                    {{ $c->descricao }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($c->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('classificacoes_blocos', 'A'))
                        <a class="btn btn-success" href="{{ route('classificacoes-blocos.edit', ['classificacoes_bloco' => $c]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar classificação') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('classificacoes_blocos', 'E'))
                        <form action="{{ route('classificacoes-blocos.destroy', ['classificacoes_bloco' => $c]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Deseja excluir esta classificação?')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir classificação') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
