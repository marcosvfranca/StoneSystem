@extends('pages.agendamentoprocessos.executar.padrao', ['titleAux' => 'Executar processo'])
@section('padrao')
    <div class="row" style="margin-top: -50px;">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title text-capitalize">{{ $agendamento->processo()->first()->nome }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($agendamento->observacoes)
                            <div class="col-12">
                                <h5>
                                    <b class="text-danger font-weight-bold">Observações: </b> {{ $agendamento->observacoes }}
                                </h5>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <h4 class="font-weight-bold">Chapas disponíveis</h4>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning btn-sm" type="button" id="btnConcluir" data-original-text="Marcar chapas selecionadas como concluído">Marcar chapas selecionadas como concluído</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning btn-sm" type="button" id="btnCancelar" data-original-text="Marcar chapas selecionadas como canceladas">Marcar chapas selecionadas como canceladas</button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning btn-sm" type="button" id="btnNConcluir" data-original-text="Marcar chapas selecionadas como não concluído">Marcar chapas selecionadas como não concluído</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="alertCancelamento" style="display: none;">
                            <div class="alert alert-danger alert-dismissible">
                                <div class="row">
                                    <div class="col-3">
                                        Selecione a seguir o motivo do cancelamento:
                                    </div>
                                    <div class="col-7">
                                        <select class="select2" id="motivo_cancelamento_id" data-placeholder="Clique aqui para selecionar o motivo" style="width: 100%;">
                                            <option></option>
                                            @foreach($motivos as $m)
                                                <option value="{{ $m->id }}">{{ $m->id }} - {{ $m->motivo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-warning" id="btnCancelarFinal" data-original-text="Marcar como cancelado">Marcar como cancelado</button>
                                    </div>
                                    <div class="col-6 text-left">
                                        <button type="button" class="btn btn-default" onclick="$('#alertCancelamento').hide()">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="alertNConclusao" style="display: none;">
                            <div class="alert alert-danger alert-dismissible">
                                <div class="row">
                                    <div class="col-3">
                                        Selecione a seguir o motivo da não conclusão:
                                    </div>
                                    <div class="col-7">
                                        <select class="select2" id="motivo_nao_conclusao_processo_id" data-placeholder="Clique aqui para selecionar o motivo" style="width: 100%;">
                                            <option></option>
                                            @foreach($motivos as $m)
                                                <option value="{{ $m->id }}">{{ $m->id }} - {{ $m->motivo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-warning" id="btnNConcluirFinal" data-original-text="Marcar como não concluído">Marcar como não concluído</button>
                                    </div>
                                    <div class="col-6 text-left">
                                        <button type="button" class="btn btn-default" onclick="$('#alertNConclusao').hide()">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="chapasAgendadas">
                            @include('pages.agendamentoprocessos.executar.chapas', ['agendamento' => $agendamento])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).on('change', '.selectAll', function () {
                $('.checkChapas:enabled').prop('checked', $(this).is(':checked'));
            });
            $('#btnConcluir').click(function () {
                var c = $('.checkChapas:enabled:checked');
                if (!c.length) {
                    $.notify({
                        icon: "equalizer",
                        message: "Selecione as chapas que deseja marcar como concluidas..."
                    }, {
                        type: 'danger',
                        withtimer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                    return false;
                }

                var chapas = [];
                c.each(function () {
                    chapas.push($(this).attr('data-id'));
                });

                $.ajax({
                    method: 'POST',
                    url: '{{ route('executar-processos.concluir') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        chapas: chapas,
                    },
                    beforeSend: function () {
                        $('#btnConcluir').text('Aguarde...');
                    },
                    success: function (data) {
                        $.notify({
                            icon: "equalizer",
                            message: "Chapas concluídas com sucesso"
                        }, {
                            type: 'success',
                            withtimer: 500,
                            placement: {
                                from: 'top',
                                align: 'center'
                            }
                        });
                        $('#alertNConclusao').hide();
                        $('#alertCancelamento').hide();
                        loadChapas();
                    },
                    complete: function () {
                        var $btn = $('#btnConcluir');
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
            });
            $('#btnCancelar').click(function () {
                $('#alertNConclusao').hide();
                $('#alertCancelamento').show();
            });
            $('#btnNConcluir').click(function () {
                $('#alertCancelamento').hide();
                $('#alertNConclusao').show();
            });

            $('#btnCancelarFinal').click(function () {
                var c = $('.checkChapas:enabled:checked');
                if (!c.length) {
                    $.notify({
                        icon: "equalizer",
                        message: "Selecione as chapas que deseja cancelar..."
                    }, {
                        type: 'danger',
                        withtimer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                    return false;
                }
                if (!$('#motivo_cancelamento_id').val()) {
                    $.notify({
                        icon: "equalizer",
                        message: "Selecione o motivo do cancelamento..."
                    }, {
                        type: 'danger',
                        withtimer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                    return false;
                }
                var chapas = [];
                c.each(function () {
                    chapas.push($(this).attr('data-id'));
                });

                $.ajax({
                    method: 'POST',
                    url: '{{ route('executar-processos.cancelar') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        chapas: chapas,
                        motivo_cancelamento_id: $('#motivo_cancelamento_id').val()
                    },
                    beforeSend: function () {
                        $('#btnCancelarFinal').text('Aguarde...');
                    },
                    success: function (data) {
                        $.notify({
                            icon: "equalizer",
                            message: "Chapas canceladas com sucesso"
                        }, {
                            type: 'success',
                            withtimer: 500,
                            placement: {
                                from: 'top',
                                align: 'center'
                            }
                        });
                        $('#alertNConclusao').hide();
                        $('#alertCancelamento').hide();
                        loadChapas();
                    },
                    complete: function () {
                        var $btn = $('#btnCancelarFinal');
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
            });

            $('#btnNConcluirFinal').click(function () {
                var c = $('.checkChapas:enabled:checked');
                if (!c.length) {
                    $.notify({
                        icon: "equalizer",
                        message: "Selecione as chapas que deseja marcar como não concluidas..."
                    }, {
                        type: 'danger',
                        withtimer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                    return false;
                }
                if (!$('#motivo_nao_conclusao_processo_id').val()) {
                    $.notify({
                        icon: "equalizer",
                        message: "Selecione o motivo da não conclusão..."
                    }, {
                        type: 'danger',
                        withtimer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                    return false;
                }

                var chapas = [];
                c.each(function () {
                    chapas.push($(this).attr('data-id'));
                });

                $.ajax({
                    method: 'POST',
                    url: '{{ route('executar-processos.naoconcluir') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        chapas: chapas,
                        motivo_nao_conclusao_processo_id: $('#motivo_nao_conclusao_processo_id').val()
                    },
                    beforeSend: function () {
                        $('#btnNConcluirFinal').text('Aguarde...');
                    },
                    success: function (data) {
                        $.notify({
                            icon: "equalizer",
                            message: "Chapas marcadas como não concluídas com sucesso"
                        }, {
                            type: 'success',
                            withtimer: 500,
                            placement: {
                                from: 'top',
                                align: 'center'
                            }
                        });
                        $('#alertNConclusao').hide();
                        $('#alertCancelamento').hide();
                        loadChapas();
                    },
                    complete: function () {
                        var $btn = $('#btnNConcluirFinal');
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
            });

            function loadChapas()
            {
                $('#chapasAgendadas').load('{{ route('executar-processos.chapas', ['agendamento' => $agendamento]) }}');
            }
        </script>
    @endpush
@endsection
