@push('js')
    <script>
        function loadItens()
        {
            $('#itensChapasSerrada').load('{{ route('itens-chapas-serradas.index') }}?serrada_id={{ $chapasSerradas->id }}');
        }
        loadItens();

        function loadFormCreate()
        {
            $('#createItem').load('{{ route('itens-chapas-serradas.create') }}?serrada_id={{ $chapasSerradas->id }}', function () {
                $(this).find('.select2').select2();
            });
        }

        function loadAll()
        {
            loadItens();
            loadFormCreate();
        }

        $(document).on('submit', '.formCreateItem, .formDeleteItem', function (e) {
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
    </script>
@endpush

