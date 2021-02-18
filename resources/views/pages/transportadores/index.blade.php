@extends('pages.transportadores.transportadores')
@section('transportadores')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Transportadores cadastrados</h4>
            </div>
            <div class="card-body">
                @if(auth()->user()->temAcessoUnico('transportadores', 'C'))
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um transportador" id="q">
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('transportadores.cadastrar') }}" class="btn btn-sm btn-warning">
                                <i class="material-icons">commute</i>
                                <div class="ripple-container"></div>
                                {{ __('Cadastrar transportador') }}</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive" id="tableIndex">
                    @include('pages.transportadores.table', ['transportadores' => $transportadores])
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
            $('#tableIndex').load('{{ route('transportadores.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
