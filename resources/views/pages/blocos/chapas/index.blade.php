@if($chapas->count())
    <div class="table-responsive">
        <table class="table" border="2">
            <thead class="text-warning">
            <tr>
                <th class="text-center" width="100">
                    Numeração
                </th>
                <th width="200">
                    Estado
                </th>
                <th width="200">
                    Qualidade da serrada
                </th>
                <th width="100">
                    Espessura
                </th>
                <th width="100">
                    Comprimento
                </th>
                <th width="100">
                    Altura
                </th>
                @if(auth()->user()->temAcessoUnico('chapas', 'E'))
                    <th width="200"></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @php
                $m2 = 0;
            @endphp
            @foreach($chapas as $c)
                <tr @if($c->espessura()->first()->cor or $c->espessura()->first()->cor_fonte) style="background-color: {{ $c->espessura()->first()->cor }};color: {{ $c->espessura()->first()->cor_fonte }};"
                    @endif>
                    <td class="font-weight-bold">
                        {{ $c->numeracao }}
                    </td>
                    <td>
                        @if($c->estados()->count())
                            <ul>
                                @foreach($c->estados()->get() as $e)
                                    <li>{{ $e->descricao }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>
                        @if($c->observacoes()->count())
                            <ul>
                                @foreach($c->observacoes()->get() as $o)
                                    <li>{{ $o->apelido }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $c->espessura()->first()->descricao }}
                    </td>
                    @php
                        $m2 += $c->comprimento * $c->largura;
                    @endphp
                    <td>
                        {{ number_format($c->comprimento, 2, ',', '.') }}
                    </td>
                    <td>
                        {{ number_format($c->largura, 2, ',', '.') }}
                    </td>
                    <td class="td-actions text-right">
                        @if(auth()->user()->temAcessoUnico('chapas', 'A'))
                            <button class="btn btn-success btnAlterarChapa"
                                    data-href="{{ route('chapas.edit', ['chapa' => $c]) }}"
                                    data-chapa-id="{{ $c->id }}">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                                {{ __('Alterar') }}
                            </button>
                        @endif
                        @if(auth()->user()->temAcessoUnico('chapas', 'E'))
                            <form method="POST"
                                  action="{{ route('chapas.destroy', ['chapa' => $c->id]) }}"
                                  class="d-inline-block formDeleteChapa"
                                  data-message='Chapa "{{ $c->numeracao }}" excluída com sucesso'
                                  data-message-error="Erro ao excluir chapa, tente novamente">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('Tem certeza que deseja excluir a chapa de numeração: {{ $c->numeracao }}?')"
                                            data-original-text='<i class="material-icons">delete</i>
                                <div class="ripple-container"></div>
                                {{ __('Excluir chapa') }}'>
                                        <i class="material-icons">delete</i>
                                        <div class="ripple-container"></div>
                                        {{ __('Excluir') }}
                                    </button>
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-4">
            <h4 class="font-weight-bold">Quantidade total de chapas: {{ $chapas->count() }}</h4>
        </div>
        <div class="col-3">
            <h4 class="font-weight-bold">Total m²: {{ number_format($m2, 2, ',', '.') }}</h4>
        </div>
    </div>
@else
    <div class="alert alert-danger">Nenhuma chapa encontrada</div>
@endif
