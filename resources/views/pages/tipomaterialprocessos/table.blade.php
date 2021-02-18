@if(!count($tipoMaterialProcessos))
    <span>Nenhuma material de processo cadastrado...</span>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Material
            </th>
            <th class="text-right" width="100">
                Presente em (Chapas)
            </th>
            <th class="text-right" width="100">
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
        @foreach($tipoMaterialProcessos as $t)
            <tr>
                <td>
                    {{ $t->tipo }}
                </td>
                <td class="text-right">
                    00000
                    {{--                                    {{ $t->chapaAgendamentoProcessos()->count() }}--}}
                </td>
                <td class="text-right">
                    corrigir
                    {{--                                    {{ $t->agendamentoProcessos()->count() }}--}}
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($t->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('tipo_material_processos', 'A'))
                        <a class="btn btn-success" href="{{ route('tipo-material-processos.edit', ['tipo_material_processo' => $t->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar material de processo') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('tipo_material_processos', 'E'))
                        <form action="{{ route('tipo-material-processos.destroy', ['tipo_material_processo' => $t->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja excluir esse material de processo?')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir material de processo') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
