@if(!count($observacoesChapas))
    <div class="alert alert-danger mt-3">Nenhuma qualidade de serrada cadastrada...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Descrição
            </th>
            <th>
                Apelido
            </th>
            <th class="text-right" width="200">
                Presente em (Chapas)
            </th>
            <th class="text-center">
                Cadastrado em
            </th>
            <th class="text-right" width="200">
                &nbsp;&nbsp;
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($observacoesChapas as $o)
            <tr>
                <td>
                    {{ $o->descricao }}
                </td>
                <td>
                    {{ $o->apelido }}
                </td>
                <td class="text-right">
                    {{ $o->chapas()->count() }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($o->created_at)) }}
                </td>
                <td class="td-actions text-right" width="360">
                    @if(auth()->user()->temAcessoUnico('observacoes_chapas', 'A'))
                        <a class="btn btn-success" href="{{ route('observacoes-chapas.edit', ['observacoes_chapa' => $o->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar qualidade da serrada') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('observacoes_chapas', 'E'))
                        <form action="{{ route('observacoes-chapas.destroy', ['observacoes_chapa' => $o->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('{{ __('Deseja excluir esta qualidade da serrada?') }}')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir qualidade da serrada') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
