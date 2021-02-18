@if(!count($processos))
    <div class="alert alert-danger mt-3">Nenhum processo cadastrado...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Processo
            </th>
            <th class="text-right" width="50">
                Exige material
            </th>
            <th class="text-right" width="50">
                Ultimo processo
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
        @foreach($processos as $p)
            <tr>
                <td>
                    {{ $p->nome }}
                </td>
                <td class="text-right">
                    {{ $p->exige_material == 'S' ? 'Sim' : 'Não' }}
                </td>
                <td class="text-right">
                    {{ $p->ultimo_processo == 'S' ? 'Sim' : 'Não' }}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($p->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('processos', 'A'))
                        <a class="btn btn-success" href="{{ route('processos.edit', ['processo' => $p->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar processo') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('processos', 'E'))
                        <form action="{{ route('processos.destroy', ['processo' => $p->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja excluir este processo?')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir processo') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
