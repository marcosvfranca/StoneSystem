@extends('pages.agendamentoprocessos.padrao')
@section('padrao')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Gerenciar agendamento de processo</h4>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route('agendamento-processos.update', ['agendamento_processo' => $agendamentoProcesso]) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="liberado" value="S">
                        <div class="row">
                            <div class="col-6 form-group">
                                <select class="form-control select2 @error('processo_id') is-invalid @enderror"
                                        name="processo_id">
                                    <option value="{{ $agendamentoProcesso->processo_id }}"
                                            selected>{{ $agendamentoProcesso->processo()->first()->nome }}</option>
                                </select>
                                @error('processo_id')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <select class="form-control select2 @error('grupos_usuario_id') is-invalid @enderror"
                                        name="grupos_usuario_id">
                                    <option value="">Selecione o setor...</option>
                                    @foreach($gruposUsuarios as $g)
                                        <option value="{{ $g->id }}"
                                                @if($g->id == (old('grupos_usuario_id') ?? $agendamentoProcesso->grupos_usuario_id)) selected @endif>{{ $g->nome }}</option>
                                    @endforeach
                                </select>
                                @error('grupos_usuario_id')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-8 form-group">
                                <textarea name="observacoes" placeholder="Observações"
                                          class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes') ?? $agendamentoProcesso->observacoes}}</textarea>
                                @error('observacoes')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group text-center">
                                <button type="submit"
                                        onclick="return confirm('Ao liberar o agendamento ele estará disponível para execução dos operadores, tem certeza?');"
                                        class="btn btn-warning"> Liberar agendamento
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-12 form-group" id="chapasCadastradas">
                        @include('pages.agendamentoprocessos.chapascadastradas', ['chapas' => $agendamentoProcesso->chapas()->get()])
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <input type="search" placeholder="Digite aqui para pesquisar uma chapa..."
                                   class="form-control" name="pesquisa">
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-warning" id="btnCadastrarChapas"
                                    onclick="cadastraChapas()"
                                    data-original-text="Adicionar chapas selecionadas">Adicionar chapas selecionadas
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id="materiaisProcesso">
                            @include('pages.agendamentoprocessos.materiaisprocesso', ['processo' => $agendamentoProcesso->processo()->first()])
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="font-weight-bold">Chapas disponíveis para agendamento</h4>
                        </div>
                        <div class="col-12" id="pesquisaDeChapas">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            @if (session('status') or session('error'))
            $.notify({
                icon: "note_add",
                message: "{{ session('status') ?? session('error')  }}"
            }, {
                type: @if(session('status')) 'success' @else 'danger' @endif,
                withtimer: 500,
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
            @endif
            function loadPesquisaDeChapas() {
                var pesquisa = $('input[name="pesquisa"]').val();
                var obj = {
                    "id": "{{ $agendamentoProcesso->id }}",
                    "q": pesquisa
                };
                var str = $.param(obj);
                $('#pesquisaDeChapas').load('{{ route('agendamento-processos.pesquisa-bloco') }}?' + str);
            }

            function loadChapasAgendadas() {
                $('#chapasCadastradas').load('{{ route('chapas-agendamentos.index', ['agendamentoProcesso' => $agendamentoProcesso->id]) }}');
            }

            loadPesquisaDeChapas();

            $(document).on('change', '.checkboxBloco', function () {
                var $this = $(this);
                var elements = 'input[type="checkbox"][data-bloco-id="' + $this.attr('data-id') + '"]';
                $(elements).prop('checked', $this.is(':checked'));
            });

            $(function() {
                var timer;
                $('input[name="pesquisa"]').keyup(function () {
                    clearTimeout(timer);
                    var ms = 200; // milliseconds
                    timer = setTimeout(function() {
                        loadPesquisaDeChapas();
                    }, ms);
                });
            });

            function cadastraChapas() {
                var chapas = [];
                $('.checkboxChapa:checked').each(function () {
                    chapas.push($(this).attr('data-chapa-id'));
                });

                $.ajax({
                    method: 'POST',
                    url: '{{ route('chapas-agendamentos.store') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        agendamento_processo_id: {{ $agendamentoProcesso->id }},
                        chapas_bloco: chapas,
                        tipos_materiais: $('select[name="tipoMaterialProcessos[]"]').val()
                    },
                    beforeSend: function () {
                        $('#btnCadastrarChapas').text('Aguarde...');
                    },
                    success: function (data) {
                        $.notify({
                            icon: "equalizer",
                            message: "Chapas cadastradas com sucesso"
                        }, {
                            type: 'success',
                            withtimer: 500,
                            placement: {
                                from: 'top',
                                align: 'center'
                            }
                        });
                        loadPesquisaDeChapas();
                        loadChapasAgendadas();
                    },
                    complete: function () {
                        var $btn = $('#btnCadastrarChapas');
                        $btn.html($btn.attr('data-original-text'));
                    },
                    error: function (e) {
                        console.log(e);
                        $.each(e.responseJSON.errors, function (key, value) {
                            $.notify({
                                icon: "error_outline",
                                message: value
                            }, {
                                type: 'danger',
                                withtimer: 500,
                                placement: {
                                    from: 'bottom',
                                    align: 'center'
                                }
                            });
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
