@if($chapas->count())
    <table class="table">
        <thead class=" text-warning">
        <tr>
            <th>
                Numeração
            </th>
            <th>
                Espessura
            </th>
            <th>
                Comprimento
            </th>
            <th>
                Altura
            </th>
            <th class="text-right">
                &nbsp;&nbsp;
            </th>
        </tr>
        </thead>
        <tbody>
        @php $m2 = 0; @endphp
        @foreach($chapas as $c)
            <tr  @if($c->espessura()->first()->cor or $c->espessura()->first()->cor_fonte) style="background-color: {{ $c->espessura()->first()->cor }};color: {{ $c->espessura()->first()->cor_fonte }};"
                @endif>
                <td>
                    {{ $c->numeracao }}
                </td>
                <td>
                    {{ $c->espessura()->first()->descricao }}
                </td>
                <td>
                    {{ number_format($c->comprimento, 2, ',', '.') }}
                </td>
                <td>
                    {{ number_format($c->altura, 2, ',', '.') }}
                </td>
                @php $m2 += $c->comprimento * $c->altura; @endphp
                <td class="td-actions text-right">
                    @if(auth()->user()->temAcessoUnico('chapas_serradas', 'E'))
                        <form action="{{ route('itens-chapas-serradas.destroy', ['itens_chapas_serrada' => $c]) }}" method="POST"
                              class="d-inline formDeleteItem"
                              data-message="Item excluído com sucesso">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                                <i class="material-icons">delete</i>
                                {{ __('Excluir') }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-4">
            <h4 class="font-weight-bold">Quantidade total de chapas: {{ $chapas->count() }}</h4>
        </div>
        <div class="col-3">
            <h4 class="font-weight-bold">Total m²: {{ number_format($m2, 2, ',', '.') }}</h4>
        </div>
    </div>
@else
    <div class="alert alert-danger">Nada encontrado...</div>
@endif
