@extends('pages.estadoschapas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Estados de chapas cadastrados</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um estado de chapa" id="q">
                    </div>
                    @if(auth()->user()->temAcessoUnico('estados_chapas', 'C'))
                    <div class="col-6 text-right">
                        <a href="{{ route('estados-chapas.create') }}" class="btn btn-sm btn-warning">
                            <i class="material-icons">calendar_view_day</i>
                            <div class="ripple-container"></div>
                            {{ __('Cadastrar estado de chapa') }}</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive" id="tableIndex">
                    @include('pages.estadoschapas.table', ['estadosChapas' => $estadosChapas])
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
            $('#tableIndex').load('{{ route('estados-chapas.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
