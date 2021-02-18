@extends('pages.agendamentoprocessos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Processos agendados</h4>
            </div>
            <div class="card-body">
                @if(auth()->user()->temAcessoUnico('agendamento_processos', 'C'))
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('agendamento-processos.create') }}" class="btn btn-sm btn-warning">
                                <i class="material-icons">note_add</i>
                                <div class="ripple-container"></div>
                                {{ __('Agendar processo') }}</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive">
                    @if(!count($agendamentoProcessos))
                        <span>Nenhum processo agendado...</span>
                    @else
                    <table class="table">
                        <thead class=" text-warning">
                        <tr>
                            <th>
                                Setor
                            </th>
                            <th class="text-right" width="200">
                                Nome
                            </th>
                            <th class="text-center">
                                Observações
                            </th>
                            <th class="text-center">
                                Qtd Chapas
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
                        @foreach($agendamentoProcessos as $a)
                            <tr>
                                <td>
                                    {{ $a->grupoUsuario()->first()->nome }}
                                </td>
                                <td class="text-right">
                                    {{ $a->processo()->first()->nome }}
                                </td>
                                <td class="text-right">
                                    {{ $a->observacoes }}
                                </td>
                                <td class="text-right">
                                    {{ $a->chapas()->count() }}
                                </td>
                                <td class="text-center">
                                    {{ date('d/m/Y', strtotime($a->created_at)) }}
                                </td>
                                <td class="td-actions text-right">
                                    @if(auth()->user()->temAcessoUnico('agendamento_processos', 'A'))
                                    <a class="btn btn-success" href="{{ route('agendamento-processos.edit', ['agendamento_processo' => $a->id]) }}">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                        {{ __('Gerênciar agendamento') }}
                                    </a>
                                    @endif
                                    @if(auth()->user()->temAcessoUnico('agendamento_processos', 'E'))
                                        <form action="{{ route('agendamento-processos.destroy', ['agendamento_processo' => $a->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                               onclick="return confirm('Deseja excluir este agendamento?')">
                                                <i class="material-icons">delete</i>
                                                {{ __('Excluir agendamento') }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
