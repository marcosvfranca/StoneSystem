@extends('pages.espessuraschapas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Espessuras de chapas cadastrados</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Digite aqui para pesquisar uma espessura de chapa" id="q">
                    </div>
                    @if(auth()->user()->temAcessoUnico('espessuras_chapas', 'C'))
                    <div class="col-6 text-right">
                        <a href="{{ route('espessuras-chapas.create') }}" class="btn btn-sm btn-warning">
                            <i class="material-icons">aspect_ratio</i>
                            <div class="ripple-container"></div>
                            {{ __('Cadastrar espessura de chapa') }}</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive" id="tableIndex">
                    @include('pages.espessuraschapas.table', ['espessurasChapas' => $espessurasChapas])
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
            $('#tableIndex').load('{{ route('espessuras-chapas.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
