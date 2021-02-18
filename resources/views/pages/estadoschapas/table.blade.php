@if(!count($estadosChapas))
    <div class="alert alert-danger mt-3">Nada encontrado...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Estado
            </th>
            <th class="text-right" width="200">
                Presente em (Chapas)
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
        @foreach($estadosChapas as $e)
            <tr>
                <td>
                    {{ $e->descricao }}
                </td>
                <td class="text-right" width="200">
                    {{ $e->chapas()->count() }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($e->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('estados-chapas', 'A'))
                        <a class="btn btn-success" href="{{ route('estados-chapas.edit', ['estados_chapa' => $e->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar estado de chapa') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('estados-chapas', 'E'))
                        <form action="{{ route('estados-chapas.destroy', ['estados_chapa' => $e->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Deseja excluir esse estado de chapa?') }}')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir estado de chapa') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
