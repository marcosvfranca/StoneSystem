
$('.select2').select2({
    'language': {
        'noResults': function () {
            return 'Nada encontrado';
        }
    }
});
$('.placa')
    .keyup(function () {
        $(this).val($(this).val().toUpperCase());
    })
    .mask('AAA-0A00', {
        selectOnFocus: true
    });

// $('input[name="numeracao"]').mask('000000000000000000000', {
//     selectOnFocus: true
// });
