@if(!count($chapasSerradas))
    <div class="alert alert-danger mt-3">Nada encontrado...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Numeração do bloco
            </th>
            <th>
                Quantidade de chapas
            </th>
            <th>
                Material do bloco
            </th>
            <th>
                Qualidade da serrada
            </th>
            <th>Observações</th>
            <th class="text-right">
                Cadastrado em
            </th>
            <th class="text-right">
                &nbsp;&nbsp;
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($chapasSerradas as $c)
            <tr>
                <td>
                    {{ $c->numeracao }}
                </td>
                <td>
                    {{ $c->chapas()->count() }}
                </td>
                <td>
                    {{ $c->tiposBlocos()->first()->descricao }}
                </td>
                <td>
                    <ul>
                        @foreach($c->observacoes()->get() as $o)
                            <li>
                            {{ $o->observacao()->first()->descricao }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $c->observacoes }}</td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($c->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('chapas_serradas', 'A'))
                        <a class="btn btn-success" href="{{ route('chapas-serradas.edit', ['chapas_serrada' => $c]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar chapa serrada') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('chapas_serradas', 'E'))
                        <form action="{{ route('chapas-serradas.destroy', ['chapas_serrada' => $c]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Deseja excluir esta chapa serrada?')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir chapa serrada') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
