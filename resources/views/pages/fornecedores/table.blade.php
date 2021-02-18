@if(!count($fornecedores))
    <div class="alert alert-danger mt-3">Nenhum fornecedor cadastrado...</div>
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
        @foreach($fornecedores as $f)
            <tr>
                <td>
                    {{ $f->nome }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($f->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('fornecedores', 'A'))
                        <a class="btn btn-success" href="{{ route('fornecedores.edit', ['fornecedore' => $f]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar fornecedor') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('fornecedores', 'E'))
                        <form action="{{ route('fornecedores.destroy', ['fornecedore' => $f]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Deseja excluir este fornecedor?')">
                                <i class="material-icons">delete</i>
                                    {{ __('Excluir fornecedor') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
