@if(!count($espessurasChapas))
    <div class="alert alert-danger">Nenhuma espessura de chapa cadastrada...</div>
@else
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Espessura
            </th>
            <th class="text-right" width="200">
                Cor
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
        @foreach($espessurasChapas as $e)
            <tr>
                <td>
                    {{ $e->descricao }}
                </td>
                <td class="text-right">
                    @if($e->cor or $e->cor_fonte)
                        <span style="@if($e->cor) background-color: {{ $e->cor }}; @endif @if($e->cor_fonte) color: {{ $e->cor_fonte }}; @endif "><b>Cor</b></span>
                    @else
                        Sem cor
                    @endif
                </td>
                <td class="text-center">
                    {{ date('d/m/Y', strtotime($e->created_at)) }}
                </td>
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('espessuras_chapas', 'A'))
                        <a class="btn btn-success" href="{{ route('espessuras-chapas.edit', ['espessuras_chapa' => $e->id]) }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            {{ __('Alterar espessura de chapa') }}
                        </a>
                    @endif
                    @if(auth()->user()->temAcessoUnico('espessuras_chapas', 'E'))
                        <form action="{{ route('espessuras-chapas.destroy', ['espessuras_chapa' => $e->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Deseja excluir essa espessura de chapa?')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir espessura de chapa') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
