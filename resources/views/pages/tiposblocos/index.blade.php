@extends('pages.tiposblocos.tiposblocos')
@inject('user','App\User')
@section('tiposblocos')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Material de blocos cadastrados</h4>
            </div>
            <div class="card-body">
                @if($user->temAcessoUnico('tipos-blocos', 'C'))
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um material de bloco" id="q">
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('tiposblocos.cadastrar') }}" class="btn btn-sm btn-warning">
                                <i class="material-icons">view_module</i>
                                <div class="ripple-container"></div>
                                {{ __('Cadastrar material de bloco') }}</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive" id="tableIndex">
                    @include('pages.tiposblocos.table', ['tiposblocos' => $tiposblocos])
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
            $('#tableIndex').load('{{ route('tiposblocos.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
