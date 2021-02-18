@extends('pages.tipomaterialprocessos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        @if (session('status') or session('error'))
            @push('js')
                <script>
                    $.notify({
                        icon: "library_books",
                        message: "{{ session('status') ?? session('error')  }}"
                    },{
                        type: @if(session('status')) 'success' @else 'danger' @endif,
                        timer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                </script>
            @endpush
        @endif
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Material de processos</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um material de processo" id="q">
                    </div>
                    @if(auth()->user()->temAcessoUnico('tipo_material_processos', 'C'))
                    <div class="col-6 text-right">
                        <a href="{{ route('tipo-material-processos.create') }}" class="btn btn-sm btn-warning">
                            <i class="material-icons">library_books</i>
                            <div class="ripple-container"></div>
                            {{ __('Cadastrar material de processo') }}</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive" id="tableIndex">
                    @include('pages.tipomaterialprocessos.table', ['tipoMaterialProcessos' => $tipoMaterialProcessos])
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(function() {
            var timer;
            $('#q').keyup(function () {
                clearTimeout(timer);
                var ms = 200; // milliseconds
                timer = setTimeout(function() {
                    pesquisa();
                }, ms);
            });
        });
        function pesquisa () {
            var obj = {"q": $('#q').val()};
            var str = $.param(obj);
            $('#tableIndex').load('{{ route('tipo-material-processos.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
