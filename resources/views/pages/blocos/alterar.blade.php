@extends('pages.blocos.blocos')
@section('blocos')
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="position:fixed; top:25px; z-index: 1; width: 1000px;margin-left: 20px;" id="dadosBloco">
                <div class="card-body">
                    <form action="{{ route('blocos.alterar', ['id' => $bloco->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-3 form-group">
                                <label class="ml-3 mt-3" for="numeracao">Numeração do bloco</label>
                                <input class="form-control mt-3 @error('numeracao') is-invalid @enderror"
                                       name="numeracao" id="numeracao" placeholder="Numeração do bloco"
                                       value="{{ $bloco->numeracao }}" autofocus>
                                @error('numeracao')
                                <span class="error text-danger">{{ $errors->first('numeracao') }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <label for="tipos_blocos_id">Material do bloco</label>
                                <select class="form-control select2 @error('tipos_blocos_id') is-invalid @enderror"
                                        name="tipos_blocos_id" id="tipos_blocos_id">
                                    @foreach($tiposblocos as $t)
                                        <option value="{{ $t->id }}"
                                                @if($t->id == $bloco->tipos_blocos_id) selected @endif>{{ $t->descricao }}</option>
                                    @endforeach
                                </select>
                                @error('tipos_blocos_id')
                                <span class="error text-danger">{{ $errors->first('tipos_blocos_id') }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <label for="transportadores_id">Transportador / Placa</label>
                                <select class="form-control select2 @error('transportador_id') is-invalid @enderror"
                                        name="transportadores_id" id="transportadores_id">
                                    @foreach($transportadores as $t)
                                        <option value="{{ $t->id }}"
                                                @if($t->id == $bloco->transportadores_id) selected @endif>{{ $t->nome }}
                                            / {{ $t->placa }}</option>
                                    @endforeach
                                </select>
                                @error('transportadores_id')
                                <span class="error text-danger">{{ $errors->first('transportadores_id') }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <button type="submit" class="btn btn-warning"> Salvar dados do bloco</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-5">
{{--                <div class="card-header card-header-warning">--}}
{{--                    <h4 class="card-title ">{{ __('Gerenciar chapas. Bloco nº: ') . $bloco->numeracao }}</h4>--}}
{{--                </div>--}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-12" id="divImportaSerrada">
                            @include('pages.blocos.serrada')
                        </div>
                        <div class="col-12">
                            <h3>Cadastrar chapas</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id="cadastroChapa">
                            @include('pages.blocos.chapas.create')
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">Chapas do bloco</h3>
                                </div>
                                <div class="col-6">
                                    <input type="search" id="searchChapa" class="form-control" placeholder="Pesquisar chapa" onkeyup="loadChapas()">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3" id="tableChapas"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function loadChapas() {
            $('#tableChapas').load('{{ route('chapas.index') }}?bloco={{ $bloco->id }}&q=' + $('#searchChapa').val());
        }

        loadChapas();

        function loadCadastroChapa() {
            $.get('{{ route('chapas.createform', ['bloco' => $bloco->id]) }}')
                .then(function (e) {
                    $('#cadastroChapa').html(e);
                    loadSelect2();
                });
        }

        function loadSelect2() {
            $('.select2EspessuraChapa').select2();
            $('.select2ObservacoesChapa').select2({placeholder: 'Selecione a qualidade da serrada'});
            $('.select2EstadosChapa').select2({placeholder: 'Selecione o estado da chapa'});
            $('input[name="numeracao"]').mask('000000000000000000000', {selectOnFocus: true});
        }

        function loadAll() {
            loadCadastroChapa();
            loadChapas();
        }

        function loadSerradas()
        {
            $('#divImportaSerrada').load('{{ route('blocos.listaserrada', ['bloco' => $bloco]) }}');
        }

        $(document).on('submit', '.formCreateChapa, .formDeleteChapa', function (e) {
            e.preventDefault();
            $form = $(this);
            formData = $form.serializeArray();
            $.ajax({
                method: $form.attr('method'),
                url: $form.attr('action'),
                data: formData,
                beforeSend: function () {
                    $form.find('button[type="submit"]').text('Carregando...');
                },
                success: function (data) {
                    $.notify({
                        icon: "equalizer",
                        message: $form.attr('data-message')
                    }, {
                        type: 'success',
                        withtimer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                    loadAll();
                },
                complete: function () {
                    var $btn = $form.find('button[type="submit"]');
                    $btn.html($btn.attr('data-original-text'));
                },
                error: function (e) {
                    console.log(e);
                    $form.find('span.error').html('');
                    $.each(e.responseJSON.errors, function (key, value) {
                        if (key == 'observacoesChapa')
                            $.notify({
                                icon: "equalizer",
                                message: value
                            }, {
                                type: 'danger',
                                withtimer: 500,
                                placement: {
                                    from: 'bottom',
                                    align: 'center'
                                }
                            });
                        else if (key == 'estadosChapa')
                            $.notify({
                                icon: "equalizer",
                                message: value
                            }, {
                                type: 'danger',
                                withtimer: 500,
                                placement: {
                                    from: 'bottom',
                                    align: 'center'
                                }
                            });
                        else
                            $form.find('[name="' + key + '"]').parent().find('span.error').html(value);
                    });
                    if ($form.attr('data-message-error'))
                        $.notify({
                            icon: "equalizer",
                            message: $form.attr('data-message-error')
                        }, {
                            type: 'error',
                            withtimer: 500,
                            placement: {
                                from: 'bottom',
                                align: 'center'
                            }
                        });
                }
            });
            return false;
        });
        $(document).on('click', '.btnAlterarChapa', function () {
            var $btn = $(this);
            $.confirm({
                theme: 'material',
                columnClass: 'medium',
                title: 'Alterar chapa',
                content: 'url:' + $btn.attr('data-href'),
                buttons: {
                    formSubmit: {
                        text: 'Salvar alterações',
                        btnClass: 'btn-warning',
                        action: function () {
                            var $form = this.$content.find('form#editChapa' + $btn.attr('data-chapa-id'));
                            var formData = $form.serializeArray();
                            $.ajax({
                                method: $form.attr('method'),
                                url: $form.attr('action'),
                                data: formData,
                                beforeSend: function () {
                                    $form.find('button[type="submit"]').text('Carregando...');
                                },
                                success: function (data) {
                                    $.notify({
                                        icon: "equalizer",
                                        message: $form.attr('data-message')
                                    }, {
                                        type: 'success',
                                        withtimer: 500,
                                        placement: {
                                            from: 'top',
                                            align: 'center'
                                        }
                                    });
                                    loadChapas();
                                },
                                complete: function () {
                                    $form.find('button[type="submit"]').html('Salvar alterações');
                                },
                                error: function (e) {
                                    console.log(e);
                                    $form.find('span.error').html('');
                                    $.each(e.responseJSON.errors, function (key, value) {
                                            $.notify({
                                                icon: "equalizer",
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
                    },
                    cancel: {
                        text: 'Cancelar'
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('.select2').select2({
                        dropdownParent: $('form#editChapa' + $btn.attr('data-chapa-id'))
                    });
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });

        function importaSerrada() {
            $.confirm({
                columnClass: 'medium',
                title: 'Importar chapas serradas',
                theme: 'material',
                content: 'url:{{ route('blocos.importarserrada', ['bloco' => $bloco]) }}',
                buttons: {
                    formSubmit: {
                        text: 'Importar chapas selecionadas',
                        btnClass: 'btn-warning',
                        action: function () {
                            var c = $('.checkItemSerrada:enabled:checked');
                            if (!c.length) {
                                $.notify({
                                    icon: "equalizer",
                                    message: "Selecione as chapas que deseja importar..."
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
                                method: 'post',
                                url: '{{ route('blocos.salvaimportacaoserrada', ['bloco' => $bloco]) }}',
                                data: {
                                    chapas: chapas,
                                    _token: '{{ csrf_token() }}',
                                },
                                beforeSend: function () {
                                    $('#app').loading({
                                        message: 'Aguarde...'
                                    });
                                },
                                success: function (data) {
                                    $.notify({
                                        icon: "equalizer",
                                        message: 'Chapas importadas com sucesso'
                                    }, {
                                        type: 'success',
                                        withtimer: 500,
                                        placement: {
                                            from: 'top',
                                            align: 'center'
                                        }
                                    });
                                    loadChapas();
                                    loadSerradas();
                                },
                                complete: function () {
                                    $('#app').loading('stop');
                                },
                                error: function (e) {
                                    console.log(e);
                                    // $.each(e.responseJSON.errors, function (key, value) {
                                        $.notify({
                                            icon: "equalizer",
                                            message: 'Erro ao importar chapas, tente novamente'
                                        }, {
                                            type: 'danger',
                                            withtimer: 500,
                                            placement: {
                                                from: 'bottom',
                                                align: 'center'
                                            }
                                        });
                                    // });
                                }
                            });
                        }
                    },
                    cancel: {
                        text: 'Cancelar'
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    // this.$content.find('.select2').select2({
                    //     dropdownParent: $('form#editChapa' + $btn.attr('data-chapa-id'))
                    // });
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        }
        $(document).on('change', '.selectAllItensSerrada', function () {
            $('.checkItemSerrada:enabled').prop('checked', $(this).is(':checked'));
        });
    </script>
@endpush
