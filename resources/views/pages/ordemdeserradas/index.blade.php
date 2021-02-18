@extends('pages.ordemdeserradas.padrao')
@section('padrao')
@if (session('status') or session('error'))
    @push('js')
        <script>
            $.notify({
                icon: "call_to_action",
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
                <h4 class="card-title ">Ordem de serradas cadastradas</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Digite aqui para pesquisar uma ordem de serrada" id="q">
                    </div>
                    @if(auth()->user()->temAcessoUnico('ordem_de_serradas', 'C'))
                    <div class="col-6 text-right">
                        <a href="{{ route('ordem-de-serradas.create') }}" class="btn btn-sm btn-warning">
                            <i class="material-icons">dvr</i>
                            <div class="ripple-container"></div>
                            {{ __('Cadastrar ordem de serrada') }}</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive" id="tableIndex">
                    @include('pages.ordemdeserradas.table', ['ordem_de_serradas' => $ordem_de_serradas])
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
            $('#tableIndex').load('{{ route('ordem-de-serradas.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
