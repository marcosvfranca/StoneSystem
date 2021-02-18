@extends('pages.classificacoesblocos.padrao')
@section('padrao')
@if (session('status') or session('error'))
    @push('js')
        <script>
            $.notify({
                icon: "wysiwyg",
                message: "{{ session('status') ?? session('error')  }}"
            },{
                type: @if(session('status')) 'success' @else 'danger' @endif,
                withtimer: 500,
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
        </script>
    @endpush
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Classificações de blocos cadastradas</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Digite aqui para pesquisar uma classificação de bloco" id="q">
                    </div>
                    @if(auth()->user()->temAcessoUnico('classificacoes_blocos', 'C'))
                    <div class="col-6 text-right">
                        <a href="{{ route('classificacoes-blocos.create') }}" class="btn btn-sm btn-warning">
                            <i class="material-icons">wysiwyg</i>
                            <div class="ripple-container"></div>
                            {{ __('Cadastrar classificação de bloco') }}</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive" id="tableIndex">
                    @include('pages.classificacoesblocos.table', ['classificacoes' => $classificacoes])
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
            $('#tableIndex').load('{{ route('classificacoes-blocos.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
