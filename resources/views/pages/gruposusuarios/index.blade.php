@extends('pages.gruposusuarios.gruposusuarios')
@section('gruposusuarios')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Setores</h4>
            </div>
            <div class="card-body">
                @if(auth()->user()->temAcessoUnico('gruposusuarios', 'C'))
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um setor" id="q">
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('gruposusuarios.cadastrar') }}" class="btn btn-sm btn-warning">
                                <i class="material-icons">groups</i>
                                <div class="ripple-container"></div>
                                {{ __('Cadastrar setor') }}</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive" id="tableIndex">
                    @include('pages.gruposusuarios.table', ['gruposusuarios' => $gruposusuarios])
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
            $('#tableIndex').load('{{ route('gruposusuarios.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
