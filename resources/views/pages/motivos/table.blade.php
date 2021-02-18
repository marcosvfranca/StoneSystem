@if(!count($motivos))
    <span>Nenhum  motivo operação de processo cadastrado...</span>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Motivo
            </th>
            <th class="text-right" width="200">
                Presente em (Processos)
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
        @foreach($motivos as $m)
            <tr>
                <td>
                    {{ $m->motivo }}
                </td>
                <td class="text-right">
                    corrigir
                    {{--                                    {{ $m->processos()->count() }}--}}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($m->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('motivos', 'A'))
                        <a class="btn btn-success" href="{{ route('motivos.edit', ['motivo' => $m->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar motivo') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('motivos', 'E'))
                        <form action="{{ route('motivos.destroy', ['motivo' => $m->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Deseja excluir esse motivo de cancelamento de processo?')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir motivo') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
